<?php
require "../config.php";
session_start();
$user_id=$_SESSION['user_id'];
$name=$_SESSION['user_name'];
$email=$_SESSION['user_email'];

if(!isset($user_id)){
    header('location:../login/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
    <title>Checkout</title>
    <style>
        .order-success {
    text-align: center;              
    background-color: #28a745;      
    color: #fff;                   
    padding: 15px 20px;            
    font-weight: bold;             
    border-radius: 8px;           
    margin: 20px auto;               
    max-width: 600px;             
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}
    </style>
</head>
<body>
    <?php include './user_header.php' ?>
    


<h1 class="order-success">Your Order has been successfully placed!</h1>
<?php
echo "<script>
    setTimeout(() => {
        window.location.href = 'home.php';
    }, 2000);
</script>";
?>

</body>
</html>