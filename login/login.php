<?php
include "../config.php";
@session_start();

// Initialize the message array
$message = [];

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
// Display error or success messages
if (!empty($message)) {
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
        <form method="POST" action="">
            <h3>Login Now</h3>
            <input type="text" name="username" placeholder="Enter Username" autocomplete="off" class="box" required>
            <input type="password" name="password" placeholder="Enter password" autocomplete="off" class="box" required>
            <input type="submit" name="submit" value="Login Now" class="btn">
            <p><a href="forgot_password.php">Forgot your password?</a></p>
            <p>Don't have an account? <a href="register.php">Register now</a></p>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $userpassword = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check the user in the database
    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE name='$username' AND password='$userpassword'");

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

        $user_type = $row['user_type'] ?? 'admin'; // Default to admin if not set
        $_SESSION['user_type'] = $user_type;

        // Redirect based on user type
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
        // Add an error message for invalid credentials
        echo " jenushan";
        $message[] = 'Incorrect username or password!';
    }
}

// Restore session from cookies
if (!isset($_SESSION['user_email']) && isset($_COOKIE['session_id'])) {
    $session_id = $_COOKIE['session_id'];

    $select_user = mysqli_query($conn, "SELECT * FROM users WHERE session_id='$session_id'");

    if (mysqli_num_rows($select_user) > 0) {
        $row = mysqli_fetch_assoc($select_user);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];
        $user_type = $row['user_type'] ?? 'admin';
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
        // If session is invalid, clear the cookie
        setcookie("session_id", "", time() - 3600, "/");
        $message[] = 'Session expired. Please log in again.';
    }
}
?>

</body>
</html>