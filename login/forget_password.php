<?php
include "../config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
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
            <input type="text" name="name" placeholder="Enter your username" autocomplete="off" class="box" required>
            <input type="email" name="email" placeholder="Enter your email" autocomplete="off" class="box" required>
            <input type="submit" name="submit" value="Reset Password" class="btn">
            <p><a href="login.php">Go back</a></p>
        </form>
    </div>
</div>

<?php  

if (isset($_POST['submit'])) {
    $useremail = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['name']);

    // Check if the user exists
    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$useremail' AND name='$username'");
  

    if (mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);
            header('location:reset_password.php?name='.$username);
        }
    else {
        $message[] = 'Incorrect email or password!';
    }
}

?>

</body>
</html>
