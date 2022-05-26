<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @method indexAction()
 */
class PaymentController extends AbstractController
{
    /**
     * @Route("/api/payment", name="api_payment")
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        //initialize array
        $response = array();

        // get payment data...
        if($request->get('paymentData')) {
            $paymentJSONData = $request->get('paymentData');
        }
        else {
            $fileContent = '../payment-data.json';
            $paymentJSONData = file_get_contents($fileContent);
        }
        $paymentData = json_decode($paymentJSONData, true);

        if (isset($paymentData['type']) && $paymentData['type'] != '') {
            if (strtolower($paymentData['type']) == 'a') {
                $result = $this->checkValidationForTypeA($paymentData);
                $response = $result;
            }
            elseif (strtolower($paymentData['type']) == 'b') {
                $result = $this->checkValidationForTypeB($paymentData);
                $response = $result;
            }
            else {
                $response['status'] = 'Error';
                $response['message'] = 'Type is not valid';
            }
        }
        else {
            $response['status'] = 'Error';
            $response['message'] = 'Type is required field';
        }

        if($response['status'] == 'Success') {
            $response['message'] = 'Valid data.';
        }

        return new JsonResponse($response);
    }

    /**
     * @param $paymentData
     * @return array
     */
    // `receiverName`, `amount`, `currency`, `accountNumber` are the required fields for type A.
    protected function checkValidationForTypeA($paymentData): array
    {
        $result = $this->commonValidation($paymentData);
        $message = $result['message'];
        $status = $result['status'];

        return array('status' => $status, 'message' => $message);
    }

    /**
     * @param $paymentData
     * @return array
     */
    // `receiverName`, `amount`, `currency`, `accountNumber`, `CIF`, `phone` are the required fields for type B.
    protected function checkValidationForTypeB($paymentData): array
    {
        $result = $this->commonValidation($paymentData);
        $message = $result['message'];
        $status = $result['status'];

        if(!isset($paymentData['cif']) || $paymentData['cif'] == '') {
            $message .= ', CIF is required';
            $status = 'Error';
        }
        elseif (strlen(str_replace(' ', '', $paymentData['cif'])) != 11 || !is_numeric(str_replace(' ', '', $paymentData['cif']))) {
            $message .= ', CIF is not valid';
            $status = 'Error';
        }

        if(!isset($paymentData['phone']) || $paymentData['phone'] == '') {
            $message .= ', Phone is required';
            $status = 'Error';
        }
        elseif (strlen(str_replace(' ', '', $paymentData['phone'])) != 10 || !is_numeric(str_replace(' ', '', $paymentData['phone']))) {
            $message .= ', Phone is not valid';
            $status = 'Error';
        }

        return array('status' => $status, 'message' => $message);
    }

    /**
     * @param $paymentData
     * @return array
     */
    // common validation for both type A & B...
    protected function commonValidation($paymentData): array
    {
        $message = '';
        $status = 'Success';
        if(!isset($paymentData['receiverName']) || $paymentData['receiverName'] == '') {
            $message .= 'Receiver Name is required';
            $status = 'Error';
        }

        if(!isset($paymentData['amount']) || $paymentData['amount'] == '') {
            $message .= ', Amount is required';
            $status = 'Error';
        }
        elseif (!is_numeric($paymentData['amount'])) {
            $message .= ', Amount is not valid';
            $status = 'Error';
        }

        $currencyCodeArr = ['USD', 'EUR', 'INR', 'IDR']; // for testing we just take few currency code...
        if(!isset($paymentData['currency']) || $paymentData['currency'] == '') {
            $message .= ', Currency is required';
            $status = 'Error';
        }
        elseif (!in_array(strtoupper($paymentData['currency']), $currencyCodeArr)) {
            $message .= ', Currency is not valid';
            $status = 'Error';
        }

        // account number should have 11 digit & numeric also...
        if(!isset($paymentData['accountNumber']) || $paymentData['accountNumber'] == '') {
            $message .= ', Account Number is required';
            $status = 'Error';
        }
        elseif (strlen(str_replace(' ', '', $paymentData['accountNumber'])) != 11 || !is_numeric(str_replace(' ', '', $paymentData['accountNumber']))) {
            $message .= ', Account Number is not valid';
            $status = 'Error';
        }

        return array('status' => $status, 'message' => $message);
    }
}
