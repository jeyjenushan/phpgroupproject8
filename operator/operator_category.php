<?php
include '../config.php';

session_start();

$operator_id = $_SESSION['operator_id'];

if(!isset($operator_id)){
    header('location:../login/login.php');
 }

if(isset($_POST['add_category'])){
    $categoryname=$_POST['name'];
    
    $selected_category_name=mysqli_query($conn,"Select * from `category` where name='$categoryname'") or die("Query failed");
    if(mysqli_num_rows($selected_category_name)>0){
        $message[]="Category name already exissts";
}
else{
    $add_category_query=mysqli_query($conn,"Insert into `category` (name) values ('$categoryname') ") or die("Query failed");

}
}

if(isset($_GET['delete'])){
    $deleted_id=$_GET['delete'];
    
    mysqli_query($conn,"DELETE FROM `category` where id='$deleted_id'") or die('query failed');
    header("location:operator_category.php");
}
if(isset($_POST["reset_category"])){
    header('location:operator_category.php');
}
if(isset($_POST['updated_category'])){
    $update_p_id = $_POST['update_p_id'];

    $updated_name = $_POST["update_name"];

    mysqli_query($conn, "UPDATE `category` SET name='$updated_name' WHERE id='$update_p_id'") or die("Query failed: " . mysqli_error($conn));

    header('Location: operator_category.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
<?php
    
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
    include 'operator_header.php';
    


    ?>

<section class="add-products">
    <h1 class="title">Category Information</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Add CATEGORY</h3>
        <input type="text" name="name" class="box" placeholder="Enter your category name" required>

        <input type="submit" name="add_category" class=" btn" value="ADD CATEGORY" required>
    </form>
</section>
<!--show products-->
<section class="show-products">
    <div class="box-container">
      <?php
      $select_products=mysqli_query($conn,"SELECT * FROM `category`") or die("Query failed");
      if(mysqli_num_rows($select_products)>0){
        while($fetch_products=mysqli_fetch_assoc($select_products)){
     ?>
     <div class="box">
       <div class="name"><?php echo $fetch_products['name'] ?></div> 
        
        <a href="operator_category.php?update=<?php echo $fetch_products['id']?>" class="option-btn">Update</a>
        <a href="operator_category.php?delete=<?php echo $fetch_products['id']?>" class="delete-btn" onclick="return confirm('Delete this Category?')">Delete</a> 
    </div>
            <?php
        }

      }
      else{
        echo '<p class="empty">No Category added yet!</p>';
      }
      ?>
    </div>
</section>
<!--update produts-->
<section class="edit-product-form">
<?php
if(isset($_GET['update'])){
    $updated_id=$_GET['update'];
    $update_query=mysqli_query($conn,"SELECT * FROM `category` where id ='$updated_id'") or die("Query failed");
if(mysqli_num_rows($update_query)>0){
    while($fetch_update=mysqli_fetch_assoc($update_query)){
?>
<form action="" method="POST" enctype='multipart/form-data'>
<input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id'] ?>">


=
  
    <input type="text" name="update_name" class="box" placeholder="Enter Category Name"  value="<?php echo $fetch_update['name']?>">
    <input type="submit" value="UPDATE" id="close-update" name="updated_category" class="option-btn">

   <input type="submit" value="CANCEL" id="close-update" name="reset_category" class="option-btn">
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

    <script src="../js/admin_script.js"></script>

</body>
</html>