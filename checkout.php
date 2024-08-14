<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!--CSS file link-->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'?>

    <?php include 'footer.php'?>

    <!--custom js link-->
    <script src="script.js"></script>
    
</body>
</html>