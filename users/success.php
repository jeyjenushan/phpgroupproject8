<?php
require __DIR__ . '/../vendor/autoload.php';

// Set your Stripe secret key
$stripe_secret_key = "sk_test_51QMV3KHyRh1dkonjcY9X1NSVNZLKcurWuejZ6MQoBWBewNAh2gG9HU0p8EVB8B2VUSJID29dnYqLqPh9jV9xGGtP00ZhjNwfjk";
\Stripe\Stripe::setApiKey($stripe_secret_key);

session_start();
include '../config.php';

// Check if the session ID is present
if (isset($_GET['session_id'])) {
    $session_id = $_GET['session_id'];

    try {
        // Retrieve the session details from Stripe
        $session = \Stripe\Checkout\Session::retrieve($session_id);

        // Check if the payment was successful
        if ($session->payment_status === 'paid') {
            $user_id = $_SESSION['user_id'];
            $name = $_SESSION['user_name'];
            $email = $_SESSION['user_email'];

            // Retrieve cart details
            $cart_total = 0;
            $cart_products = [];
            $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('Query failed');
            
            while ($cart_item = mysqli_fetch_assoc($cart_query)) {
                $cart_products[] = $cart_item['name'] . '(' . $cart_item['quantity'] . ')';
                $sub_total = ($cart_item['price'] * $cart_item['quantity']);
                $cart_total += $sub_total;
            }

            $total_products = implode(', ', $cart_products);
            $placed_on = date('Y-m-d');

            // Insert the order into the database
            $insert_order = mysqli_query($conn, "INSERT INTO `orders` (user_id, name, email, total_products, total_price, placed_on) 
                VALUES ('$user_id', '$name', '$email', '$total_products', '$cart_total', '$placed_on')") or die('Query failed');

            // Clear the cart
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('Query failed');

            echo "<h1>Payment Successful!</h1>";
            echo "<p>Your order has been placed successfully, and your cart has been cleared. Thank you for your purchase!</p>";
        } else {
            echo "<h1>Payment Not Completed</h1>";
            echo "<p>We could not verify the payment. Please try again.</p>";
        }
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<h1>Invalid Session</h1>";
    echo "<p>Session ID is missing.</p>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
    <title>Checkout</title>
    <style>
        .order-success {
    text-align: center;              
    background-color: #28a745;      
    color: #fff;                   
    padding: 15px 20px;            
    font-weight: bold;             
    border-radius: 8px;           
    margin: 20px auto;               
    max-width: 600px;             
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}
    </style>
</head>
<body>
    <?php include './user_header.php' ?>
    


<h1 class="order-success">Your Order has been successfully placed!</h1>
<?php
echo "<script>
    setTimeout(() => {
        window.location.href = 'home.php';
    }, 2000);
</script>";
?>

</body>
</html>