<?php session_start(); ?>

<?php include "server/configuration.php"; ?>

<?php

if (isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $query = $connection->prepare("SELECT * FROM order_items WHERE order_id = ?");

    $query->bind_param('i', $order_id);

    $query->execute();

    $order_details = $query->get_result();

    $order_total_price = calculateTotalOrderPrice($order_details);

} else {

    header('location: account.php');
    exit;
}

function calculateTotalOrderPrice($order_details){

    $total = 0;

    foreach($order_details as $row) {
        
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];

        $total = $total + ($product_price * $product_quantity);
    }
    
    return $total;
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account</title>
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

        <section id="orders" class="orders container section-p1">
            <div class="container">
                <h2 style="font-weight: bold; text-align: center;">Order Details</h2>
            </div>
            <table style="margin-top: 3rem; padding-top: 3rem;">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach($order_details as $row) { ?>

                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="img/products/<?php echo $row['product_image']; ?>" alt="">
                                <div>
                                    <p style="margin-top: 1rem;"><?php echo $row['product_description']; ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span>$<?php echo $row['product_price']; ?></span>
                        </td>
                        <td>
                            <span><?php echo $row['product_quantity']; ?></span>
                        </td>
                    </tr>

                    <?php } ?>

                </tbody>
            </table>

            <?php if($order_status == "not paid") { ?>
                <form method="post" action="payment.php" id="order-form" style="float: right;">
                    <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>">
                    <input type="hidden" name="order_status" value="<?php echo $order_status; ?>">
                    <button type="submit" name="order_pay_btn" class="normal">Pay Now</button>
                </form><br>
            
                <?php } ?>

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