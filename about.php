<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>About Us</h3>
        <p> <a href="home.php">Home</a> / About </p>
    </div>

    <section class="about">

        <div class="flex">

            <div class="image">
                <img src="images/about-1.jpeg" alt="">
            </div>

            <div class="content">
                <h3>Why Choose Us?</h3>
                <p>At Bookworm Haven, we believe in the power of stories to inspire, comfort, and transform. Our carefully curated selection of books ensures that you'll always find something that speaks to your interests, whether you're searching for the latest bestseller or a hidden gem. Our knowledgeable staff is passionate about helping you discover your next great read.</p>
                <p>We also offer a personalized experience with our handpicked recommendations and cozy reading nooks. Bookworm Haven is more than just a bookstore; it's a community of readers who share a love for the written word. Join us and find your haven here.</p>
                <a href="contact.php" class="btn">Contact Us</a>
            </div>

        </div>

    </section>

    <section class="authors">

        <h1 class="title">Featured Authors</h1>

        <div class="box-container">

            <div class="box">
                <img src="images/author1.jpeg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Shonda Rhimes</h3>
            </div>

            <div class="box">
                <img src="images/author2.jpeg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Jenny Han</h3>
            </div>

            <div class="box">
                <img src="images/author3.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>John Green</h3>
            </div>

            <div class="box">
                <img src="images/author4.png" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Suzanne Collins</h3>
            </div>

            <div class="box">
                <img src="images/author5.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Stephen King</h3>
            </div>

            <div class="box">
                <img src="images/author6.jpg" alt="">
                <div class="share">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-linkedin"></a>
                </div>
                <h3>Harper Lee</h3>
            </div>

        </div>

    </section>







    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="script.js"></script>

</body>

</html>