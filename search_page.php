<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};

if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $_SESSION['message'] = 'Already Added To Cart';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
        $_SESSION['message'] = 'Product Added To Cart';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Search Page</h3>
        <p> <a href="home.php">Home</a> / Search </p>
    </div>

    <section class="search-form">
        <form action="" method="post">
            <input type="text" name="search_name" placeholder="Search by product name..." class="box">
            <input type="text" name="search_author" placeholder="Search by author..." class="box">
            <input type="text" name="search_genre" placeholder="Search by genre..." class="box">
            <input type="submit" name="submit" value="Search" class="btn">
        </form>
    </section>

    <section class="products" style="padding-top: 0;">

        <div class="box-container">
            <?php
            if (isset($_POST['submit'])) {
                $search_name = mysqli_real_escape_string($conn, $_POST['search_name']);
                $search_author = mysqli_real_escape_string($conn, $_POST['search_author']);
                $search_genre = mysqli_real_escape_string($conn, $_POST['search_genre']);

                $query = "SELECT * FROM `products` WHERE 1=1";
                if (!empty($search_name)) {
                    $query .= " AND name LIKE '%$search_name%'";
                }
                if (!empty($search_author)) {
                    $query .= " AND author LIKE '%$search_author%'";
                }
                if (!empty($search_genre)) {
                    $query .= " AND genre LIKE '%$search_genre%'";
                }

                $select_products = mysqli_query($conn, $query) or die('Query Failed');

                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {
            ?>
                        <form action="" method="post" class="box">
                            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" class="image">
                            <div class="name"><?php echo $fetch_product['name']; ?></div>
                            <div class="author"><?php echo $fetch_product['author']; ?></div>
                            <div class="genre"><?php echo $fetch_product['genre']; ?></div>
                            <div class="price">R<?php echo $fetch_product['price']; ?>.00</div>
                            <input type="number" class="qty" name="product_quantity" min="1" value="1">
                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                            <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">
                        </form>
            <?php
                    }
                } else {
                    echo '<p class="empty">No Results Found!</p>';
                }
            } else {
                echo '<p class="empty">Search by product name, author, or genre.</p>';
            }
            ?>
        </div>

    </section>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>
