<?php
// Include Composer's autoload file for Stripe
require __DIR__ . '/../vendor/autoload.php';

// Set your Stripe secret key
$stripe_secret_key = "sk_test_51QMV3KHyRh1dkonjcY9X1NSVNZLKcurWuejZ6MQoBWBewNAh2gG9HU0p8EVB8B2VUSJID29dnYqLqPh9jV9xGGtP00ZhjNwfjk";
\Stripe\Stripe::setApiKey($stripe_secret_key);

// Get the grand total from the query parameter
$grand_total = isset($_GET['grand_total']) ? intval($_GET['grand_total']) : 0;

try {
    // Create a Checkout Session
    $checkout_session = \Stripe\Checkout\Session::create([
        "payment_method_types" => ["card"],
        "mode" => "payment",
        "line_items" => [
            [
                "price_data" => [
                    "currency" => "usd",
                    "product_data" => [
                        "name" => "Cart Total",
                    ],
                    "unit_amount" => $grand_total * 100, // Convert to cents
                ],
                "quantity" => 1,
            ],
        ],
        "success_url" => "http://localhost/GitHub/phpgroupproject8/users/success.php?session_id={CHECKOUT_SESSION_ID}",
        "cancel_url" => "http://localhost/GitHub/phpgroupproject8/users/fail_payment.php",
    ]);

    // Redirect to Stripe Checkout
    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);
} catch (\Exception $e) {
    // Handle error
    echo "Error: " . $e->getMessage();
}