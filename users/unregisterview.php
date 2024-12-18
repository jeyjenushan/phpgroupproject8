<?php
include '../config.php';




if (isset($_POST['add_to_cart'])) {
    if(isset($_SESSION['user_id'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST["product_quantity"];
    $product_image = $_POST["product_image"];
    $quantity = $_POST["quantitys"];
    if ($quantity < $product_quantity) {
        $message[] = 'Not enough stock available!';
    } else {
        $quantity -= $product_quantity;
        $updateproduct = mysqli_query($conn, "Update `products` set quantity='$quantity'");
        $check_cart_numbers = mysqli_num_rows(mysqli_query($conn, "Select * from `cart` where name='$product_name' and user_id='$user_id' "));
        if ($check_cart_numbers > 0) {
            $message[] = 'already added to cart!';
        } else {
            $insert_cart = mysqli_query($conn, "Insert into `cart` (user_id,name,price,quantity,image) values('$user_id','$product_name','$product_price',' $product_quantity','$product_image')");
            $message[] = 'product added to cart!';
        }
    }

}
else{
    header("location:../login/login.php");
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
    <link rel="stylesheet" href="../css/unregisterview.css">
    <title>Home</title>
</head>

<body>
<header class="header">
<div class="header-1">
        <div class="flex">
            <div class="share">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin"></a>
            </div>
         
        </div>
    </div>
</header>

  
    <section class="home">
        <div class="content">
            <h3>Archeological designs in your hands.</h3>
            <p>So.Hurry up..<br>You are New to this..<br>Register Now</p>
            <a href="../login/login.php" class="white-btn">Register Now</a>
        </div>
    </section>



    <section class="products">
        <div class="container">

<?php
    $select_category=mysqli_query($conn,"select * from `category` ");
    while($row=mysqli_fetch_assoc($select_category)){
        ?>
                    <div class="main-content">
<h1 class="title">Latest <?php echo $row['name']?></h1>

<div class="box-container">
    <?php
$id=$row['id'];
    $selected_product = mysqli_query($conn, "Select * from `products` where category_id='$id' limit 1,3 ") or die('query failed');
    if (mysqli_num_rows($selected_product) > 0) {
        while ($fetched_products = mysqli_fetch_assoc($selected_product)) {
            $productname = $fetched_products['name'];
    ?>
            <div class="box">
                <form action="" method="POST">
                    <img class="image" src="../uploaded_img/<?php echo $fetched_products['image'] ?>" alt="" style="width: 100%;height:80%;
object-fit: contain" ;>
                    <div class="name"><?php echo $fetched_products['name'] ?></div>
                    <div class="price"><?php echo $fetched_products['price'] ?></div>
                    <!-- <div class="hidden" name="quantitys"><?php echo $fetched_products['quantity'] ?></div> -->
                    <!-- <input type="number" name="product_quantity" value=1 min=1 class="qty"> -->
                    <input type="hidden" value="<?php echo $fetched_products['name'] ?>" name="product_name">
                    <input type="hidden" value="<?php echo $fetched_products['price'] ?>" name="product_price">
                    <input type="hidden" value="<?php echo $fetched_products['image'] ?>" name="product_image">
                    <input type="hidden" name="quantitys" value="<?php echo $fetched_products['quantity'] ?>" name="product_image">

                    <a href="../login/login.php"><input type="button"value="Add to cart" name="add_to_cart" class="btn"></input></a>

                </form>
   
                <a href="viewmore.php?productId=<?php echo $fetched_products['id'] ?>">
                    <!-- <input type="submit" value="view more" name="viewmore" class="option-btn"> -->
                </a>
        
            </div>

    <?php

        }
    } else {
        echo '<p class="empty">No Products added yet</p>';
    }
    ?>
</div>
<div class="load-more" style="margin-top: 2rem; text-align:center">
    <a href="../login/login.php" class="option-btn">load more</a>
</div>
</div>
        </div>

        <?php
    }
?>

                
       
      
    </section>

<script src="script.js"></script>


    <section class="home-contact">

        <div class="content">
            <h3>have any questions?</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet ullam voluptatibus?</p>
            <a href="../login/login.php" class="white-btn">contact us</a>
        </div>

    </section>

    </div>


    <?php include 'user_footer.php' ?>
    <script src="../js/script.js"></script>
</body>

</html>