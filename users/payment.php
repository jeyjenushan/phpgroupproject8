<?php
// Include Composer's autoload file for Stripe
require __DIR__ . '/../vendor/autoload.php';

// Set your Stripe secret key
$stripe_secret_key = "sk_test_51QGbGsIYO3gEi4mRyF7LyrGcBd918Bgbkrq1wUmRlTu3oUiIsm2xhOzVQUnTyb5SJLMFnXWl0E020t1wc8JikFDM00MYDH7Abn";
\Stripe\Stripe::setApiKey($stripe_secret_key);

// Get the grand total from the query parameter
$grand_total = isset($_GET['grand_total']) ? intval($_GET['grand_total']) : 0;

// Ensure a valid amount is provided
if ($grand_total <= 0) {
    die("Invalid total amount. Unable to proceed with payment.");
}

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
        "success_url" => "http://localhost/groupproject/phpgroupproject8/users/success.php",
        "cancel_url" => "http://localhost/checkout.php",
    ]);

    // Redirect to Stripe Checkout
    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);
} catch (\Exception $e) {
    // Handle error
    echo "Error: " . $e->getMessage();
}