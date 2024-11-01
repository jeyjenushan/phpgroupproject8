<?php
include '../config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:./login/login.php');
    exit;
}

if (isset($_POST['update_cart'])) {
    $update_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    $update_name=$_POST['product_name'];
    $row1=mysqli_query($conn,"Select * from `products` where name='$update_name'");
    $result=mysqli_fetch_array($row1);
    $quantity=$result['quantity'];
    if($cart_quantity>$quantity){
        $message[]="The product is not in the stock";
    }
    else{
        $quantity-=$cart_quantity;
        $updateproduct=mysqli_query($conn,"Update `products` set quantity='$quantity'");
    $result = mysqli_query($conn, "UPDATE `cart` SET quantity='$cart_quantity' WHERE id='$update_id'");
    $message[] = 'Cart quantity updated!';
}}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $result = mysqli_query($conn, "DELETE FROM `cart` WHERE id='$delete_id'");
    header("location:cart.php");
    exit;
}

if (isset($_GET['delete_all'])) {
    $result = mysqli_query($conn, "DELETE FROM `cart` WHERE user_id='$user_id'");
    header("location:cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cart_style.css">
    <title>Cart</title>
</head>
<body>

    <?php include './user_header.php'; ?>

    <div class="cart_heading">
        <h3>Shopping Cart</h3>
        <p><a href="home.php">Home</a> / Cart</p>
    </div>

    <section class="shopping-cart">
        <h1 class="title">Products Added</h1>
        <div class="box-container">
        <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die("Query failed.");

        if (mysqli_num_rows($select_cart) > 0) {
            while ($row = mysqli_fetch_assoc($select_cart)) {
                $sub_total = $row['quantity'] * $row['price'];
                $grand_total += $sub_total;
                ?>
                <div class="box">
                    <a href="cart.php?delete=<?php echo $row['id']; ?>" class="fas fa-times" onclick="return confirm('Delete this from cart?');"></a>
                    <img src="../uploaded_img/<?php echo $row['image']; ?>" alt="">
                    <div class="name"><?php echo $row['name']; ?></div>
                    <div class="price">Rs <?php echo $row['price']; ?>/-</div>
                    <form action="" method="post">
                        <input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
                        <?php echo $row['name']; ?>;
                        <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                        <input type="number" min="1" name="cart_quantity" value="<?php echo $row['quantity']; ?>">
                        <input type="submit" name="update_cart" value="Update" class="option-btn">
                    </form>
                    <div class="sub-total">Subtotal: <span>Rs <?php echo $sub_total; ?>/-</span></div>
                </div>
                <?php
            }
        } else {
            echo '<p class="empty">Your cart is empty!</p>';
        }
        ?>
        </div>

        <div style="margin-top: 2rem; text-align: center;">
            <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 0) ? "" : 'disabled'; ?>" onclick="return confirm('Delete all from cart?');"> 
                DELETE ALL
            </a>
        </div>

        <div class="cart-total">
            <p>Grand Total: <span>Rs <?php echo $grand_total; ?>/-</span></p>
            <div class="flex">
                <a href="shop.php" class="option-btn">Continue Shopping</a>
                <a href="checkout.php" class="btn <?php echo ($grand_total > 0) ? "" : 'disabled'; ?>">Proceed to Checkout</a>
            </div>
        </div>
    </section>

    <?php include './user_footer.php'; ?>
    <script src="../js/script.js"></script>
</body>
</html>