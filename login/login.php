<?php
include "../config.php";
@session_start(); 

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['name']);
    $userpassword = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the user exists
    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE name='$username' AND password='$userpassword'");


    if (mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);

        // Generate a secure session ID
        $session_id = bin2hex(random_bytes(32));
        $user_id = $row['id'];

        // Update session ID in the database
        $update_session = mysqli_query($conn, "UPDATE users SET session_id='$session_id' WHERE id='$user_id'");

        // Set session and cookies
        setcookie("session_id", $session_id, time() + (7 * 24 * 60 * 60), "/");
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];

        $user_type = $row['user_type'];
        $_SESSION['user_type'] = $user_type;

        if ($user_type === 'admin') {
            header('location:../admin/admin_page.php');
            exit();
        } elseif ($user_type === 'user') {
            header('location:../users/home.php');
            exit();
        } elseif ($user_type === 'operator') {
            header('location:../operator/operator_page.php');
            exit();
        }
    } else {
        $message[] = 'Incorrect email or password!';
    }
}

//start a new session if cookies found but session hasn't started yet
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
        } elseif ($user_type == 'user') {
            header('location:../users/home.php');
        } elseif ($user_type == 'operator') {
            header('location:../operator/operator_page.php');
        }
        
    } else {
        // Invalid session ID, clear the cookie
        setcookie("session_id", "", time() - 3600, "/");
        $message[] = 'Session expired. Please login again.';
    }
}

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
    foreach ($message as $msg) {
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
        <img src="../images/logo.png" width="30%" align="center">
        <form  method="POST" action="">
            <h3>Login Now</h3>
            <input type="text" name="name" placeholder="Enter your username"  class="box" required>
            <input type="password" name="password" placeholder="Enter your password" class="box" required> 
            <input type="submit" name="submit" value="Login Now" class="btn">
            <p><a href="forget_password.php">Forgot your password ?</a></p><br>
            <p>Don't have an account? <a href="register.php">Register now</a></p>
        </form>
    </div>
</div>

</body>
</html>