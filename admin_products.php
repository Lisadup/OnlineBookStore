<?php
include 'config.php';

// Start Session
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('Query Failed');

    if (mysqli_num_rows($select_product_name) > 0) {
        $_SESSION['message'] = 'Product Name Already Added';
    } else {
        $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, author, genre, price, image) VALUES('$name', '$author', '$genre','$price','$image')") or die('Query Failed');

        if ($add_product_query) {
            if ($image_size > 2000000) {
                $_SESSION['message'] = 'Image Size Is Too Large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $_SESSION['message'] = 'Product Added Successfully';
            }
        } else {
            $_SESSION['message'] = 'Product Failed To Be Added';
        }
    }
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `products`WHERE id=$delete_id") or die('Query Failed');
    $fetch_delete_image =mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_img/'.$fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `products` WHERE id='$delete_id'") or die('Query Failed');
    header('location:admin_products.php');
}

if(isset($_POST['update_product'])){
    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_author = $_POST['update_author'];
    $update_genre = $_POST['update_genre'];
    $update_price = $_POST['update_price'];

    mysqli_query($conn, "UPDATE `products` SET name = '$update_name', author = '$update_author', genre = '$update_genre', price = '$update_price' WHERE id=$update_p_id") or die('Query Failed');

    //Handle image update
    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'uploaded_img/'.$update_image;
    $update_old_image =$_POST['update_old_image'];

    if(!empty($update_image)){
        if($update_image_size > 2000000){
            $_SESSION['message'] = 'Image File Is Too Large';
        }else{
            mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id=$update_p_id") or die('Query Failed');
            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('uploaded_img/'.$update_old_image);
        }
    }

    header('location:admin_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom admin css link -->
    <link rel="stylesheet" href="admin_style.css">

</head>

<body>
    <?php include 'admin_header.php'; ?>

    <!-- Product CRUD system starts -->
    <section class="add-products">
        <h1 class="title">Shop Products</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <h3>Add Product</h3>
            <input type="text" name="name" class="box" placeholder="Book's Name:" required>
            <input type="text"  name="author" class="box" placeholder="Author's Name:" required>
            <input type="text"  name="genre" class="box" placeholder="Book's Genre:" required>
            <input type="number" min="0" name="price" class="box" placeholder="Book's Price:" required>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
            <input type="submit" name="add_product" value="Add Product" class="btn">
        </form>
    </section>
    <!-- Product CRUD system ends -->

    <!-- Display Products -->
    <section class="show-products">
        <div class="box-container">
            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('Query Failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <div class="box">
                        <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="name"><?php echo $fetch_products['author']; ?></div>
                        <div class="name"><?php echo $fetch_products['genre']; ?></div>
                        <div class="price">R<?php echo $fetch_products['price']; ?></div>
                        <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Update</a>
                        <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete This Product?');">Delete</a>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">No Products Added Yet</p>';
            }
            ?>
        </div>
    </section>

    <section class="edit-product-form">
        <?php
        if(isset($_GET['update'])){
            $update_id = $_GET['update'];
            $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id= '$update_id'" ) or die('Query Failed');
            if(mysqli_num_rows($update_query) > 0){
                while($fetch_update = mysqli_fetch_assoc($update_query)){   
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id'];?>">
            <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image'];?>">
            <img src="uploaded_img/<?php echo $fetch_update['image'];?>" alt="">
            <input type="text" name="update_name" value="<?php echo $fetch_update['name'];?>" class="box" required placeholder="Book's Name:">
            <input type="text" name="update_author" value="<?php echo $fetch_update['author'];?>" class="box" required placeholder="Author's Name:">
            <input type="text" name="update_genre" value="<?php echo $fetch_update['genre'];?>" class="box" required placeholder="Book's Genre:">
            <input type="number" name="update_price" value="<?php echo $fetch_update['price'];?>" min="0" class="box" required placeholder="Book's Price:">
            <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png" >
            <input type="submit" value="update" class="btn" name="update_product">
            <input type="reset" value="cancel" class="option-btn" id="close-update">

        </form>
        <?php
                }
            }
            }else{
                echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
            }
        ?>
    </section>

    <!-- Custom admin javascript file link -->
    <script src="admin_script.js"></script>
</body>

</html>