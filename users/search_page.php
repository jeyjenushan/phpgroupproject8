<?php
include '../config.php';
session_start();
$user_id=$_SESSION['user_id'];
if(!isset($user_id)){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/search_page.css">

    <title>Search page</title>
</head>
<body>
    <?php include './user_header.php' ?>
    <div class="heading">
   <h3>search page</h3>
   <p> <a href="home.php">home</a> / search </p>
</div>
<section class="search_page_content">
<?php
if(isset($_GET['submit'])){
    $search_item = $_GET['search_data'];
    $result = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%$search_item%'") or die("Query failed");
    if(mysqli_num_rows($result)>0){
while($fetch_product=mysqli_fetch_assoc($result)){
?>
<form action="" method="post" class="searchbox" >
<img src="../uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" class="image">
      <div class="name"><?php echo $fetch_product['name']; ?></div>
      <div class="price">Rs <?php echo $fetch_product['price']; ?>/-</div>
      <input type="number"  class="qty" name="product_quantity" min="1" value="1">
      <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
      <input type="submit" class="btn" value="add to cart" name="add_to_cart">

</form>

<?php
            }
         }else{
            echo '<p class="empty">no result found!</p>';
         }
      }else{
         echo '<p class="empty">search something!</p>';
      }
   ?>
</section>
<?php include './user_footer.php'?>
    <script src="../js/script.js"></script>
</body>
</html>