<?php
$title = 'Home';
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

  
 
?>    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
    <link rel="stylesheet" href="./css/contact_us.css">
</head>
<body>

<div class="services-container">
  <div class="service">
    <img src="./src/location.png">
    <h2>Our Location</h2>
    <p>Our Physical outlet is currently closed</p>
  </div>
  <div class="service">
    <img src="./src/phone.png">
    <h2>Contact Us Any Time</h2>
    <a href="tel:077-8889997"><p>077-8889997</p></a>
  </div>
  <div class="service">
    <img src="./src/email.png">
    <h2>Support</h2>
    <a href="mailto:Support24/7@onlineshop.com"><p>Support24/7@onlineshop.com</p></a>
  </div>
</div>

</body>

<?php
   include './templates/footer.php';
?>

