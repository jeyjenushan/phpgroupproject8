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

      <a href="admin_page.php" class="logo1">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">home</a>
         <a href="admin_products.php">products</a>
         <a href="admin_order.php">orders</a>
         <div class="dropdown">
            <p>users</p>
            <div class="dropdown-content">
               <a href="admin_users.php">View Users</a>
               <a href="register_admin.php">Add Users</a>
            </div>
         </div>
         <a href="admin_contacts.php">messages</a>
         <a href="admin_location.php">Locations</a>
         <a href="admin_category.php">Category</a>

      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="../login/logout.php" class="delete-btn">logout</a>
         <div>new <a href="../login/login.php">login</a> | <a href="../login/register.php">register</a></div>
      </div>

   </div>

</header>