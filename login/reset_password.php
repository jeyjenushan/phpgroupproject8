<?php
include "../config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '
        <div class="message">
            <span>' . $msg . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}



?>

<div class="form-container">
    <div class="logo">
        <img src="../images/logo.png" width="30%" align="center">
        <form  method="POST" action="">
            <h3>Forget Password</h3>
            <input type="password" name="newPassword" placeholder="Enter your new password" autocomplete="off" class="box" required>
            <input type="password" name="cNewPassword" placeholder="Conform your new password" autocomplete="off" class="box" required>
            <input type="submit" name="submit" value="Reset Password Now" class="btn">
            <p><a href="login.php">Go back</a></p>
        </form>
    </div>
</div>

<?php  

if (isset($_POST['submit'])) {
    $newPassword=$_POST['newPassword'];
    $cNewPassword=$_POST['cNewPassword'];
    $username =$_GET['name'];

    if($newPassword!=$cNewPassword){
        $message[]='confirm password not matched';
     }
     else{
         mysqli_query($conn,"UPDATE `users` SET password='$newPassword' WHERE name='$username'") or die("query failed");
         $message[]="Password changed successfully!";
         header('location:login.php') ;   
     }
    }
?>

</body>
</html>
