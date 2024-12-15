<?php include "server/configuration.php"; ?>

<?php session_start(); ?>

<?php

if (isset($_POST['add_to_cart'])){

    // if user has already added a product to cart
    if (isset($_SESSION['cart'])){

        $products_array_ids = array_column($_SESSION['cart'], "product_id");
        // if product has already been added to cart or not
        if (!in_array($_POST['product_id'], $products_array_ids)){

            $product_id = $_POST['product_id'];
            $product_description = $_POST['product_description'];
            $product_image = $_POST['product_image'];
            $product_price = $_POST['product_price'];
            $product_quantity = $_POST['product_quantity'];

            $product_array = array(
                            'product_id' => $product_id,
                            'product_description' => $product_description,
                            'product_image' => $product_image,
                            'product_price' => $product_price,
                            'product_quantity' => $product_quantity
            );

            $_SESSION['cart'][$product_id] = $product_array;
            
            //product has already been added
        } else {

            echo '<script>alert("Product was already added to cart");</script>';            
        }

     // if this is the first product   
    } else {

        $product_id = $_POST['product_id'];
        $product_description = $_POST['product_description'];
        $product_image = $_POST['product_image'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
                         'product_id' => $product_id,
                         'product_description' => $product_description,
                         'product_image' => $product_image,
                         'product_price' => $product_price,
                         'product_quantity' => $product_quantity
        );

        $_SESSION['cart'][$product_id] = $product_array;
    }

    // calculate total
    calculateTotalCart();

    // remove product from cart

} else if(isset($_POST['remove_product'])) {

    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

    // calculate total
    calculateTotalCart();

} else if(isset($_POST['edit_quantity'])){

    // we get id and quantity from the form
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    // get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    // update product quantity
    $product_array['product_quantity'] = $product_quantity;

    // return array back to its place
    $_SESSION['cart'][$product_id] = $product_array;

    // calculate total
    calculateTotalCart();

} else {
   // header("location: index.php");
}

function calculateTotalCart(){

    $total_price = 0;
    $total_quantity = 0;

    foreach($_SESSION['cart'] as $key => $value) {

        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total_price = $total_price + ($price * $quantity);
        $total_quantity = $total_quantity + $quantity;
    }
    
    $_SESSION['total'] = $total_price;
    $_SESSION['quantity'] = $total_quantity;
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart</title>
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
                        <a class="active" href="cart.php">
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

        <section id="page-header" class="about-header">

            <h2>#cart</h2>

            <p>Add your coupon code & SAVE upto 70%!</p>

        </section>

        <section class="cart container section-p1">
            <div class="container" style="text-align: center;">
                <h2 style="font-weight: bold">Your Cart</h2>
            </div>
            <table style="margin-top: 3rem; padding-top: 3rem;">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if(isset($_SESSION['cart'])){ ?>
                    
                    <?php foreach($_SESSION['cart'] as $key => $value){ ?>
                    
                    <tr>
                        <td>
                            <div class="product-info">
                                <img src="img/products/<?php echo $value['product_image']; ?>" alt="">
                                <div>
                                    <p><?php echo $value['product_description']; ?></p>
                                    <small><span>$</span><?php echo $value['product_price']; ?></small>
                                    <br>
                                    <form method="post" action="cart.php">
                                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                        <input type="submit" name="remove_product" class="remove-btn" value="Remove">                                        
                                    </form>
                                </div>
                            </div>
                        </td>

                        <td>
                            <form method="post" action="cart.php">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>">                                
                                <input type="submit" class="edit-btn" value="update" name="edit_quantity">
                            </form>
                        </td>

                        <td>
                            <span>$</span>
                            <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                        </td>
                    </tr>

                    <?php } ?>

                    <?php } ?>

                </tbody>
            </table>
        </section>

        <section id="cart-add" class="section-p1">
            <div id="coupon">
                <h3>Apply Coupon</h3>
                <div>
                    <input type="text" placeholder="Enter Your Coupon">
                    <button class="normal">Apply</button>
                </div>
            </div>

            <div id="subtotal">
                <h3>Cart Total</h3>
                <table>
                    <!-- <tr>
                        <td>Cart Subtotal</td>
                        <td>$ 335</td>
                    </tr> -->
                    <tr>
                        <td>Shipping</td>
                        <td>Free</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <?php if(isset($_SESSION['cart'])){ ?>
                            <td><strong>$ <?php echo $_SESSION['total']; ?></strong></td>
                        <?php } ?>
                    </tr>
                </table>
                <form action="checkout.php" method="post">
                    <button type="submit" name="checkout" class="normal">Proceed to checkout</button>
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