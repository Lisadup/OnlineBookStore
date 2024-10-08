<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}


if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_author = $_POST['product_author'];
    $product_genre = $_POST['product_genre'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('Query Failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $_SESSION['message'] = 'Already Added To Cart';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, author, genre, price, quantity, image) VALUES('$user_id', '$product_name', '$product_author', '$product_genre', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $_SESSION['message'] = 'Book Added To Cart';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Book Shop</h3>
        <p> <a href="home.php">Home</a> / Shop </p>
    </div>

    <section class="products">

        <h1 class="title">Products</h1>

        <div class="box-container">

            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Query Failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <form action="" method="post" class="box">
                        <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="name"><?php echo $fetch_products['author']; ?></div>
                        <div class="name"><?php echo $fetch_products['genre']; ?></div>
                        <div class="price">R<?php echo $fetch_products['price']; ?>.00</div>
                        <input type="number" min="1" name="product_quantity" value="1" class="qty">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_author" value="<?php echo $fetch_products['author']; ?>">
                        <input type="hidden" name="product_genre" value="<?php echo $fetch_products['genre']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    </form>
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