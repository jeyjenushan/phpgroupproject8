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
    <link rel="stylesheet" href="../css/productShop_style.css">       
</head>
<body>
    <?php include './user_header.php'; ?>

    <div class="heading">
        <h3>Shop Locations</h3>
        <p><a href="home.php">Home</a> / Shop Details</p>
    </div>

    <h1 style="text-align:center; margin: 20px auto;">SHOP DETAILS</h1>

    <section class="shop-details">
        <div class="shop-details-container">
            <table class="shop-table">
                <thead>
                    <tr>
                    <th style="width:30%;">Shop Image</th>
                        <th>Shop Location</th>
                        <?php
                        // Fetch categories for header
                        $category_query = mysqli_query($conn, "SELECT * FROM `category`") or die('Query failed');
                        while ($category = mysqli_fetch_assoc($category_query)) {
                            echo "<th>" . htmlspecialchars($category['name']) . "</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $shop_query = mysqli_query($conn, "SELECT * FROM `shopdetail` ") or die('Query failed');
                    if (mysqli_num_rows($shop_query) > 0) {
                        while ($shop = mysqli_fetch_assoc($shop_query)) {
                            echo "<tr>";
                            // Display shop image
                            echo "<td><img class='shop-image' src='../uploaded_img/" . htmlspecialchars($shop['shop_image1']) . "' alt='Shop Front'></td>";
                             echo "<td>". htmlspecialchars($shop['location'])."</td>";
                            // Display products for each category
                            $category_query = mysqli_query($conn, "SELECT * FROM `category`") or die('Query failed');
                            while ($category = mysqli_fetch_assoc($category_query)) {
                                $catId = $category['id'];
                                
                                // Fetch products for the specific shop and category
                                $product_query = mysqli_query($conn, "SELECT p.name FROM `products` p JOIN `productshop` ps ON p.id = ps.product_id WHERE ps.shop_id = '{$shop['id']}' AND p.category_id = '$catId'") or die('Query failed');

                                echo "<td>";
                                if (mysqli_num_rows($product_query) > 0) {
                                    while ($product = mysqli_fetch_assoc($product_query)) {
                                        echo "<p>" . htmlspecialchars($product['name']) . "</p>";
                                    }
                                } else {
                                    echo "<p style=color:red >No products available</p>";
                                }
                                echo "</td>";
                            }
                            echo "</tr>"; // Close shop row
                        }
                    } else {
                        echo '<tr><td colspan="10" class="empty">No shops found in this location.</td></tr>'; // Adjust column span as needed
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <div class="styled-button">
        <a href="./home.php">
            <button type="button">HAPPY BUYING 😊😊😊</button>
        </a>
    </div>
    <!-- Add this HTML for the fullscreen overlay just before the closing </body> tag -->

<div class="fullscreen-overlay" id="fullscreenOverlay">
    <span class="close-btn" onclick="closeFullscreen()">✖</span>
    <img id="fullscreenImage" src="" alt="Full Screen Shop Image">
</div>

    <?php include 'user_footer.php'?>
    <script src="../js/script.js"></script>
</body>
</body>
</html>