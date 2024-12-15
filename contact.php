<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact</title>
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
                    <li><a class="active" href="contact.php">Contact</a></li>
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

        <section id="page-header" class="about-header">

            <h2>#let's talk</h2>

            <p>LEAVE A MESSAGE, We love to hear from you!</p>

        </section>

        <section id="contact-details" class="section-p1">
            <div class="details">
                <span>GET IN TOUCH</span>
                <h2>Visit one of our agency locations or contact us today</h2>
                <h3>Head Office</h3>
                <div>
                    <li>
                        <i class="fal fa-map"></i>
                        <p>56 Glassford Street Glasgow G1 1UL New York</p>
                    </li>
                    <li>
                        <i class="fal fa-envelope"></i>
                        <p>contact@example.com</p>
                    </li>
                    <li>
                        <i class="fal fa-phone-alt"></i>
                        <p>+844 123 456 78</p>
                    </li>
                    <li>
                        <i class="fal fa-clock"></i>
                        <p>Monday to Saturday: 9:00 AM to 16:00 PM</p>
                    </li>
                </div>
            </div>

            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2369.079375891103!2d-2.4387965242347196!3d53.574199957651594!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487ba7add9a0139b%3A0x26e04dfac5ed4688!2sUniversity%20of%20Bolton!5e0!3m2!1sen!2skw!4v1708008030666!5m2!1sen!2skw" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <section id="form-details">
            <form method="post" action="contact.php">
                <span>LEAVE A MESSAGE</span>
                <h2>We love to hear from you</h2>
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="E-mail" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea name="message" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
                <button class="normal">Submit</button>
            </form>

            <div class="people">
                <div>
                    <img src="img/people/1.png" alt="">
                    <p><span>John Doe</span> Senior Marketing Manager <br> Phone: + 000 123 
                    000 77 88 <br>Email: contact@example.com</p>
                </div>
                <div>
                    <img src="img/people/2.png" alt="">
                    <p><span>William Smith</span> Senior Marketing Manager <br> Phone: + 000 123 
                    000 77 88 <br>Email: contact@example.com</p>
                </div>
                <div>
                    <img src="img/people/3.png" alt="">
                    <p><span>Emma Stone</span> Senior Marketing Manager <br> Phone: + 000 123 
                    000 77 88 <br>Email: contact@example.com</p>
                </div>
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
        
        <script src="script.js"></script>
    </body>

</html>