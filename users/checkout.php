<?php
include '../config.php';
session_start();
$user_id=$_SESSION['user_id'];
$name=$_SESSION['user_name'];
$email=$_SESSION['user_email'];

if(!isset($user_id)){
    header('location:../login/login.php');
}
$cart_total=0;
if (isset($_POST['order_btn'])) {
   $number = $_POST['number'];
   $name = $_POST['name'];
   $email = $_POST['email'];
   
   $method = $_POST['method'];
   $city = $_POST['city'];
   
   // Prepare the address
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');

   $cart_products[] = '';
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die("Mysqli_connection failed");
   if (mysqli_num_rows($cart_query) > 0) {
       while ($cart_item = mysqli_fetch_assoc($cart_query)) {
           $cart_products[] = $cart_item['name'].'('.$cart_item['quantity'];
           $sub_total = ($cart_item['price'] * $cart_item['quantity']);
           $cart_total += $sub_total;
       }
   }
   $totalcart = $cart_total;
   
   $total_products = implode(', ', $cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if ($cart_total == 0) {
       $message[] = 'your cart is empty';
   } else {
       if (mysqli_num_rows($order_query) > 0) {
           $message[] = 'order already placed!'; 
       } else {
           // Insert the order into the database
           $result = mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');

           // Clear the cart
           mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

           // Redirect based on payment method
           if ($method == "paytm" || $method=="paypal") {
            header("location:payment.php?grand_total=$cart_total");
                // Make sure to exit after header redirection
           } else {
               header("location:success.php"); // Redirect to success page for Paytm
               exit; // Make sure to exit after header redirection
           }
       }
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
    <title>Checkout</title>
</head>
<body>
    <?php include './user_header.php' ?>
    
<div class="heading">
   <h3>checkout</h3>
   <p> <a href="home.php">home</a> / checkout </p>
</div>

<section class="display-order">
    <?php
    $grand_total=0;
    $cart_products[]='';
    $cart_query=mysqli_query($conn,"Select * from `cart` where user_id='$user_id'") or die("Mysqli_connection failed");
    if(mysqli_num_rows($cart_query)>0){
      while($cart_item=mysqli_fetch_assoc($cart_query)){
          $cart_products[]=$cart_item['name'].'('.$cart_item['quantity'];
          $sub_total=($cart_item['price']*$cart_item['quantity']);
          $cart_total+=$sub_total;
      }
    }
    $grand_total=$cart_total;
    $select_cart=mysqli_query($conn,"Select * from `cart` where user_id='$user_id'") or die('Query failed');
    if(mysqli_num_rows($select_cart)>0){
 while($fetch_cart=mysqli_fetch_assoc($select_cart)){
?>
<p><?php echo $fetch_cart['name']?><span>(<?php echo '$'.$fetch_cart['price'].'/-'.' x '. $fetch_cart['quantity'];  ?>)</span></p>


    <?php
 }}else{
        echo "<p class='empty'>Your cart is Empty..</p>";
    }
 ?>
 <div class="grand-total">
    grand-Total :  <span>$<?php echo $grand_total; ?>/-</span> </div>
 </div>
</section>
<section class="checkout">

   <form action="" method="post">
      <h3>place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>your name :</span>
            <input type="text" name="name" required placeholder="enter your name" value="<?php echo $name ?>" readonly>
         </div>
         <div class="inputBox">
            <span>your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>your email :</span>
            <input type="email" name="email" required placeholder="enter your email" value="<?php echo $email?>" readonly>
         </div>
         <div class="inputBox">
            <span>payment method :</span>
            <select name="method">
               <option value="paytm">paytm</option>
               <option value="paypal">Paypal</option>
               <option value="direct">Cash On delivery</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="number" min="0" name="flat" required placeholder="e.g. flat no.">
         </div>
         <div class="inputBox">
            <span>address line 01 :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>city :</span>
            <input type="text" name="city" required placeholder="e.g. mumbai">
         </div>
         <div class="inputBox">
            <span>state :</span>
            <input type="text" name="state" required placeholder="e.g. maharashtra">
         </div>
         <div class="inputBox">
            <span>country :</span>
            <input type="text" name="country" required placeholder="e.g. india">
         </div>
         <div class="inputBox">
            <span>pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
      </div>
      
      <input type="submit" value="order now" class="btn" name="order_btn">
   </form>

</section>

<?php include './user_footer.php'?>
    <script src="../js/script.js"></script>
</body>
</html>