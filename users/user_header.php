<?php
include '../config.php';
if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
        <span>' . $message . '</span>
        <i class="fas fa-times" onClick="this.parentElement.remove();"></i>
                </div>
        ';
    }
}

?>
<header class="header">
    <div class="header-1">
        <div class="flex">
            <div class="share">
                <a href="https://www.facebook.com/" class="fab fa-facebook-f"></a>
                <a href="https://www.twitter.com/" class="fab fa-twitter"></a>
                <a href="https://www.instagram.com/" class="fab fa-instagram"></a>
                <a href="https://www.linkedin.com/" class="fab fa-linkedin"></a>
            </div>

        </div>
    </div>

    <div class="header-2">
        <div class="flex">
            <a href="home.php" class="hlogo">
                <img src="../images/logo.png">
          
                </pre>
            </a>

            <div class="navbar">
                <a href="home.php">Home</a>
                <a href="about.php">About</a>
                <a href="shop.php">Products</a>
                <a href="contact.php">Contact</a>
                <a href="orders.php">Orders</a>
                <a href="productShop.php">Shop</a>
            </div>





            <div class="user-box">
                <p>username:<span><?php echo $_SESSION['user_name'] ?></span></p>
                <p>Email:<span><?php echo $_SESSION['user_email'] ?></span></p>
                <a href="../login/logout.php" class="delete-btn">Logout</a>
      
            </div>




            <div class="icons search-flex">
                <div id="menu-btn" class="fas fa-bars"></div>

                <section class="search-form">
                    <form role="search" action="search_page.php" method="get" class="flex-form">

                        <input id="searchInput" name="search_data" type="search" placeholder="    Search" aria-label="Search" style="border-radius: 20px">
                        <button type="submit" id="submitSearch" name="submit" class="btn btn-outline-light"> <i class="fas fa-search"></i></button>
                    </form>
                </section>


            </div>
            <div class="icons">
                <div class="icon1">
                    <a href="cart.php" class="icons">
                        <i class="fas fa-shopping-cart"></i>
                        <?php
                        $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'")
                            or die("query failed");

                        $cart_num_rows = mysqli_num_rows($select_cart_number);

                        ?>


                        <span>(<?php echo $cart_num_rows ?>)</span>
                    </a>
                </div>
                <div id="user-btn" class="fas fa-user"></div>
            </div>

        </div>
    </div>
</header>

<script>
    document.getElementById("searchButton").addEventListener("click", function() {
        var searchInput = document.getElementById("searchInput");
        var submitButton = document.getElementById("submitSearch");

        if (searchInput.style.display === "none") {
            searchInput.style.display = "inline-block";
            submitButton.style.display = "inline-block";
            searchInput.focus();
        }
    });
</script>