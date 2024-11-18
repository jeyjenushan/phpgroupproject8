<?php
include "../config.php";

if (isset($_POST['submit'])) {
    $useremail = $_POST['email'];

    // Check if the email exists
    $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$useremail'");

    if (mysqli_num_rows($select_user) > 0) {
        $row = mysqli_fetch_assoc($select_user);
        $token = bin2hex(random_bytes(50)); // Generate a unique token

        // Store token in the database (you may want to add a column for it)
        $update_token = mysqli_query($conn, "UPDATE `users` SET reset_token='$token' WHERE id='" . $row['id'] . "'");

        // Send the email with the reset link
        $to = $useremail;
        $subject = "Password Reset Request";
        $message = "Click the link below to reset your password:\n";
        $message .= "http://yourwebsite.com/reset_password.php?token=$token";
        $headers = "From: no-reply@yourwebsite.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "Reset link has been sent to your email.";
        } else {
            echo "Failed to send email.";
        }
    } else {
        echo "No account found with that email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>
    <form action="" method="post">
        <h3>Forgot Password</h3>
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="submit" name="submit" value="Send Reset Link">
    </form>
</body>
</html>