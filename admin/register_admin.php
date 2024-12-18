<?php
include '../config.php';
session_start();
$admin_id = $_SESSION['user_id'];

if(!isset($admin_id)){
   header('location:../login/login.php');
}
?>

<?php

if(isset($_POST['submit'])){
    $username=$_POST['name'];
    $useremail=$_POST['email'];
    $userpassword=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $usertype=$_POST['user_type'];
    //CHECK THE USER AVAILABE OR NOT
    $select_users=mysqli_query($conn,"Select * from `users` where email='$useremail' and password='$userpassword'");
    if(mysqli_num_rows($select_users)>0){
        $message[]='user already exist!';
    }
    else{
        if($userpassword!=$cpassword){
           $message[]='confirm password not matched';
        }
        else{
  mysqli_query($conn,"Insert into `users` (name,email,password,user_type) values('$username','$useremail','$cpassword','$usertype')") or die("query failed");
$message[]="registered successfuly!";
header('location:register_admin.php') ;   
}}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/admin_style.css">
    <link rel="stylesheet" href="../css/style.css">
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
    include 'admin_header.php';
    ?>
   
    <div class="form-container">
    <div class="logo">
    <img src="../images/logo.png" width="30%" align:center>
         <form action="" method="post">
            <h3>Register Users</h3>
        <input type="text" name="name" placeholder="Enter user name" class="box" autocomplete="off" required> 
        <input type="email" name="email" placeholder="Enter user email" class="box" autocomplete="off" required>
        <input type="password" name="password" placeholder="Enter user password" autocomplete="off" class="box" required> 
        <input type="password" name="cpassword" placeholder="confirm user password" class="box" autocomplete="off" required>
    <select name="user_type" class="box">
        <option value="admin">admin</option>
        <option value="operator">operator</option>
    </select>
    <input type="submit" name="submit" value="Register Now" class="btn">
    </form>
    </div>
    </div>

    <script src="../js/admin_script.js"></script>

</body>
</html>