<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Controller\PaymentController;
use Symfony\Component\HttpFoundation\Request;

class PaymentTest extends TestCase
{
    public function testIndex()
    {
        $request = new Request(array('paymentData' => '{"type": "a","receiverName":"","amount":"4100","currency":"test","accountNumber":"7412 1472 145"}'));

        $paymentController = new PaymentController();
        $response = $paymentController->index($request);

        $this->assertEquals(
            200,
            $response->getStatusCode()
        );
    }
}
