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

<header class="header">

   <div class="flex">

      <a href="operator_page.php" class="logo">Operator<span>Panel</span></a>

      <nav class="navbar">
         <a href="operator_page.php">home</a>
         <a href="operator_product.php">products</a>
         <a href="operator_order.php">orders</a>
         <a href="operator_location.php">Locations</a>
         <a href="operator_category.php">Category</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['operator_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['operator_email']; ?></span></p>
         <a href="../login/logout.php" class="delete-btn">logout</a>
         <div>new <a href="../login/login.php">login</a> | <a href="../login/register.php">register</a></div>
      </div>

   </div>

</header>