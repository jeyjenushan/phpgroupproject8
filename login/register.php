<?php
include "../config.php";


if(isset($_POST['submit'])){
    $username=$_POST['name'];
    $useremail=$_POST['email'];
    $userpassword=$_POST['password'];
    $cpassword=$_POST['cpassword'];
  
    //CHECK THE USER AVAILABE OR NOT
    $select_users=mysqli_query($conn,"Select * from `users` where name='$username' and password='$userpassword'");
    if(mysqli_num_rows($select_users)>0){
        $message[]='user already exist!';
    }
    else{
        if($userpassword!=$cpassword){
           $message[]='confirm password not matched';
        }
        else{
            mysqli_query($conn,"Insert into `users` (name,email,password,user_type) values('$username','$useremail','$userpassword','user')") or die("query failed");
            $message[]="registered successfuly!";
            header('location:login.php') ;   
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php
if(isset($message)){
    foreach($message as $msg){
        echo '
        <div class="message">
        <span>'.$msg.'</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}

?>
    <div class="form-container">
    <div class="logo">
    <img src="../images/logo.png" width="30%" align:center>
         <form action="" method="post">
            <h3>Register Now</h3>
        <input type="text" name="name" placeholder="Enter your name" class="box" autocomplete="off" required> 
        <input type="email" name="email" placeholder="Enter your email" class="box" autocomplete="off" required>
        <input type="password" name="password" placeholder="Enter your password" autocomplete="off" class="box" required> 
        <input type="password" name="cpassword" placeholder="Confirm your password" class="box" autocomplete="off" required>
    <input type="submit" name="submit" value="Register Now" class="btn">
    <p>Already have an account? <a href="login.php">login now</a> </p>
    </form>
    </div>
    </div>
    
</body>
</html>