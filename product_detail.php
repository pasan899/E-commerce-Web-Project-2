<?php
$title = 'Product Detail';
include './php/config.php';
session_start();

if(isset($_SESSION['admin_id'])){
    $user_id = $_SESSION['admin_id'];
    include './templates/admin_header.php';
} elseif(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    include './templates/user_header.php';
} else {
    include './templates/header.php';
}

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];

    $select_product = mysqli_query($con, "SELECT * FROM products WHERE id = '$product_id'");
    $product = mysqli_fetch_assoc($select_product);

if(isset($_POST['add_to_cart'])){

    if (!isset($user_id)){
        echo '<script>alert("Please login to add products to cart!");
        window.location.href="login.php";</script>';
    }else {

    $product_id = $_POST['product_id'];
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $sql = "SELECT * FROM cart WHERE title = '$product_id' AND user_id = '$user_id'";
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0){
        echo '<script>alert("Product already added to cart!")</script>';
    } else {
        $sql = "INSERT INTO cart (user_id, title, price, quantity, image) VALUES ('$user_id', '$product_title', '$product_price', '$product_quantity', '$product_image')";
        $result = mysqli_query($con, $sql);

        if($result){
            echo '<script>alert("Product Added to Cart Successfully!"); 
            window.location.href="cart.php";</script>';  
        } else {
            echo '<script>alert("Product not added to cart!")</script>';
        }
    }
}
}

?>

<link rel="stylesheet" href="./css/product_detail.css">

<link rel="stylesheet" href="styles.css">

<div class="main-container">
    <h1 class="page-title">Product Detail</h1>
    <div class="product-container">
        <div class="product-card">
            <img class="product-image" src="./src/uploads/<?php echo $product['image'] ?>" alt="<?php echo $product['title'] ?>">
            <div class="product-info">
                <h3 class="product-title"><?php echo $product['title'] ?></h3>
                <p class="product-description"><?php echo $product['description'] ?></p>
                <p class="product-price">Price: $<?php echo $product['price'] ?></p>
                <div class="price-qty">
                    <input type="number" name="product_quantity" value="1" min="1" id="product_quantity" class="qty">
                </div>
                <form action="" method="post" class="cart-form">
                    <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
                    <input type="hidden" name="product_title" value="<?php echo $product['title'] ?>">
                    <input type="hidden" name="product_price" value="<?php echo $product['price'] ?>">
                    <input type="hidden" name="product_image" value="<?php echo $product['image'] ?>">
                    
                    <?php 
                        echo '<div class="btn-1">
                        <button type="submit" value="Add to cart" name="add_to_cart" class="btn"><img src="./src/cart.svg" alt="" style="width:25px; margin-right:10px;"> Add to cart</button>
                    </div>';
                    ?>

                </form>
            </div>
        </div>        
    </div>
</div>

<?php
} else {
    echo '<p class="empty">Product not found!</p>';
}

include './templates/footer.php';
?>