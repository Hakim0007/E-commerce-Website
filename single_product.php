<?php session_start(); ?>

<?php include "server/configuration.php"; ?>

<?php

if (isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];

    $query = $connection->prepare("SELECT * FROM products WHERE product_id = ?");
    $query->bind_param("i", $product_id);

    $query->execute();
    
    $product = $query->get_result();
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product</title>
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

        <section id="prodetails" class="section-p1">
            <div class="single-pro-image">

                <?php while($row = $product->fetch_assoc()) { ?>                

                <img src="img/products/<?php echo $row['product_image']; ?>" width="100%" id="MainImg" alt="">

                <div class="small-img-group">
                    <div class="small-img-col">
                        <img src="img/products/<?php echo $row['product_image']; ?>" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="img/products/f2.jpg" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="img/products/f3.jpg" width="100%" class="small-img" alt="">
                    </div>
                    <div class="small-img-col">
                        <img src="img/products/f4.jpg" width="100%" class="small-img" alt="">
                    </div>
                </div>
            </div>

            <div class="single-pro-details">
                <h6>Home / T Shirt</h6>
                <h4><?php echo $row['product_description']; ?></h4>
                <h2>$ <?php echo $row['product_price']; ?></h2>

                <form method="post" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
                    <input type="hidden" name="product_description" value="<?php echo $row['product_description']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">                
                    <input type="number" name="product_quantity" value="1">
                    <button type="submit" name="add_to_cart" class="normal">Add To Cart</button>
                </form>

                <h4>Product Details</h4>
                <span>The Gildan Ultra Cotton T-shirt is made from a substantial 6.0 oz. per
                sq. yd. fabric constructed from 100% cotton, this classic fit preshrunk
                jersey knit provides unmatched comfort with each wear. Featuring a taped neck
                and shoulder, and a seamless double-needle collar, and available in a range
                of colors, it offers it all in the ultimate head-turning package.</span>                
            </div>

            <?php } ?>

        </section>

        <section id="product1" class="section-p1">
            <h2>Featured Products</h2>
            <p>Summer Collection New Modern Design</p>
            <div class="pro-container">
                
                <?php 

                $query = "SELECT * FROM arrivals LIMIT 4";
                $select_all_product_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_product_query)) {
                    $products_id = $row['products_id'];
                    $products_name = $row['products_name'];
                    $products_category = $row['products_category'];
                    $products_description = $row['products_description'];
                    $products_image = $row['products_image'];
                    $products_price = $row['products_price'];

                ?>

                <div class="pro">
                    <img src="img/products/<?php echo $products_image ?>" alt="">
                    <div class="des">
                        <span><?php echo $products_name ?></span>
                        <h5><?php echo $products_description ?></h5>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>$ <?php echo $products_price ?></h4>
                    </div>
                    <a href="#"><i class="fal fa-shopping-cart cart"></i></a>
                </div>

                <?php } ?>
            </div>
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

        <script>
            var MainImg = document.getElementById("MainImg");
            var small_img = document.getElementsByClassName("small-img");

            small_img[0].onclick = function() {
                MainImg.src = small_img[0].src;
            }
            small_img[1].onclick = function() {
                MainImg.src = small_img[1].src;
            }
            small_img[2].onclick = function() {
                MainImg.src = small_img[2].src;
            }
            small_img[3].onclick = function() {
                MainImg.src = small_img[3].src;
            }
        </script>

        <script src="script.js"></script>
    </body>

</html>