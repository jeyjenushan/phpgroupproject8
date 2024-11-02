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
        .shop-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        .shop-table th, .shop-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .shop-table th {
            background-color: #333;
            color: #fff;
        }
        .shop-table tr:nth-child(even) {
            background-color: #f1f1f1;
        }
        .shop-table tr:hover {
            background-color: #e9f5ff;
        }
        .shop-image {
            max-width: 100px;
            height: auto;
        }
        .styled-button {
            text-align: center;
            margin: 20px auto;
        }
        .styled-button button {
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .styled-button button:hover {
            background-color: #218838;
            transform: scale(1.05);
        }
        .styled-button button:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <?php include './user_header.php'; ?>

    <div class="heading">
        <h3>Checkout</h3>
        <p><a href="home.php">Home</a> / Shop Details</p>
    </div>

    <h1 style="text-align:center; margin: 20px auto;">SHOP DETAILS</h1>

    <section class="shop-details">
        <div class="shop-details-container">
            <table class="shop-table">
                <thead>
                    <tr>
                        <th>Shop Image</th>
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
                                    echo "<p>No products available</p>";
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
    <?php include 'user_footer.php'?>
    <script src="../js/script.js"></script>
</body>
</body>
</html>