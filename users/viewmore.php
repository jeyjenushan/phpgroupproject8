<?php
include '../config.php';
session_start();

$user_id = $_SESSION['user_id'];
if (!isset($user_id)) {
    header('Location: ../login/login.php');
    exit;
}

// Ensure productId is set and valid
if (isset($_GET['productId']) && is_numeric($_GET['productId'])) {
    $product_id = intval($_GET['productId']);
} else {
    echo "Invalid product ID.";
    exit;
}

// Delete review
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $delete_sql = "DELETE FROM `reviews` WHERE id = $id";
    $result = mysqli_query($conn, $delete_sql);
    if ($result) {
        header("Location: ./viewmore.php?productId=$product_id");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch product details
$product_sql = "SELECT * FROM products WHERE id = $product_id";
$product_result = mysqli_query($conn, $product_sql);

if (mysqli_num_rows($product_result) > 0) {
    $product = mysqli_fetch_assoc($product_result);
    $name = $product['name'];
} else {
    echo "Product not found.";
    exit;
}

// Fetch reviews
$reviews_sql = "SELECT * FROM reviews WHERE product_id = $product_id ORDER BY created_at DESC";
$reviews_result = mysqli_query($conn, $reviews_sql);

// Handle review submission
if (isset($_POST['submit_review'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $rating = intval($_POST['rating']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    if (isset($_FILES['reviewerimage']) && $_FILES['reviewerimage']['error'] === UPLOAD_ERR_OK) {
        $reviewerImage = $_FILES['reviewerimage']['name'];
        $reviewerTempImage = $_FILES['reviewerimage']['tmp_name'];
        $uploadFolder = "../uploaded_img/" . basename($reviewerImage);

        if (move_uploaded_file($reviewerTempImage, $uploadFolder)) {
            $review_sql = "INSERT INTO reviews (product_id, user_name, reviewr_image, rating, comment, created_at) 
                           VALUES ('$product_id', '$user_name', '$uploadFolder', '$rating', '$comment', NOW())";

            if (mysqli_query($conn, $review_sql)) {
                header("Location: viewmore.php?productId=$product_id");
                exit;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "No image uploaded or there was an error during the upload.";
    }
}


//update products

if (isset($_POST['updated_product'])) {
    $update_p_id = $_POST['update_p_id'];

    $updated_name = $_POST["update_name"];
    $updated_comment = $_POST["update_comment"];

    $update_rating = $_POST["update_rating"];

    mysqli_query($conn, "UPDATE `reviews` SET user_name='$updated_name',comment='$updated_comment', rating=$update_rating  where id=$update_p_id") or die("query failed");
    $update_image = $_FILES['update_img']['name'];
    $update_image_tmp_name = $_FILES['update_img']['tmp_name'];
    $update_image_size = $_FILES['update_img']['size'];
    $update_folder = '../uploaded_img/' . basename($update_image);
    $update_old_image = $_POST['update_old_image'];


    if (!empty($update_image)) {

        if ($update_image_size > 2000000) {
            $message[] = "Image file size is too large";
        } else {

            if (move_uploaded_file($update_image_tmp_name, $update_folder)) {

                $update_sql = "UPDATE `reviews` SET reviewr_image='$update_folder' WHERE id=$update_p_id";
                if (mysqli_query($conn, $update_sql)) {

                    if (file_exists('../uploaded_img/' . $update_old_image)) {
                        unlink('../uploaded_img/' . $update_old_image);
                    }
                } else {
                    echo "Error updating review image: " . mysqli_error($conn);
                }
            } else {
                echo "Error uploading the new image.";
            }
        }
    }
    header("Location: viewmore.php?productId=$product_id");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/viewmore_style.css">
</head>

<body>
    <?php include './user_header.php'; ?>

    <div class="heading">
        <h3>View Details</h3>
        <p> <a href="home.php">Home</a> / Details </p>
    </div>

    <h1 class="title"><?php echo htmlspecialchars($name); ?></h1>
    <div class="product-details">
        <a href="viewmore.php?productId=<?php echo $fetched_products['id'] ?>">
            <img class="product-image" src="../uploaded_img/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        </a>
        <div class="product-info">
            <h1><strong>Name :</strong><?php echo htmlspecialchars($product['name']); ?></h1>
            <br>
            <h3>Category : Book</h3>
            <h3>Author : Mr.Perera</h3>

            <h3>Published year : 1995</h3>
            <h3>Discription :- </h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus exercitationem ratione totam ut nemo consequatur error, consequuntur repellendus. Pariatur nesciunt, voluptas reprehenderit aliquid amet ad perferendis praesentium a incidunt fugiat?Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo accusantium officiis iste non praesentium alias deserunt error officia! Dolorum, laboriosam quibusdam beatae natus eaque aspernatur fugit sit aliquam voluptatibus porro!</p>
            <br>
            <p><strong>Price:</strong> </p>
            <p id="view_price"> Rs<?php echo number_format($product['price'], 2); ?></p>
        </div>
    </div>

    <section class="reviews">
        <h1 class="title">Client's Reviews</h1>
        <div class="box-container">
            <div class="box">
                <h2>User Reviews</h2>

                <?php
                if (mysqli_num_rows($reviews_result) > 0) {
                    while ($review = mysqli_fetch_assoc($reviews_result)) {
                        $id = $review['id'];
                        echo "<div class='review'>";
                        echo "<img src='" . htmlspecialchars($review['reviewr_image']) . "' alt='Review Image'>";
                        echo "<h4>" . htmlspecialchars($review['user_name']) . " <span class='rating'>" . str_repeat('★', $review['rating']) . "</span></h4>";
                        echo "<p>" . htmlspecialchars($review['comment']) . "</p>";
                        echo "<small>Reviewed on: " . date('F j, Y', strtotime($review['created_at'])) . "</small><br><br>";
                        echo "<a href='viewmore.php?productId=$product_id&delete=$id'><input type='button' value='Delete' class='option-btn'></a><br>";
                        echo "<a href='viewmore.php?productId=$product_id&update=$id'><input type='button' value='Update' class='option-btn'></a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No reviews yet. Be the first to review this product!</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Review Submission Form -->
    <div class="review-form">
        <h2>Submit Your Review</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="user_name">Your Name:</label><br>
            <input type="text" id="user_name" name="user_name" required><br><br>

            <label for="rating">Rating:</label><br>
            <select id="rating" name="rating" required>
                <option value="5">★★★★★ (5 stars)</option>
                <option value="4">★★★★ (4 stars)</option>
                <option value="3">★★★ (3 stars)</option>
                <option value="2">★★ (2 stars)</option>
                <option value="1">★ (1 star)</option>
            </select><br><br>

            <label for="comment">Your Review:</label><br>
            <textarea id="comment" name="comment" rows="4" required></textarea><br><br>

            <label for="reviewerimage">Upload Image:</label><br>
            <input type="file" id="reviewerimage" name="reviewerimage"><br><br>

            <input type="submit" name="submit_review" value="Submit Review">
        </form>
    </div>

    <!-- Update Review Section -->
    <section class="edit-product-form">
        <?php
        if (isset($_GET['update'])) {
            $updated_id = $_GET['update'];
            $update_query = mysqli_query($conn, "SELECT * FROM `reviews` WHERE id ='$updated_id'") or die("Query failed");

            if (mysqli_num_rows($update_query) > 0) {
                while ($fetch_update = mysqli_fetch_assoc($update_query)) {
        ?>
                    <form action="" method="POST" enctype='multipart/form-data'>
                        <input type="hidden" name="update_p_id" value="<?php echo htmlspecialchars($fetch_update['id']); ?>">
                        <input type="hidden" name="update_old_image" value="<?php echo htmlspecialchars($fetch_update['reviewr_image']); ?>">

                        <!-- Corrected img tag -->
                        <?php
                        // Ensure the image path is correct and handle any potential issues.
                        $image_path =   htmlspecialchars($fetch_update['reviewr_image']);

                        // Check if the file exists before displaying it.
                        if (file_exists($image_path)) {
                            echo "<img src='" . $image_path . "' alt='Review Image' class='box-img'>";
                        } else {
                            echo "<p>Image not found.</p>";
                        }
                        ?>

                        <input type="text" name="update_name" class="box" placeholder="Enter Name" value="<?php echo htmlspecialchars($fetch_update['user_name']); ?>">
                        <input type="text" name="update_comment" class="box" placeholder="Enter Comment" value="<?php echo htmlspecialchars($fetch_update['comment']); ?>">

                        <select name="update_rating" id="">
                            <?php
                            $value1 = $fetch_update['rating'];
                            echo "<option value=\"$value1\">" . str_repeat('★', $value1) . "</option>";

                            for ($i = 1; $i <= 5; $i++) {
                                echo "<option value=\"$i\">" . str_repeat('★', $i) . "</option>";
                            }
                            ?>
                        </select>
                        <input type="file" class="box" name="update_img">
                        <input type="submit" value="UPDATE" name="updated_product" class="btn">
                        <button type="button" id="close-update" class="option-btn" onclick="window.location.href='viewmore.php?productId=<?php echo $product_id; ?>'">CANCEL</button>
                    </form>
        <?php
                }
            }
        } else {
            echo '<script>document.querySelector(".edit-product-form").style.display="none";</script>';
        }
        ?>
    </section>
    <script src="../js/script.js"></script>
</body>

</html>