<?php
include '../config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:../login/login.php');
    exit;
}

$city = $_GET['city'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
   
    <style>
        .shop-details-container {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: space-between;
            gap: 20px;
        }
        .shop-box {
            width: 100%;
            max-width: 600px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .shop-images img {
            max-width: 100px;
            margin: 5px;
        }
        .shop-book table {
            width: 100%;
            border-collapse: collapse;
        }
        .shop-book th, .shop-book td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .empty {
            color: #999;
        }
        .shop-book table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    background-color: #fff;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

.shop-book th, .shop-book td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

.shop-book th {
    background-color: #333;
    color: #fff;
    font-weight: bold;
}

.shop-book td {
    background-color: #f9f9f9;
    color: #555;
}

.shop-book tr:nth-child(even) td {
    background-color: #f1f1f1;
}

.shop-book tr:hover td {
    background-color: #e9f5ff;
    color: #333;
}

.styled-button{
    text-align: center;
    margin: 20px auto;
}
.styled-button button {
    background-color: #28a745; /* Green background */
    color: #fff; /* White text */
    font-size: 16px;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);

}

.styled-button button:hover {
    background-color: #218838; /* Darker green on hover */
    transform: scale(1.05); /* Slight zoom effect */
}

.styled-button button:active {
    transform: scale(0.98); /* Slightly shrink on click */
}
    </style>
</head>
<body>
    <?php include './user_header.php'; ?>
    
    <div class="heading">
        <h3>Checkout</h3>
        <p> <a href="home.php">Home</a> / Shop Details </p>
    </div>
    
    
<h1 style="text-align:center;  margin: 20px auto;;">SHOP DETAILS</h1>

    <section class="shop-details">
  

    
    <div class="shop-details-container">
        <?php
        $order_query = mysqli_query($conn, "SELECT * FROM `shopdetail` WHERE location = $city") or die('Query failed');
        if (mysqli_num_rows($order_query) > 0) {
            while ($shop = mysqli_fetch_assoc($order_query)) {
        ?>
        <div class="shop-box">
            <img class="shop-image" src="../uploaded_img/<?php echo htmlspecialchars($shop['shop_image1']); ?>" alt="Shop Front">
            <div class="shop-info">
                <h3><?php echo htmlspecialchars($shop['name']); ?></h3>
                <p>Location: <?php echo htmlspecialchars($shop['location']); ?></p>
            </div>
            <div class="shop-images">
                <img src="../uploaded_img/<?php echo htmlspecialchars($shop['shop_image1']); ?>" alt="Shop Image 1">
                <img src="../uploaded_img/<?php echo htmlspecialchars($shop['shop_image2']); ?>" alt="Shop Image 2">
            </div>
        </div>
            <br>
            <div class="shop-book">
                <h2>Category-wise Products</h2>
                <table>
    <tr>
        <!-- Display each category as a column header -->
        <?php
        $category_query = mysqli_query($conn, "SELECT * FROM `category`") or die('Query failed');
        $categories = [];
        
        while ($category = mysqli_fetch_assoc($category_query)) {
            $categories[] = $category; // Store category for later use
            echo "<th>" . htmlspecialchars($category['name']) . "</th>";
        }
        ?>
    </tr>
    
    <!-- Display products for each category in rows below the headers -->
    <tr>
        <?php
        foreach ($categories as $category) {
            $catId = $category['id'];
            
            // Fetch products for the specific shop and category
            $product_query = mysqli_query($conn, "SELECT p.name FROM `products` p
                                                  JOIN `productshop` ps ON p.id = ps.product_id
                                                  WHERE ps.shop_id = '{$shop['id']}' AND p.category_id = '$catId'") or die('Query failed');

            echo "<td>";
            if (mysqli_num_rows($product_query) > 0) {
                while ($product = mysqli_fetch_assoc($product_query)) {
                    echo "<p>" . htmlspecialchars($product['name']) . "</p>";
                }
            } else {
                echo "<p>No products available</p>";
            }
            echo "</td>";
        }
        ?>
    </tr>
</table>

            </div>
        
        <?php
            }
        } else {
            echo '<p class="empty">No shops found in this location.</p>';
        }
        ?>
    </div>
</section>
<a href="./home.php" class="styled-button">
    <button type="button">HAPPY BUYING 😊😊😊</button>
</a>
</body>
</html>