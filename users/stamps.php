<?php
include '../config.php';
session_start();
$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('location:../login/login.php');
}
if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    $quantity = $_POST["quantitys"];

    if ($quantity < $product_quantity) {
        $message[] = 'Not enough stock available!';
    } else {
        $quantity -= $product_quantity;
        $updateproduct = mysqli_query($conn, "Update `products` set quantity='$quantity'");
        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'product added to cart!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/shop_style.css">
    <title>Shop</title>
</head>

<body>
    <?php include './user_header.php' ?>
    <div class="shop_heading">
        <h3>our shop</h3>
        <p> <a href="home.php">home</a> / shop </p>
    </div>

    <section class="shop_products">
        <div class="product_headers">
        <a href="shop.php"><h3 style="color:#805a0e">Books</h3></a>
        <a href="stamps.php"><h3 style="color:#8B0000">Stamps</h3></a>
        <a href="postcards.php"><h3 style="color:#805a0e">Post Cards</h3></a>
             
            
        </div>
        <div class="container">
            <div class="main-content">

                <h1 class="title">latest products</h1>

                <div class="box-container">

                    <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                            <form action="" method="post" class="box">
                                <img class="image" src="../uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                                <div class="name"><?php echo $fetch_products['name']; ?></div>
                                <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                                <div class="hidden" name="quantity"><?php echo $fetch_products['quantity'] ?></div>
                                <input type="number" min="1" name="product_quantity" value="1" class="qty">
                                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">

                                <input type="hidden" value="<?php echo $fetch_products['quantity'] ?>" name="quantitys">
                                <div class="flex">
                                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                                    <a href="viewmore.php?viewmore=$fetched_products['name']"> <input type="submit" value="view more" name="view more" class="option-btn"></a>
                                </div>
                            </form>
                    <?php
                        }
                    } else {
                        echo '<p class="empty">no products added yet!</p>';
                    }
                    ?>
                </div>
            </div>
            <!-- <div class="navbarl">
                <li style="list-style-type: none;">Delivery Categories</li>
                <ul>
                    <?php
                    $result = mysqli_query($conn, "Select * from `category`");
                    while ($row = mysqli_fetch_assoc($result)) {
                        $categoryname = $row['name'];
                    ?>
                        <a href="category.php?category=<?php echo $categoryname ?>">
                            <li><?php echo $row['name'] ?></li>
                        </a>
                    <?php
                    }
                    ?>

                </ul>
            </div> -->
        </div>

    </section>




    <?php include './user_footer.php' ?>
    <script src="../js/script.js"></script>
</body>

</html>