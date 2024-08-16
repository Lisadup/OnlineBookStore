<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

if (isset($_POST['submit_review'])) {
    $product_id = $_POST['product_id'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];

    $check_review = mysqli_query($conn, "SELECT * FROM `reviews` WHERE user_id = '$user_id' AND product_id = '$product_id'") or die('Query Failed');

    if (mysqli_num_rows($check_review) > 0) {
        $_SESSION['message'] = 'You have already reviewed this product';
    } else {
        mysqli_query($conn, "INSERT INTO `reviews`(user_id, product_id, review, rating) VALUES('$user_id', '$product_id', '$review', '$rating')") or die('Query Failed');
        $_SESSION['message'] = 'Review Submitted';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Reviews</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Product Reviews</h3>
        <p> <a href="home.php">Home</a> / Reviews </p>
    </div>

    <section class="products">

        <h1 class="title">Products</h1>

        <div class="box-container">

            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Query Failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    $product_id = $fetch_products['id'];
            ?>
                    <div class="box">
                        <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="author"><?php echo $fetch_products['author']; ?></div>
                        <div class="genre"><?php echo $fetch_products['genre']; ?></div>
                        <div class="price">R<?php echo $fetch_products['price']; ?>.00</div>

                        <!-- Reviews Section -->
                        <div class="reviews">
                            <h3>Customer Reviews</h3>
                            <?php
                            $select_reviews = mysqli_query($conn, "SELECT * FROM `reviews` WHERE product_id = '$product_id'") or die('Query Failed');
                            if (mysqli_num_rows($select_reviews) > 0) {
                                while ($fetch_reviews = mysqli_fetch_assoc($select_reviews)) {
                            ?>
                                    <div class="review">
                                        <span class="rating"><?php echo str_repeat('★', $fetch_reviews['rating']); ?></span>
                                        <p><?php echo $fetch_reviews['review']; ?></p>
                                    </div>
                            <?php
                                }
                            } else {
                                echo '<p class="no-reviews">No reviews yet</p>';
                            }
                            ?>
                        </div>

                        <!-- Submit Review Form -->
                        <form action="" method="post" class="review-form">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <textarea name="review" class="box" placeholder="Write your review..." required></textarea>
                            <select name="rating" class="box">
                                <option value="5">5 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="2">2 Stars</option>
                                <option value="1">1 Star</option>
                            </select>
                            <input type="submit" value="Submit Review" name="submit_review" class="btn">
                        </form>

                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">No Products Added Yet</p>';
            }
            ?>
        </div>

    </section>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="script.js"></script>

</body>

</html>
