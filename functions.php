<?php
function updateAverageRating($conn, $product_id) {
    $avg_query = mysqli_query($conn, "SELECT AVG(rating) as avg_rating FROM `reviews` WHERE product_id = '$product_id'");
    $avg_result = mysqli_fetch_assoc($avg_query);
    $avg_rating = $avg_result['avg_rating'];

    mysqli_query($conn, "UPDATE `products` SET avg_rating = '$avg_rating' WHERE id = '$product_id'");
}
?>