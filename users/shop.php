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
        $updateproduct = mysqli_query($conn, "UPDATE `products` SET quantity='$quantity'");
        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'Product added to cart!';
    }
}

// Pagination setup
$limit = 4; // Number of products per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Current page, default is 1
$offset = ($page - 1) * $limit; // Calculate offset for SQL query
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
    <?php include './user_header.php'; ?>

    <div class="shop_heading">
        <h3>Our Shop</h3>
        <p><a href="home.php">Home</a> / Shop</p>
    </div>

    <section class="shop_products">
        <div class="product_headers">
            <?php
            $select_category = mysqli_query($conn, "SELECT * FROM `category`");
            while ($row = mysqli_fetch_assoc($select_category)) {
            ?>
                <a href="shop.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
            <?php } ?>
        </div>

        <div class="container">
            <div class="main-content">
                <h1 class="title">Latest Products</h1>
                <div class="box-container">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE category_id='$id' LIMIT $limit OFFSET $offset") or die('query failed');
                        $total_products_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM `products` WHERE category_id='$id'") or die('query failed');
                    } else {
                        $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT $limit OFFSET $offset") or die('query failed');
                        $total_products_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM `products`") or die('query failed');
                    }

                    $total_products = mysqli_fetch_assoc($total_products_result)['total'];
                    $total_pages = ceil($total_products / $limit);

                    if (mysqli_num_rows($select_products) > 0) {
                        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                            <form action="" method="post" class="box">
                                <img class="image" src="../uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                                <div class="name"><?php echo $fetch_products['name']; ?></div>
                                <div class="price">Rs <?php echo $fetch_products['price']; ?>/-</div>
                                <label id=Qty_label>Qty : </label><input type="number" min="1" name="product_quantity" value="1" class="qty">
                                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                                <input type="hidden" value="<?php echo $fetch_products['quantity']; ?>" name="quantitys">
                                <div class="flex">
                                    <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
                                </div>
                            </form>
                        <?php
                        }
                    } else {
                        echo '<p class="empty">No products added yet!</p>';
                    }
                    ?>
                </div>

                <!-- Pagination Links -->
                <div class="pagination">
                    <?php if ($page > 1) { ?>
                        <a href="shop.php?page=<?php echo $page - 1; ?><?php echo isset($_GET['id']) ? '&id=' . $_GET['id'] : ''; ?>" class="prev">Prev</a>
                    <?php } ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                        <a href="shop.php?page=<?php echo $i; ?><?php echo isset($_GET['id']) ? '&id=' . $_GET['id'] : ''; ?>" class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                    <?php } ?>

                    <?php if ($page < $total_pages) { ?>
                        <a href="shop.php?page=<?php echo $page + 1; ?><?php echo isset($_GET['id']) ? '&id=' . $_GET['id'] : ''; ?>" class="next">Next</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <?php include './user_footer.php'; ?>
    <script src="../js/script.js"></script>
</body>

</html>
