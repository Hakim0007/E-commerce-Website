<?php include "server/configuration.php"; ?>

<?php session_start(); ?>

<?php insertRows(); ?>

<?php

if (isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}

function insertRows() {
    
    if (isset($_POST['register'])){

        global $connection;

        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $confirmPassword = $_POST['confirmPassword'];

        // if passwords don't match
        if ($user_password !== $confirmPassword){
            header('location: register.php?error=Passwords dont match');
        }

        // if password is less than 6 characters
        else if (strlen($user_password) < 6){
            header('location: register.php?error=Password must be at least 6 characters');
        }

        else {

            $sql = "SELECT user_name from users WHERE user_name = '{$user_name}'";
        
            $result = mysqli_query($connection, $sql);

            // check whether there is a user with the same username or not
            if (mysqli_num_rows($result) > 0) {
                
                header('location: register.php?error=User Already Exists');
            }

            else {
                
                $query = $connection->prepare("INSERT INTO users (user_name, user_email, user_password)
                                       VALUES (?, ?, ?)");
            
                $query->bind_param('sss', $user_name, $user_email, md5($user_password));

                if (!$query->execute()) {

                    die("QUERY FAILED." . mysqli_error($connection));
                }

                else {

                    $user_id = $query->insert_id;

                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['user_email'] = $user_email;
                    $_SESSION['logged_in'] = true;
                    header('location: account.php?register_success=You have registered successfully');
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
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
            <div class="container" style="text-align: center;">
                <h2 style="font-weight: bold">Register</h2>
            </div>
            <div class="container">
                <form id="register-form" method="post" action="register.php">
                    <p style="color: red;"><?php if(isset($_GET['error'])) { echo $_GET['error']; } ?></p>
                    <div class="form-group">
                        <label for="user_name" class="form-label"> Username </label>
                        <input type="text" class="form-control" id="register-username" name="user_name" placeholder="Username" required>
                    </div><br>
                    <div class="form-group">
                        <label for="user_email" class="form-label"> Email </label>
                        <input type="email" class="form-control" id="register-email" name="user_email" placeholder="Email" required>
                    </div><br>
                    <div class="form-group">
                        <label for="user_password" class="form-label"> Password </label>
                        <input type="password" class="form-control" id="register-password" name="user_password" placeholder="Password" required>
                    </div><br>
                    <div class="form-group">
                        <label for="confirmPassword" class="form-label"> Confirm Password </label>
                        <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Confirm Password" required>
                    </div><br>
                    <div class="form-group">
                        <button type="submit" class="normal" id="register-btn" name="register">Register</button>
                    </div><br>
                    <div class="form-group">
                        <a href="login.php" id="login-url">Do you have an account? Login</a>
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