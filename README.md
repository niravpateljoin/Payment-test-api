# Payment test Api #

A Symfony website for Payment Api...

** Initial Setup **

* git clone

```
git clone https://github.com/niravpateljoin/Payment-test-api.git
```

* Initial command to run

```
composer install      // this will install all the dependencies for this project.
```

* Start server to run the project

```
symfony server:start
```
     [OK] Web server listening
      The Web server is using PHP CGI 7.4.9
      https://127.0.0.1:8000

* For demo payment api, please run the below url

```
https://127.0.0.1:8000/api/payment?paymentData={"type": "A","receiverName":"Test user","amount":"45","currency":"usd","accountNumber":"141 454 741 12"}
```

* How to select provide *

```
We can select A & B provider by changing `type` in `paymentData`.
```

* Unit test *

```
php bin/phpunit
```

Note :: _If you run the url without parameter like this `https://127.0.0.1:8001/api/payment` -> this will take payment data from `payment-data.json` file, which is in root directory._