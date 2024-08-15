<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
   exit();
}

// Function to update average rating
function updateAverageRating($conn, $product_id) {
    $avg_query = mysqli_query($conn, "SELECT AVG(rating) as avg_rating FROM `reviews` WHERE product_id = '$product_id'");
    $avg_result = mysqli_fetch_assoc($avg_query);
    $avg_rating = $avg_result['avg_rating'];

    mysqli_query($conn, "UPDATE `products` SET avg_rating = '$avg_rating' WHERE id = '$product_id'");
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $product_id = $_POST['product_id'];
    $rating = $_POST['rating'];
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);

    // Check if user has already reviewed this product
    $check_review = mysqli_query($conn, "SELECT * FROM `reviews` WHERE user_id = '$user_id' AND product_id = '$product_id'");
    
    if(mysqli_num_rows($check_review) > 0){
        // Update existing review
        $update_review = mysqli_query($conn, "UPDATE `reviews` SET rating = '$rating', review_text = '$review_text' WHERE user_id = '$user_id' AND product_id = '$product_id'");
        
        if($update_review){
            updateAverageRating($conn, $product_id);
            $_SESSION['message'] = 'Review updated successfully!';
        } else {
            $_SESSION['message'] = 'Failed to update review. Please try again.';
        }
    } else {
        // Insert new review
        $insert_review = mysqli_query($conn, "INSERT INTO `reviews` (user_id, product_id, rating, review_text) VALUES ('$user_id', '$product_id', '$rating', '$review_text')");
        
        if($insert_review){
            updateAverageRating($conn, $product_id);
            $_SESSION['message'] = 'Review submitted successfully!';
        } else {
            $_SESSION['message'] = 'Failed to submit review. Please try again.';
        }
    }

    header('location: shop.php');
    exit();
} else {
    // If someone tries to access this page directly without submitting a form
    $_SESSION['message'] = 'Invalid request';
    header('location: shop.php');
    exit();
}