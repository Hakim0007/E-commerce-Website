<?php include "../server/configuration.php"; ?>

<?php session_start(); ?>

<?php

if (isset($_SESSION['admin_logged_in'])){
    header('location: index.php');
    exit;
}

if (isset($_POST['login_btn'])){
    
    $admin_email = $_POST['admin_email'];
    $admin_password = md5($_POST['admin_password']);

    $query = $connection->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? AND admin_password = ?");

    $query->bind_param('ss', $admin_email, $admin_password);
    
    if ($query->execute()) {

        $query->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        $query->store_result();

        if ($query->num_rows() == 1) {
            
            $row = $query->fetch();

            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email']= $admin_email;
            $_SESSION['admin_logged_in'] = true;

            header('location: index.php?login_success=logged in successfully');
        
        } else {
            header('location: login.php?error=could not verify your account');
        }

    } else {
        // error
        die("QUERY FAILED." . mysqli_error($connection));
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="generator" content="Hugo 0.88.1">
      <title>Admin Login</title>
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

      <link rel="stylesheet" href="../style.css">
      
  </head>
  <body>
    <section class="section-p1 section-m1">
        <div class="container" style="text-align: center;">
            <h2 style="font-weight: bold">Login</h2>
        </div>
        <div class="container">
            <form action="login.php" method="post" id="login-form">
                <p style="color: red; text-align: center;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                <div class="form-group">
                    <label for="admin_email" class="form-label"> Email </label>
                    <input type="email" class="form-control" id="login-email" name="admin_email" placeholder="Email" required>
                </div><br>
                <div class="form-group">
                    <label for="admin_password" class="form-label"> Password </label>
                    <input type="password" class="form-control" id="login-password" name="admin_password" placeholder="Password" required>
                </div><br>
                <div class="form-group">
                    <button type="submit" class="normal" id="login-btn" name="login_btn">Login</button>
                </div>
            </form>
        </div>
    </section>
  </body>
</html>