<?php
include "../config.php";
@session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
            <span>' . $message . '</span>
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
            <h3>Login Now</h3>
            <input type="email" name="email" placeholder="Enter Email" autocomplete="off"  class="box" required>
            <input type="password" name="password" placeholder="Enter password" autocomplete="off" class="box" required> 
            <input type="submit" name="submit" value="Login Now" class="btn">
            <p>Don't have an account? <a href="register.php">Register now</a></p>
        </form>
    </div>
</div>

<?php  

if (isset($_POST['submit'])) {
    $useremail = mysqli_real_escape_string($conn, $_POST['email']);
    $userpassword = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the user exists
    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$useremail' AND password='$userpassword'");
  

    if (mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);
       
        $session_id = bin2hex(random_bytes(32));
        $user_id = $row['id'];

        $update_session = mysqli_query($conn, "UPDATE `users` SET session_id='$session_id' WHERE id='$user_id'");

        
        setcookie("session_id", $session_id, time() + (7 * 24 * 60 * 60), "/");

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];

        $user_type = $row['user_type'] ?? 'admin';
        $_SESSION['user_type'] = $user_type;

        if ($user_type === 'admin') {
            header('location:../admin/admin_page.php');
        } elseif ($user_type === 'user') {
            header('location:../users/home.php');
        } elseif ($user_type === 'operator') {
            header('location:../operator/operator_page.php');
        }
    } else {
        $message[] = 'Incorrect email or password!';
    }
}


if (!isset($_SESSION['user_email']) && isset($_COOKIE['session_id'])) {
    $session_id = $_COOKIE['session_id'];


    $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE session_id='$session_id'");

    if (mysqli_num_rows($select_user) > 0) {
        $row = mysqli_fetch_assoc($select_user);


        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_type'] = $row['user_type'];
     
        // Redirect based on user type
        if ($user_type == 'admin') {
            header('location:../admin/admin_page.php');
              // Ensure no further code is executed after redirection
        } elseif ($user_type == 'user') {
            header('location:../users/home.php');
        } elseif ($user_type == 'operator') {
            header('location:../operator/operator_page.php');
        }
        
    } else {
        // Invalid session ID, clear the cookie
        setcookie("session_id", "", time() - 3600, "/");
        $message[] = 'Session expired. Please log in again.';
    }
}

?>

</body>
</html>
