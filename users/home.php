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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/home_style.css">
    <title>Home</title>
</head>

<body>
    <?php include 'user_header.php' ?>
    <section class="home">
        <div class="content">
            <h3>Archeological designs in your hands.</h3>
            <p>your Creative Archeology Items are now real. all beautiful Books Post Cards, and Stamps in your hands.</p>
            <a href="about.php" class="white-btn">discover more</a>
        </div>
    </section>
    <script src="home.js"></script>

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
    $selected_product = mysqli_query($conn, "Select * from `products` where category_id='$id' ") or die('query failed');
    if (mysqli_num_rows($selected_product) > 0) {
        while ($fetched_products = mysqli_fetch_assoc($selected_product)) {
            $productname = $fetched_products['name'];
    ?>
            <div class="box">
                <form action="" method="POST">
                <a href="viewmore.php?productId=<?php echo $fetched_products['id'] ?>">
                    <img class="image" src="../uploaded_img/<?php echo $fetched_products['image'] ?>" alt="" style="width: 100%;height:80%; object-fit: contain" ;> </a>
                    <div class="name"><?php echo $fetched_products['name'] ?></div>
                    <div class="price">Rs <?php echo $fetched_products['price'] ?></div>
                   <div class="hidden" name="quantitys"> <label id=stocks_label>Stoks : </label><?php echo $fetched_products['quantity'] ?></div>
                    <label id=Qty_label>Qty : </label><input type="number" name="product_quantity" value=1 min=1 class="qty">
                    <input type="hidden" value="<?php echo $fetched_products['name'] ?>" name="product_name">
                    <input type="hidden" value="<?php echo $fetched_products['price'] ?>" name="product_price">
                    <input type="hidden" value="<?php echo $fetched_products['image'] ?>" name="product_image">
                    <input type="hidden" name="quantitys" value="<?php echo $fetched_products['quantity'] ?>" name="product_image">

<br>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">

                </form>
                <!-- <a href="viewmore.php?productId=<?php echo $fetched_products['id'] ?>"> -->
                    <!-- <input type="submit" value="Info" name="viewmore" class="option-btn"> -->
               
            </div>

    <?php

        }
    } else {
        echo '<p class="empty">No Products added yet</p>';
    }
    ?>
</div>


<div class="load-more" style="margin-top: 2rem; text-align:center">
    <a href="shop.php?id=<?php echo $id ?>" class="option-btn">load more</a>
</div>
</div>
        </div>

        <?php
    }
?>

                
       
      
    </section>




    <section class="about">
    <div class="flex">
        <div class="image">
            <img id="about-photo"src="../images/logo.png" alt="">
                
        </div>
        <div class="content">
            <h3>about us</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia corporis ratione saepe sed adipisci?</p>
            <a href="about.php" class="btn">read more</a>
        </div>
    </div>
</section>

<script src="script.js"></script>




    <section class="home-contact">

        <div class="content">
            <h3>have any questions?</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet ullam voluptatibus?</p>
            <a href="contact.php" class="white-btn">contact us</a>
        </div>

    </section>

    </div>


    <?php include 'user_footer.php' ?>
    <script src="../js/script.js"></script>
</body>

</html>