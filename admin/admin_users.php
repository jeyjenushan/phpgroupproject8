<?php
include '../config.php';
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_users.php');
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/admin_style.css">
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
    include 'admin_header.php';
    


    ?>
    <section class="users">
        <h1 class="title">Users Accounts</h1>
<div class="box-container">
    <?php
$select_users=mysqli_query($conn,"SELECT * FROM `users` ") or die("query failed");
while($fetch_users=mysqli_fetch_assoc($select_users)){
?>
<div class="box">
    <p>username : <span><?php echo $fetch_users['name']?></span></p>
    <p>email : <span><?php echo $fetch_users['email']?></span></p>
    <p>user type : 
        <span style="color:<?php if($fetch_users['user_type'] == 'admin'){echo 'var(--orange)';} ?>">
            <?php echo $fetch_users['user_type'];?>
        </span></p>
    <a href="admin_users.php?delete=<?php echo $fetch_users['id'];?>" onclick="return confirm('delete your user?')" class="delete-btn">DELETE</a>

</div>
<?php
}

?>
</div>

    </section>
   
   
    <script src="../js/admin_script.js"></script>

</body>
</html>