<?php

include "../config.php";
@session_start();


//INSERT THE DATA
if(isset($_POST['submit'])){
  $username=$_POST['name'];
  $userpassword=md5($_POST['password']);
  //CHECK THE USER AVAILABE OR NOT
  $select_users=mysqli_query($conn,"Select * from `users` where name='$username' and password='$userpassword'");
  if(mysqli_num_rows($select_users)>0){
    $row=mysqli_fetch_assoc($select_users);
    if($row['user_type'] === 'admin'){
      $_SESSION['admin_name']=$row['name'];
      $_SESSION['admin_email']=$row['email'];
      $_SESSION['admin_id']=$row['id'];
      header('location:../admin/admin_page.php');
    }
    elseif($row['user_type']  === 'user'){
      $_SESSION['user_name']=$row['name'];
      $_SESSION['user_email']=$row['email'];
      $_SESSION['user_id']=$row['id'];
<<<<<<< HEAD
      header('location:../users/home.php');

=======
      header('location:home.php');
    }
    elseif($row['user_type']  === 'operator'){
      $_SESSION['operator_name']=$row['name'];
      $_SESSION['operator_email']=$row['email'];
      $_SESSION['operator_id']=$row['id'];
      header('location:../operator/operator_page.php');
>>>>>>> 4708e6279c725f579bf9cc7f045ba02871c81a35
    }

  }
  else{
      $message[]='incorrect email or password!';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!--font awesome cdn inks-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

?>




    <div class="form-container">
        <form action="" method="post">
            <h3>Login Now</h3>
       
        <input type="name" name="name" placeholder="Ener username" class="box" required>
        <input type="password" name="password" placeholder="Enter password" class="box" required> 

    <input type="submit" name="submit" value="Login Now" class="btn">
    <p>Don't you have an account? <a href="register.php">Register now</a> </p>
    </form>
    </div>
    
</body>
</html>