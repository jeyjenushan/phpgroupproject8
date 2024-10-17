<?php
include '../config.php';
if(isset($message)){
    foreach($message as $message){
        echo '
        <div class="message">
        <span>'.$message.'</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
        ';
    }
}

?>

<header class="header">
<div class="header-1">
    <div class="flex">
        <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
        </div>
        <p>new <a href="../login/login.php">Login</a>|<a href="../login/register.php">Register</a></p>    
    </div>
</div>
<div class="header-2">
    <div class="flex">
    <a href="home.php" class="logo">Bookly</a>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="about.php">About</a>
        <a href="shop.php">Shop</a>
        <a href="contact.php">Contact</a>
        <a href="orders.php">Orders</a>
</div>
<div class="icons">
    <div id="menu-btn" class="fas fa-bars"></div>
    <a href="search_page.php" class="fas fa-search"></a>
    <div id="user-btn" class="fas fa-users"></div>
<?php
$select_cart_number=mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id'")
or die("query failed");

$cart_num_rows=mysqli_num_rows($select_cart_number);

?>



    <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows ?>)</span></a>
</div>

    </div>

</div>




</header>