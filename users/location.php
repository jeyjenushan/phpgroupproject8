<?php
include '../config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:../login/login.php');
    exit;
}

if (isset($_GET['city'])) {
    $city = $_GET['city'];
} else {
    $city = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Shop Details</title>
  
</head>
<body>
    <?php include './user_header.php'; ?>
    
    <div class="heading">
        <h3>Checkout</h3>
        <p> <a href="home.php">Home</a> / Shop Details </p>
    </div>

    <section class="shop-details">
    <h1 class="title">Shop Details</h1>
    
    <div class="shop-details-container">
        <?php
        $order_query = mysqli_query($conn, "SELECT * FROM `shopdetail` WHERE location = '$city'") or die('Query failed');
        if (mysqli_num_rows($order_query) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($order_query)) {
        ?>
        <div class="shop-box">
            <img class="shop-image" src="../uploaded_img/<?php echo htmlspecialchars($fetch_orders['shop_image1']); ?>" alt="Shop Front">
            <div class="shop-info">
                <h3><?php echo htmlspecialchars($fetch_orders['name']); ?></h3>
                <p>Location: <?php echo htmlspecialchars($fetch_orders['location']); ?></p>
            </div>
            <div class="shop-images">
                <img src="../uploaded_img/<?php echo htmlspecialchars($fetch_orders['shop_image1']); ?>" alt="Shop Image 1">
                <img src="../uploaded_img/<?php echo htmlspecialchars($fetch_orders['shop_image2']); ?>" alt="Shop Image 2">
            </div>
        </div>
        <?php
            }
        } else {
            echo '<p class="empty">No shops found in this location.</p>';
        }
        ?>
    </div>
    
   
</section>
</body>
</html>