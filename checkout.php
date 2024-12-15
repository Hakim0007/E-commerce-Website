<?php include "server/configuration.php"; ?>

<?php session_start(); ?>

<?php

if(!empty($_SESSION['cart'])){

    // let user in

    // send user to home page

} else {

    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <section id="header">
            <a href="#"><img src="img/logo.png" class="logo" alt=""></a>

            <div>
                <ul id="navbar">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li id="lg-bag">
                        <a href="cart.php">
                            <i class="far fa-shopping-bag">
                                <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) { ?>
                                    <span class="cart-quantity"><?php echo $_SESSION['quantity']; ?></span>
                                <?php } ?>
                            </i>
                        </a>
                    </li>
                    <li id="lg-bag"><a href="account.php"><i class="fas fa-user"></i></a></li>
                    <a href="#" id="close"><i class="far fa-times"></i></a>
                </ul>
            </div>
            <div id="mobile">
                <a href="cart.html"><i class="far fa-shopping-bag"></i></a>
                <i id="bar" class="fas fa-outdent"></i>
            </div>
        </section>

        <section class="section-p1 section-m1">
            <div class="container">
                <h2 style="font-weight: bold; text-align: center;">Check Out</h2>
            </div>
            <div class="container" style="padding-top: 1rem;">
                <form id="checkout-form" method="post" action="place_order.php">
                    <p style="text-align: center; color: red;">
                        <?php if(isset($_GET['message'])){ echo $_GET['message']; } ?>
                        <?php if(isset($_GET['message'])){ ?>

                            <a href="login.php" style="color: #088178">Login</a>

                            <?php } ?>
                    </p>
                    <div class="form-group checkout-small-element">
                        <label for="user_name" class="form-label"> Name </label>
                        <input type="text" class="form-control" id="checkout-username" name="user_name" placeholder="Name" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label for="user_email" class="form-label"> Email </label>
                        <input type="email" class="form-control" id="checkout-email" name="user_email" placeholder="Email" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label for="user_phone" class="form-label"> Phone </label>
                        <input type="tel" class="form-control" id="checkout-phone" name="user_phone" placeholder="Phone" required>
                    </div>
                    <div class="form-group checkout-small-element">
                        <label for="user_city" class="form-label"> City </label>
                        <input type="text" class="form-control" id="checkout-city" name="user_city" placeholder="City" required>
                    </div>
                    <div class="form-group checkout-large-element">
                        <label for="user_address" class="form-label"> Address </label>
                        <input type="text" class="form-control" id="checkout-address" name="user_address" placeholder="Address" required>
                    </div><br>
                    <div class="form-group checkout-btn-container">
                        <p>Total amount: $ <?php echo $_SESSION['total']; ?></p>
                        <button type="submit" class="normal" id="checkout-btn" name="place_order">Place Order</button>
                    </div>
                </form>
            </div>
        </section>

        <footer class="section-p1">
            <div class="col">
                <img class="logo" src="img/logo.png" alt="">
                <h4>Contact</h4>
                <p><strong>Address: </strong> 562 Wellington Road, Street 32, San Francisco</p>
                <p><strong>Phone:</strong> +01 2222 365 /(+91) 01 2345 6789</p>
                <p><strong>Hours:</strong> 10:00 - 18:00, Mon - Sat</p>
                <div class="follow">
                    <h4>Follow us</h4>
                    <div class="icon">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-twitter"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-pinterest-p"></i>
                        <i class="fab fa-youtube"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <h4>About</h4>
                <a href="">About us</a>
                <a href="">Delivery Information</a>
                <a href="">Privacy Policy</a>
                <a href="">Terms & Conditions</a>
                <a href="">Contact Us</a>
            </div>

            <div class="col">
                <h4>My Account</h4>
                <a href="">Sign In</a>
                <a href="">View Cart</a>
                <a href="">My Wishlist</a>
                <a href="">Track My Order</a>
                <a href="">Help</a>
            </div>

            <div class="col install">
                <h4>Install App</h4>
                <p>From App Store or Google Play</p>
                <div class="row">
                    <img src="img/pay/app.jpg" alt="">
                    <img src="img/pay/play.jpg" alt="">
                </div>
                <p>Secured Payment Gateways</p>
                <img src="img/pay/pay.png" alt="">
            </div>
            <div class="copyright">
                <p>E-commerce © 2024 All Right Reserved</p>
            </div>
        </footer>

        <script src="script.js"></script>

    </body>
</html>