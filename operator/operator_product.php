<?php
require_once '../config.php';
session_start();
$operator_id = $_SESSION['operator_id'];

if(!isset($operator_id)){
    header('location:../login/login.php');
}

if(isset($_POST['add_product'])){
    $name=$_POST['name'];
    $price=$_POST['price'];
    $product_image=$_FILES['productimage']['name'];
    $product_image_size=$_FILES['productimage']['size'];
    $product_image_tmp=$_FILES['productimage']['tmp_name'];
    
    $quantity=$_POST['quantity'];
    $category_id=$_POST['method'];
    $image_folder="../uploaded_img/".$product_image;
    $selected_product_name=mysqli_query($conn,"Select * from `products` where name='$name'") or die("Query failed");
    if(mysqli_num_rows($selected_product_name)>0){
        $message[]="Product name already exissts";
}
else{
    global $conn;

    
    
    $add_product_query=mysqli_query($conn,"Insert into `products` (name,price,image,quantity,category_id) values('$name','$price','$product_image','$quantity',' $category_id') ") or die("Query failed");
    if($add_product_query){
        if( $product_image_size>20000000){
            $message[]="Image size is too large";
        }
        else{
        move_uploaded_file($product_image_tmp,$image_folder);
        $message[]="product added successfully";
        $product_id = mysqli_insert_id($conn);
        if (isset($_POST['shopname']) && is_array($_POST['shopname'])) {
            foreach ($_POST['shopname'] as $shop_id) {
                $shop_id = (int) $shop_id;  
                mysqli_query($conn, "INSERT INTO productshop (product_id, shop_id) VALUES ('$product_id', '$shop_id')") or die("Query failed");
            }
            $message[] = "Product added successfully with multiple shops!";
        } else {
            $message[] = "No shop selected.";
        }
        }
    }
    else{
        $message[]="product could not be added ";
    }}

}

//delete prodducts
if(isset($_GET['delete'])){
    $deleted_id=$_GET['delete'];
    $deleted_img_query=mysqli_query($conn,"SELECT * FROM `products` where id=$deleted_id");
    $fetch_delete_image=mysqli_fetch_assoc($deleted_img_query);
    unlink('../uploaded_img/'.$fetch_delete_image['image']);
    mysqli_query($conn,"DELETE FROM `products` where id='$deleted_id'") or die('query failed');
    mysqli_query($conn,"DELETE FROM `productshop` where product_id='$deleted_id' ");
    header("location:operator_product.php");
}
//update products

