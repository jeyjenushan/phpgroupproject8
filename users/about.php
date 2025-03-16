<?php
include '../config.php';
session_start();
$user_id=$_SESSION['user_id'];
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
    <link rel="stylesheet" href="../css/about_style.css">

    <title>About</title>
</head>
<body>
    <?php include './user_header.php' ?>
<div class="about_heading">

    <h3>About US</h3>
    <P><a href="home.php">HOME</a>/ ABOUT</P>
</div>

<section class="about">
    <div class="flex">
        <div class="image">

        <img src="../images/about-img1.jpg" alt="">

        </div>
        <div class="content">
        <h3>why choose us?</h3>
        
         <p>We are committed to delivering exceptional value and an unforgettable experience for all history enthusiasts. From our curated selection of rare and authentic archaeological items to our seamless customer service, we ensure quality and reliability at every step. Whether you're a passionate collector or simply looking for a unique gift, our platform bridges the past with the present to meet your needs. Choose us for trust, authenticity, and a journey into history that you’ll cherish forever.</p>
         <a href="contact.php" class="btn">contact us</a>
        </div> 

    </div>
</section>

<section class="reviews">
    <h1 class="title">client's reviews</h1>
<div class="box-container">
    <div class="box">
    <img src="../images/pic-5.png" alt="">
    <p>I was amazed at the variety of items available here. The books and stamps are authentic and beautifully preserved. It's like holding a piece of history in your hands!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Mr.Ramitha</h3>
    </div>
    <div class="box">
    <img src="../images/pic-6.png" alt="">
            <p>The customer service was exceptional. My order arrived promptly, and the quality of the postcards exceeded my expectations. Will definitely order again!</p>         
            <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Miss Sahani</h3>
    </div>
    <div class="box">
    <img src="../images/pic-1.png" alt="">
            <p>As a history enthusiast, this platform is a dream come true. The attention to detail and authenticity of the products are truely remarkable. I highly reccomend this.</p>
            <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Mr.Imansha</h3>
    </div>
    <div class="box">
    <img src="../images/pic-2.png" alt="">
         <p>I found the perfect gift for my friend who loves archaeology. The items are so unique and reasonably priced. I have never had such a great experience!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Mrs.Parami</h3>
    </div>
    <div class="box">
    <img src="../images/pic-3.png" alt="">
         <p>The website is easy to navigate, and I loved the detailed descriptions of each product. It’s clear they care about their customers and the history behind their offerings.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Mr.Nadun</h3>
    </div>
    <div class="box">
    <img src="../images/pic-4.png" alt="">
         <p>Every purchase feels like uncovering a piece of history. The curated collections are thoughtfully assembled, and the packaging shows great care. I highly reccomend this</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
         <h3>Miss Sachini</h3>
    </div>
</div>
</section>
<section  class="authors">
<h1 class="title">greate authors</h1>
<div class="box-container">

<div class="box">
   <img src="../images/jenu.jpg" alt="">
   <div class="share">
      <a href="#" class="fab fa-facebook-f"></a>
      <a href="#" class="fab fa-twitter"></a>
      <a href="#" class="fab fa-instagram"></a>
      <a href="#" class="fab fa-linkedin"></a>
   </div>
   <h3>Mr.Jenushan</h3>
</div>

<div class="box">
   <img src="../images/nadeesha.jpg" alt="">
   <div class="share">
      <a href="#" class="fab fa-facebook-f"></a>
      <a href="#" class="fab fa-twitter"></a>
      <a href="#" class="fab fa-instagram"></a>
      <a href="#" class="fab fa-linkedin"></a>
   </div>
   <h3>Mr.Nadeesha</h3>
</div>

<div class="box">
   <img src="../authors/thejan2.jpg" alt="">
   <div class="share">
      <a href="#" class="fab fa-facebook-f"></a>
      <a href="#" class="fab fa-twitter"></a>
      <a href="#" class="fab fa-instagram"></a>
      <a href="#" class="fab fa-linkedin"></a>
   </div>
   <h3>Mr.Thejan</h3>
</div>

<div class="box">
   <img src="../authors/danindu.png" alt="">
   <div class="share">
      <a href="#" class="fab fa-facebook-f"></a>
      <a href="#" class="fab fa-twitter"></a>
      <a href="#" class="fab fa-instagram"></a>
      <a href="#" class="fab fa-linkedin"></a>
   </div>
   <h3>Mr.Danindu</h3>
</div>

<div class="box">
   <img src="../images/mihiran.png" alt="">
   <div class="share">
      <a href="#" class="fab fa-facebook-f"></a>
      <a href="#" class="fab fa-twitter"></a>
      <a href="#" class="fab fa-instagram"></a>
      <a href="#" class="fab fa-linkedin"></a>
   </div>
   <h3>Mr.Mihiran</h3>
</div>

<div class="box">
   <img src="../images/author-6.jpg" alt="">
   <div class="share">
      <a href="#" class="fab fa-facebook-f"></a>
      <a href="#" class="fab fa-twitter"></a>
      <a href="#" class="fab fa-instagram"></a>
      <a href="#" class="fab fa-linkedin"></a>
   </div>
   <h3>john deo</h3>
</div>

</div>

</section>





<?php include 'user_footer.php'?>
    <script src="../js/script.js"></script>
</body>
</html>