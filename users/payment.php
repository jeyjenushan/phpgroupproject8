<?php

require_DIR__ ."/vender/autoload.php";

$stripe_secret_key = "sk_test_51QGbGsIYO3gEi4mRyF7LyrGcBd918Bgbkrq1wUmRlTu3oUiIsm2xhOzVQUnTyb5SJLMFnXWl0E020t1wc8JikFDM00MYDH7Abn";

\Stripe\Stripe::setApiKey($stripe_secret_key);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode"=> "payment",
    "success_url" => "http://localhost/success.php",
    "cancel_url"=> "http://localhost/checkout.php",
    "line_item" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "USD",
                "unit_amount" => 2000,
                "product_data" => [
                    "name" => "T-shirt"
                ]
            ]
        ]
    ]
]);

http_response_code(303);
header("Location: " . $checkout_session->url);