<?php

include "../config.php";
@session_start();

if (isset($_POST['submit'])) {
    $useremail = $_POST['email'];
    $userpassword = md5($_POST['password']);

    // Check if the user exists
    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$useremail' AND password='$userpassword'");

    if (mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);

        // Generate a session ID and store it in the database
        $session_id = bin2hex(random_bytes(32)); // Generate a random session ID
        $user_id = $row['id'];

        // Store session ID in the database
        $update_session = mysqli_query($conn, "UPDATE `users` SET session_id='$session_id' WHERE id='$user_id'");

        // Set session ID in an HTTP-only cookie
        setcookie("session_id", $session_id, time() + (7 * 24 * 60 * 60), "/", "", true, true); // HTTP-only and Secure for HTTPS

        // Store user details in session for server-side use
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_type'] = $row['user_type'];

        // Redirect based on user type
        if ($row['user_type'] === 'admin') {
            header('location:../admin/admin_page.php');
        } elseif ($row['user_type'] === 'user') {
            header('location:../users/home.php');
        } elseif ($row['user_type'] === 'operator') {
            header('location:../operator/operator_page.php');
        }
    } else {
        $message[] = 'Incorrect email or password!';
    }
}

// Automatically log in if valid session ID cookie is found
if (!isset($_SESSION['user_email']) && isset($_COOKIE['session_id'])) {
    $session_id = $_COOKIE['session_id'];

    // Check session ID in the database
    $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE session_id='$session_id'");

    if (mysqli_num_rows($select_user) > 0) {
        $row = mysqli_fetch_assoc($select_user);

        // Store user info in session based on session ID from the database
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_type'] = $row['user_type'];

        // Redirect based on user type
        if ($row['user_type'] === 'admin') {
            header('location:../admin/admin_page.php');
        } elseif ($row['user_type'] === 'user') {
            header('location:../users/home.php');
        } elseif ($row['user_type'] === 'operator') {
            header('location:../operator/operator_page.php');
        }
    } else {
        // Invalid session ID, clear the cookie
        setcookie("session_id", "", time() - 3600, "/");
        $message[] = 'Session expired. Please log in again.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Font Awesome CDN Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <form action="" method="post">
            <h3>Login Now</h3>
            <input type="email" name="email" placeholder="Enter Email" class="box" required>
            <input type="password" name="password" placeholder="Enter password" class="box" required> 
            <input type="submit" name="submit" value="Login Now" class="btn">
            <p>Don't you have an account? <a href="register.php">Register now</a></p>
        </form>
    </div>
</div>

</body>
</html>
