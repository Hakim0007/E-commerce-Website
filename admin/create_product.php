<?php include "../server/configuration.php"; ?>

<?php

if(isset($_POST['create_product'])){

    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_image = $_FILES['image']['name'];
    $product_image_temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($product_image_temp, "../img/products/$product_image");
    
    $query = $connection->prepare("INSERT INTO products (product_name, product_description, product_price,
                                                         product_category, product_image)
                                                         VALUES (?, ?, ?, ?, ?)");
    $query->bind_param('sssss', $product_name, $product_description, $product_price, $product_category, $product_image);
    
    if($query->execute()){
        header('location: products.php?product_created=Product has been created successfully');
    } else {
        header('location: products.php?product_failed=Error occurred, try again');
    }

} else {
    header('location: products.php');
    exit;
}

?>