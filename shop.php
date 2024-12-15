<?php session_start(); ?>

<?php include "server/configuration.php"; ?>

<?php

if(isset($_GET['page_no']) && $_GET['page_no'] != "") {
    // if user has already entered page then page number is the one that they selected
    $page_no = $_GET['page_no'];

} else {
    // if user just entered the page then default page is 1
    $page_no = 1;
}

// return number of products
$query = $connection->prepare("SELECT COUNT(*) AS total_records FROM products");

$query->execute();

$query->bind_result($total_records);

$query->store_result();

$query->fetch();

// products per page
$total_records_per_page = 8;

$offset = ($page_no - 1) * $total_records_per_page;

$next_page = $page_no + 1;

$adjacents = "2";

$total_no_of_pages = ceil($total_records/$total_records_per_page);

// get all products

$stmt = $connection->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
$stmt->execute();
$products = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shop</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <section id="header">
            <a href="#"><img src="img/logo.png" class="logo" alt=""></a>

            <div>
                <ul id="navbar">
                    <li><a href="index.php">Home</a></li>
                    <li><a class="active" href="shop.php">Shop</a></li>
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

        <section id="page-header">

            <h2>#stayhome</h2>

            <p>Save more with coupons & up to 70% off!</p>

        </section>

        <section id="product1" class="section-p1">
            <div class="pro-container">

                <?php

                while($row = mysqli_fetch_assoc($products)) {
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $product_category = $row['product_category'];
                    $product_description = $row['product_description'];
                    $product_image = $row['product_image'];
                    $product_price = $row['product_price'];

                ?>

                <div class="pro" onclick="window.location.href='<?php echo 'single_product.php?product_id='. $product_id ?>'">
                    <img src="img/products/<?php echo $product_image ?>" alt="">
                    <div class="des">
                        <span><?php echo $product_name ?></span>
                        <h5><?php echo $product_description ?></h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>$ <?php echo $product_price ?></h4>
                    </div>
                    <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
                </div>

                <?php } ?>
                
            </div>
        </section>

        <section id="pagination" class="section-p1">
            <a href="?page_no=1">1</a>
            <a href="?page_no=2">2</a>
            
            <a href="<?php if($page_no >= $total_no_of_pages){echo '#';} else {echo "?page_no=".($page_no + 1);} ?>"><i class="fal fa-long-arrow-alt-right <?php if($page_no >= $total_no_of_pages){echo 'disabled';} ?>"></i></a>
        </section>

        <section id="newsletter" class="section-p1 section-m1">
            <div class="newstext">
                <h4>Sign Up For Newsletters</h4>
                <p>Get E-mail updates about our latest shop and <span>special offers.</span>
                </p>
            </div>
            <div class="form">
                <input type="text" placeholder="Your email address">
                <button class="normal">Sign Up</button>
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