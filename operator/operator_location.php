<?php
include '../config.php';

session_start();

$operator_id = $_SESSION['operator_id'];

if(!isset($operator_id)){
    header('location:../login/login.php');
 }
 
if(isset($_POST['add_location'])){
    $locationname=$_POST['location'];
    $shopname=$_POST['sname'];
    $product_image1=$_FILES['productimage1']['name'];
    $product_image_size1=$_FILES['productimage1']['size'];
    $product_image_tmp1=$_FILES['productimage1']['tmp_name'];
    $product_image2=$_FILES['productimage2']['name'];
    $product_image_size2=$_FILES['productimage2']['size'];
    $product_image_tmp2=$_FILES['productimage2']['tmp_name'];
    $product_image3=$_FILES['productimage3']['name'];
    $product_image_size3=$_FILES['productimage3']['size'];
    $product_image_tmp3=$_FILES['productimage3']['tmp_name'];
    $image_folder1="../uploaded_img/".$product_image1;
    $image_folder2="../uploaded_img/".$product_image2;
    $image_folder3="../uploaded_img/".$product_image3;
    $selected_shop_name=mysqli_query($conn,"Select * from `shopdetail` where name='$shopname'") or die("Query failed");
    if(mysqli_num_rows($selected_shop_name)>0){
        $message[]="shop name already exissts";
}
else{
    $add_product_query=mysqli_query($conn,"Insert into `shopdetail` (location,name,shop_image1,shop_image2,shop_image3) values('$locationname','$shopname','$product_image1','$product_image2','$product_image3') ") or die("Query failed");
    if($add_product_query){
        if( $product_image_size1>2000000 || $product_image_size2>2000000 || $product_image_size3>2000000 ){
            $message[]="Image size is too large";
        }
        else{
        move_uploaded_file($product_image_tmp1,$image_folder1);
        move_uploaded_file($product_image_tmp2,$image_folder2);
        move_uploaded_file($product_image_tmp3,$image_folder3);
        $message[]="Shop details added successfully";
        }
    }
    else{
        $message[]="shop could not be added ";
    }

}
}
//delete prodducts
if(isset($_GET['delete'])){
    $deleted_id=$_GET['delete'];
    $deleted_img_query=mysqli_query($conn,"SELECT * FROM `shopdetail` where id=$deleted_id");
    $fetch_delete_image=mysqli_fetch_assoc($deleted_img_query);
    unlink('../uploaded_img/'.$fetch_delete_image['shop_image1']);
    unlink('../uploaded_img/'.$fetch_delete_image['shop_image2']);
    unlink('../uploaded_img/'.$fetch_delete_image['shop_image3']);
    mysqli_query($conn,"DELETE FROM `shopdetail` where id='$deleted_id'") or die('query failed');
    header("location:operator_location.php");
}
if(isset($_POST["reset_location"])){
    header('location:operator_location.php');
}
//update products