if(isset($_POST['updated_product'])){
    $update_p_id=$_POST['update_p_id'];

    $updated_name=$_POST["update_name"];
    $updated_price=$_POST["update_price"];
    $update_quantity=$_POST["update_quantity"];
    $update_category=$_POST["update_category"];
    mysqli_query($conn, "DELETE FROM productshop WHERE product_id = '$update_p_id'") or die("Query failed");
    if (isset($_POST['shopname']) && is_array($_POST['shopname'])) {
        foreach ($_POST['shopname'] as $shop_id) {
            $shop_id = (int) $shop_id;  // Make sure it's an integer for security
            mysqli_query($conn, "INSERT INTO productshop (product_id, shop_id) VALUES ('$update_p_id', '$shop_id')") or die("Query failed");
        }
    }
        
    
    mysqli_query($conn,"UPDATE `products` SET name='$updated_name',price='$updated_price',quantity='$update_quantity', category_id=$update_category  where id=$update_p_id") or die("query failed");
    $update_image=$_FILES['update_img']['name'];
    $update_image_tmp_name=$_FILES['update_img']['tmp_name'];
    $update_image_size=$_FILES['update_img']['size'];
    $update_folder='../uploaded_img/'.$update_image;
    $update_old_image=$_POST['update_old_image'];

    if(!empty($update_image)){
        if($update_image_size >2000000){
            $message[]="Image file size is too large";
        }
        else{
            mysqli_query($conn,"UPDATE `products` SET image='$update_image' where id=$update_p_id") or die("query failed");  
            move_uploaded_file($update_image_tmp_name,$update_folder);
            unlink('../uploaded_img/'.$update_old_image);}}
         

 
    header('location:operator_product.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/dropdown.css">
    
    
</head>
<body>
<?php


    include 'operator_header.php';
    


    ?>
<!--product crud system start-->
<!--add products-->
<section class="add-products">
    <h1 class="title">Shop Products</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Add Products</h3>
        <input type="text" name="name" class="box" placeholder="Enter your product name" required>
        <input type="number"min=0  name="price" class="box" placeholder="Enter your price" required>
        <input type="file" name="productimage" class="box" placeholder="Enter your product image" required>
        <input type="number"min=0  name="quantity" class="box" placeholder="Enter your Quantity" required>
 
        <div class="box">
            <span>Category :</span>
            <select name="method" required>
            <option value="">Enter your Category name</option>
<?php
$result=mysqli_query($conn,"Select * from `category`");
while($row=mysqli_fetch_array($result)){
    $id=$row['id'];
    
    $name=$row['name'];
    ?>
    <option value=<?php echo $id?>><?php echo $name?></option>

    <?php
     
}

?>
            </select>
         </div>
         <div class="custom-select">
        <button type="button" class="select-btn" >Select Shops</button>
        <div class="select-dropdown">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM `shopdetail`");
            while ($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $name = $row['location'];
                ?>
                <label>
                    <input type="checkbox" name="shopname[]" value="<?php echo $id; ?>"> <?php echo $name; ?>
                </label><br>
                <?php
            }
            ?>
        </div>
    </div><br><br><br>
    
        <input type="submit" name="add_product" class=" btn" value="ADD PRODUCT" required>
    </form>
</section>
<!--show products-->
<section class="show-products">
    <div class="box-container">
      <?php
      $select_products=mysqli_query($conn,"SELECT * FROM `products`") or die("Query failed");
      if(mysqli_num_rows($select_products)>0){
        while($fetch_products=mysqli_fetch_assoc($select_products)){
     ?>
     <div class="box">
        <img src="../uploaded_img/<?php echo $fetch_products['image'] ?>">
       <div class="name"><?php echo $fetch_products['name'] ?></div> 
       <?php
$id=$fetch_products['category_id'];
$productid=$fetch_products['id'];
$select_query="Select * from `category` where id='$id'";
$result=mysqli_query($conn,$select_query);
$row=mysqli_fetch_array($result);
$name=$row['name'];

       ?>
                           <div class="shops">
                        <strong>Available in Shops:</strong>
                        <ul>
                            <?php
                            $shop_query = mysqli_query($conn, "SELECT shopdetail.location FROM shopdetail 
                                                               JOIN productshop ON shopdetail.id = productshop.shop_id 
                                                               WHERE productshop.product_id = '$productid'") 
                                                               or die("Query failed");
                                                               
                            if(mysqli_num_rows($shop_query)>0){
                         
                            while ($shop = mysqli_fetch_assoc($shop_query)) {
                       
                                echo  $shop['location'] ."<br>";
                            }}
                           
                            ?>
                        </ul>
                    </div>
          <div class="name">Category : <?php echo  $name ?></div>
        <div class="price">Price : <?php echo "$". $fetch_products['price'] ."/-" ?></div>
        <div class="price">Quantity : <?php echo  $fetch_products['quantity'];?></div>
        <?php if($fetch_products['quantity'] < 5){ 
         echo "<script>window.prompt($name"."is low stock level product" ."the level is ".$fetch_products['quantity'].")</script>";
         } 

         
    

    ?>


        <a href="operator_product.php?update=<?php echo $fetch_products['id']?>" class="option-btn">Update</a>
        <a href="operator_product.php?delete=<?php echo $fetch_products['id']?>" class="delete-btn" onclick="return confirm('Delete this product?')">Delete</a> 
    </div>
            <?php
          
        }}
      else{
        echo '<p class="empty">No product added yet!</p>';
      }


   
      ?>
    </div>
</section>
<!--update produts-->
<section class="edit-product-form">
<?php
if (isset($_GET['update'])) {
    $updated_id = $_GET['update'];
    $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id ='$updated_id'") or die("Query failed");

    // Fetch associated shops
    $associated_shops_query = mysqli_query($conn, "SELECT shop_id FROM productshop WHERE product_id = '$updated_id'");
    $associated_shops = [];
    while ($row = mysqli_fetch_assoc($associated_shops_query)) {
        $associated_shops[] = $row['shop_id'];
    }

    if (mysqli_num_rows($update_query) > 0) {
        while ($fetch_update = mysqli_fetch_assoc($update_query)) {
            ?>
            <form action="" method="POST" enctype='multipart/form-data'>
                <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
                <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">

                <img src="../uploaded_img/<?php echo $fetch_update['image']; ?>">
                <input type="text" name="update_name" class="box" placeholder="Enter Product Name" value="<?php echo $fetch_update['name']; ?>">
                <input type="number" name="update_price" min='0' class="box" placeholder="Enter Product Price" value="<?php echo $fetch_update['price']; ?>">
                <input type="number" name="update_quantity" min='0' class="box" placeholder="Enter Product Quantity" value="<?php echo $fetch_update['quantity']; ?>">

                <select name="update_category" id="">
                    <?php
                    echo "<option value='{$fetch_update['category_id']}'>{$name}</option>";
                    $result = mysqli_query($conn, "SELECT * FROM `category`");
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        ?>
                        <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php
                    }
                    ?>
                </select>
                
                <div class="custom-select">
                    <button type="button" id="select-btn">Select Shops</button>
                    <div id="select-dropdown" style="display: none;"> <!-- Initially hidden -->
                        <?php
                        // Fetch all shops from the database
                        $result = mysqli_query($conn, "SELECT * FROM `shopdetail`");
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['id'];
                                $name = $row['location'];
                                ?>
                                <label>
                                    <input type="checkbox" name="shopname[]" value="<?php echo htmlspecialchars($id); ?>" 
                                    <?php echo in_array($id, $associated_shops) ? 'checked' : ''; ?>> 
                                    <?php echo htmlspecialchars($name); ?>
                                </label><br>
                                <?php
                            }
                        } else {
                            echo '<p>Error fetching shops.</p>';
                        }
                        ?>
                    </div>
                </div>        
                <input type="file" class="box" name="update_img">
                <input type="submit" value="UPDATE" name="updated_product" class="btn">
                <input type="reset" value="CANCEL" id="close-update" class="option-btn">
            </form>
            <?php
        }
    }
} else {
    echo '<script>document.querySelector(".edit-product-form").style.display="none";</script>';
}
?>
</section>


<!--product crud system ends-->



    <!--customer add js file-->
    <script src="../js/admin_script.js"></script>
    <script src="../js/shopproduct.js"></script>

</body>
</html>