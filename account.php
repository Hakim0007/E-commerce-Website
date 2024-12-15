<?php include "server/configuration.php"; ?>

<?php session_start(); ?>

<?php

if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        header('location: login.php');
        exit;
    }
}

if (isset($_POST['change_password'])) {

    $user_password = $_POST['user_password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    // if passwords don't match
    if ($user_password !== $confirmPassword){
        header('location: account.php?error=Passwords dont match');
    }

    // if password is less than 6 characters
    else if (strlen($user_password) < 6){
        header('location: account.php?error=Password must be at least 6 characters');
    }

    else {
        $query = $connection->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
        $query->bind_param('ss', md5($user_password), $user_email);

        if ($query->execute()) {
            header('location: account.php?message=password has been updated successfully');
        }
        else {
            header('location: account.php?error=could not update password');
        }
    }
}

// get orders
if (isset($_SESSION['logged_in'])) {

    $user_id = $_SESSION['user_id'];

    $query = $connection->prepare("SELECT * FROM orders WHERE user_id = ?");

    $query->bind_param('i', $user_id);

    $query->execute();

    $orders = $query->get_result();
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
                    <li id="lg-bag"><a class="active" href="account.php"><i class="fas fa-user"></i></a></li>
                    <a href="#" id="close"><i class="far fa-times"></i></a>
                </ul>
            </div>
            <div id="mobile">
                <a href="cart.html"><i class="far fa-shopping-bag"></i></a>
                <i id="bar" class="fas fa-outdent"></i>
            </div>
        </section>

        <section class="section-p1 section-m1">
            <div class="row container">
                <div class="col-lg-6 col-md-12 col-sm-12" style="text-align: center;">
                    <p style="text-align: center; color: green;"><?php if(isset($_GET['register_success'])){ echo $_GET['register_success']; } ?></p>
                    <p style="text-align: center; color: green;"><?php if(isset($_GET['login_success'])){ echo $_GET['login_success']; } ?></p>
                    <h3 style="font-weight: bold;">Account info</h3>
                    <div class="account-info">
                        <p>Name<span> <?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name']; } ?></span></p>
                        <p>Email<span> <?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email']; } ?></span></p>
                        <p><a href="#orders" id="orders-btn">Your orders</a></p>
                        <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <form action="account.php" method="post" id="account-form">
                        <p style="text-align: center; color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                        <p style="text-align: center; color: green;"><?php if(isset($_GET['message'])){ echo $_GET['message']; } ?></p>
                        <h3>Change Password</h3><br>
                        <div class="form-group">
                            <label for="user_password" class="form-label"> Password </label>
                            <input type="password" class="form-control" id="account-password" name="user_password" placeholder="Password" required>
                        </div><br>
                        <div class="form-group">
                            <label for="confirmPassword" class="form-label"> Confirm Password </label>
                            <input type="password" class="form-control" id="account-confirm-password" name="confirmPassword" placeholder="Password" required>
                        </div><br>
                        <div class="form-group">
                            <button type="submit" class="normal" id="change-pass-btn" name="change_password">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section id="orders" class="orders container section-p1">
            <div class="container">
                <h2 style="font-weight: bold; text-align: center;">Your Orders</h2>
            </div>
            <table style="margin-top: 3rem; padding-top: 3rem;">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Cost</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <th>Order Details</th>
                    </tr>
                </thead>
                <tbody>

                    <?php while($row = $orders->fetch_assoc()) { ?>

                    <tr>
                        <td>
                            <!-- <div class="product-info">
                                <img src="img/products/f1.jpg" alt="">
                                <div>
                                    <p style="margin-top: 1rem;"></p>
                                </div>
                            </div> -->
                            <span><?php echo $row['order_id']; ?></span>
                        </td>
                        <td>
                            <span><?php echo $row['order_cost']; ?></span>
                        </td>
                        <td>
                            <span><?php echo $row['order_status']; ?></span>
                        </td>
                        <td>
                            <span><?php echo $row['order_date']; ?></span>
                        </td>
                        <td>
                            <form method="post" action="order_details.php" id="order-form">
                                <input type="hidden" name="order_status" value="<?php echo $row['order_status']; ?>">
                                <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                <button class="normal" type="submit" name="order_details_btn">Details</button>
                            </form>
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
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