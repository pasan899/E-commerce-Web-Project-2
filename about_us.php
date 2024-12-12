<?php
$title = 'About';
include './php/config.php';
session_start();


if(isset($_SESSION['admin_id'])){
        $user_id = $_SESSION['admin_id'];
        include './templates/admin_header.php';
    } elseif(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        include './templates/user_header.php';
}   else
        include './templates/header.php';


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
        <link rel="stylesheet" href="./css/about_us.css">

        <div class="main-container" style="display:flex;align-items: flex-start; padding-bottom:80px; flex-direction:row;">
            <div style="flex:1;">
                <img class="image" src="./src/3878.webp" alt="" style="width:90%;">
            </div>

            <div  style="flex:1;">
                <br><br><br>
                <h4>Who we are</h4> 
                <h1 >Your Ultimate Destination for <br>Online Shopping!</h1>
                <p style="text-align:left; margin-top:10px; margin-bottom:30px">At Online Shop, we are dedicated to providing you with an unparalleled online shopping experience. With a vast array of products ranging from electronics to fashion, home decor to beauty essentials, we strive to be your one-stop destination for all your shopping needs. Our platform is designed to make your shopping journey seamless, convenient, and enjoyable. 
                <br><br>With a commitment to quality, reliability, and affordability, we handpick each item featured on our website to ensure that you receive only the best. Whether you're looking for the latest gadgets, trendy fashion pieces, or unique gifts, Online Shop has something for everyone. 
                <br><br>As a customer-centric e-commerce platform, we prioritize your satisfaction above all else. Our user-friendly interface, secure payment options, and efficient customer support team are here to make your shopping experience hassle-free. 
                <br><br>Join us at Online Shop and embark on a shopping adventure like never before. Shop with confidence and discover endless possibilities at your fingertips.</p>
            </div>
        </div>
        

        <div class="row">
            <div class="col-1">
                    <img src="./src/qickdelivery.png">
                     <p class="banner1">Quick Delivery</p>
            
            </div>
            <div class="col-1">
                    <img src="./src/securepayment.png">
                    <p class="banner1">Secure Payment</p>
        
            </div>
            <div class="col-1">
                <img src="./src/bestquality.png">
                <p class="banner1">Best Quality</p>
    
            </div>
        </div>
    
</body>

<?php
   
    include './templates/footer.php';
?>


    