if(isset($_POST['updated_product'])){
    $update_p_id = $_POST['update_p_id'];

    $updated_name = $_POST["update_name"];
    $location_name = $_POST["update_location"];
    mysqli_query($conn, "UPDATE `shopdetail` SET name='$updated_name', location='$location_name' WHERE id='$update_p_id'") or die("Query failed: " . mysqli_error($conn));

    // Handle image uploads
    $images = [
        ['input_name' => 'update_img1', 'old_image' => $_POST['update_old_image1']],
        ['input_name' => 'update_img2', 'old_image' => $_POST['update_old_image2']],
        ['input_name' => 'update_img3', 'old_image' => $_POST['update_old_image3']]
    ];

    $image_updated = false;

    foreach($images as $index => $image) {
        $image_name = $_FILES[$image['input_name']]['name'];
        $image_tmp_name = $_FILES[$image['input_name']]['tmp_name'];
        $image_size = $_FILES[$image['input_name']]['size'];
        $image_folder = '../uploaded_img/'.$image_name;

        if(!empty($image_name)){
            // Validate image size
            if($image_size > 2000000){
                $message[] = "Image file size for " . $image['input_name'] . " is too large.";
                continue;
            }

            // Update the database with the new image
            $image_field = "shop_image" . ($index + 1);
            $update_query = "UPDATE `shopdetail` SET $image_field='$image_name' WHERE id='$update_p_id'";
            if(mysqli_query($conn, $update_query)){
                // Move the new image file to the server
                move_uploaded_file($image_tmp_name, $image_folder);

                // Delete the old image file from the server
                unlink('../uploaded_img/'.$image['old_image']);

                $image_updated = true;
            } else {
                die("Query failed: " . mysqli_error($conn));
            }
        }
    }

    if($image_updated) {
        $message[] = "Product images updated successfully.";
    } else {
        $message[] = "No new images were uploaded.";
    }

    header('Location: operator_location.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/operator_style.css">
</head>
<body>
<?php
    

    include 'operator_header.php';
    


    ?>
<!--product crud system start-->
<!--add products-->
<section class="add-products">
    <h1 class="title">Shop Locations</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Add Shop Details</h3>
        <input type="text" name="location" class="box" placeholder="Enter your location name" required>
        <input type="text" name="sname" class="box" placeholder="Enter your shop name" required>
        <input type="file" name="productimage1" class="box" placeholder="Enter your shop image1" required>
        <input type="file" name="productimage2" class="box" placeholder="Enter your shop image2" required>
        <input type="file" name="productimage3" class="box" placeholder="Enter your shop image3" required>
        <input type="submit" name="add_location" class=" btn" value="ADD LOCATION" required>
    </form>
</section>
<!--show products-->
<section class="show-products">
    <div class="box-container">
      <?php
      $select_products=mysqli_query($conn,"SELECT * FROM `shopdetail`") or die("Query failed");
      if(mysqli_num_rows($select_products)>0){
        while($fetch_products=mysqli_fetch_assoc($select_products)){
     ?>
     <div class="box">
        <img src="../uploaded_img/<?php echo $fetch_products['shop_image1'] ?>">
       <div class="name"><?php echo $fetch_products['name'] ?></div> 
        <div class="location"><?php echo  $fetch_products['location'] ?></div>
        <a href="operator_location.php?update=<?php echo $fetch_products['id']?>" class="option-btn">Update</a>
        <a href="operator_location.php?delete=<?php echo $fetch_products['id']?>" class="delete-btn" onclick="return confirm('Delete this product?')">Delete</a> 
    </div>
            <?php
        }

      }
      else{
        echo '<p class="empty">No Location added yet!</p>';
      }
      ?>
    </div>
</section>
<!--update produts-->
<section class="edit-product-form">
<?php
if(isset($_GET['update'])){
    $updated_id=$_GET['update'];
    $update_query=mysqli_query($conn,"SELECT * FROM `shopdetail` where id ='$updated_id'") or die("Query failed");
if(mysqli_num_rows($update_query)>0){
    while($fetch_update=mysqli_fetch_assoc($update_query)){
?>
<form action="" method="POST" enctype='multipart/form-data'>
<input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id'] ?>">
<input type="hidden" name="update_old_image1" value="<?php echo $fetch_update['shop_image1'] ?>">
<input type="hidden" name="update_old_image2" value="<?php echo $fetch_update['shop_image2'] ?>">
<input type="hidden" name="update_old_image3" value="<?php echo $fetch_update['shop_image3'] ?>">


    <img src="../uploaded_img/<?php echo $fetch_update['shop_image1'] ?>">
  
    <input type="text" name="update_name" class="box" placeholder="Enter shop Name"  value="<?php echo $fetch_update['name']?>">
    <input type="text" name="update_location"  class="box" placeholder="Enter location name"   value="<?php echo $fetch_update['location']?>">
    <input type="file" class="box" name="update_img1" >
    <input type="file" class="box" name="update_img2" >
    <input type="file" class="box" name="update_img3" >
   <input type="submit" value="UPDATE" name="updated_product" class="btn">
   <input type="submit" value="CANCEL" id="close-update" name="reset_location" class="option-btn">
</form>
<?php
    }
}
}
else{
    echo '<script>document.querySelector(".edit-product-form").style.display="none";</script>';

}
?>

</section>

<!--product crud system ends-->



    <!--custom js file-->
    <script src="../js/admin_script.js"></script>

</body>
</html>