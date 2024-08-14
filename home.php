<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Query Failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $_SESSION['message'] = 'Already Added To Cart!';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('Query Failed');
        $_SESSION['message'] = 'Product Added To Cart!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <section class="home">

        <div class="content">
            <h3>Curated Reads Delivered to Your Doorstep.</h3>
            <p>At Bookworm Haven, we bring you a handpicked selection of books tailored to your tastes.
                Whether you're into gripping thrillers, heartwarming romances, or insightful non-fiction,
                our curated collections ensure there's something special for every reader.
                Experience the joy of discovering new favorites without leaving your home.</p>
            <a href="about.php" class="white-btn">Discover More</a>
        </div>

    </section>

    <section class="products">

        <h1 class="title">Latest Products</h1>

        <div class="box-container">

            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <form action="" method="post" class="box">
                        <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="price">R<?php echo $fetch_products['price']; ?>.00</div>
                        <input type="number" min="1" name="product_quantity" value="1" class="qty">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    </form>
            <?php
                }
            } else {
                echo '<p class="empty">No Products Added Yet!</p>';
            }
            ?>
        </div>

        <div class="load-more" style="margin-top: 2rem; text-align:center">
            <a href="shop.php" class="option-btn">Load More</a>
        </div>

    </section>

    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="images/Bookworm Haven Store.png" alt="">
            </div>

            <div class="content">
                <h3>About Us</h3>
                <p>Welcome to Bookworm Haven, your cozy retreat for all things literary.
                    Nestled in the heart of the community, we offer a sanctuary for book lovers of all ages.
                    Our shelves are carefully curated with a diverse selection of books, from timeless classics to contemporary gems.
                    At Bookworm Haven, we believe in the magic of stories and the joy of discovery.
                    Whether you're looking for your next great read or a quiet corner to escape with a book, you'll find it here.
                    Come in, get comfortable, and let your literary journey begin.</p>
                <a href="about.php" class="btn">Read More</a>
            </div>

        </div>

    </section>

    <section class="home-contact">

        <div class="content">
            <h3>Have Any Questions?</h3>
            <p>We're here to help! Whether you're looking for book recommendations,
                need assistance with an order, or just want to chat about your favorite reads,
                feel free to reach out. Our friendly team at Bookworm Haven is always ready to assist you.</p>
            <a href="contact.php" class="white-btn">Contact Us</a>
        </div>

    </section>





    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="script.js"></script>

</body>

</html>