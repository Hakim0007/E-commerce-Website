<?php include "../server/configuration.php"; ?>

<?php session_start(); ?>

<?php

if (!isset($_SESSION['admin_logged_in'])) {
  header('location: login.php');
  exit;
}

if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];

    $query = $connection->prepare("DELETE FROM products WHERE product_id = ?");

    $query->bind_param('i', $product_id);

    if($query->execute()){

        header('location: products.php?deleted_successfully=Product has been deleted successfully');

    } else {
        header('location: products.php?deleted_failure=Could not delete product');
    }
}

?>