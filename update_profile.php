<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['update_profile'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    mysqli_query($conn, "UPDATE `users` SET name = '$name', email = '$email' WHERE id = '$user_id'") or die('query failed');

    $old_pass = $_POST['old_pass'];
    $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
    $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

    if (!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)) {
        if ($update_pass != $old_pass) {
            $_SESSION['message'] = 'Old Password Does Not Match';
        } elseif ($new_pass != $confirm_pass) {
            $_SESSION['message'] = 'Confirm Password Does Not Match!';
        } else {
            mysqli_query($conn, "UPDATE `users` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
            $_SESSION['message'] = 'Password Updated Successfully!';
        }
    } else {
        $_SESSION['message'] = 'Profile updated successfully!';
        header('location:update_profile.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="heading">
        <h3>Your Profile</h3>
        <p> <a href="home.php">Home</a> / Profile </p>
    </div>

    <section class="contact">
        <form action="" method="post" enctype="multipart/form-data">
            <h3>Update Profile</h3>
            <?php
            $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
            if (mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);
            }
            ?>
            <input type="text" name="name" value="<?php echo $fetch['name']; ?>" placeholder="Username" class="box">
            <input type="email" name="email" value="<?php echo $fetch['email']; ?>" placeholder="Email" class="box">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <input type="password" name="update_pass" placeholder="Enter previous password" class="box">
            <input type="password" name="new_pass" placeholder="Enter new password" class="box">
            <input type="password" name="confirm_pass" placeholder="Confirm new password" class="box">
            <input type="submit" value="Update Profile" name="update_profile" class="btn">
            <a href="home.php" class="delete-btn">Go Back</a>
        </form>
    </section>

    <?php include 'footer.php'; ?>

    <script src="script.js"></script>

</body>

</html>