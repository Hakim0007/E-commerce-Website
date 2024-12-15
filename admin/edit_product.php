<?php include "header.php"; ?>

<?php

if(isset($_GET['product_id'])){

    $product_id = $_GET['product_id'];

    $stmt = $connection->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $products = $stmt->get_result();
    
} else if(isset($_POST['edit_btn'])){

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_image = $_FILES['image']['name'];
    $product_image_temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($product_image_temp, "../img/products/$product_image");
    
    $query = $connection->prepare("UPDATE products SET product_name = ?, product_description = ?, product_price = ?,
                                    product_category = ?, product_image = ? WHERE product_id = ?");
    $query->bind_param('sssssi', $product_name, $product_description, $product_price, $product_category, $product_image, $product_id);
    
    if($query->execute()){
        header('location: products.php?edit_success_message=Product has been updated successfully');
    } else {
        header('location: products.php?edit_failure_message=Error occurred, try again');
    }

} else {
    header('location: products.php');
    exit;
}

?>

<div class="container-fluid">
    <div class="row">
      
      <?php include "sidemenu.php"; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">

                    </div>          
                </div>
            </div>

            <h2>Edit Product</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form id="edit-form" enctype="multipart/form-data" method="post" action="edit_product.php">
                        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                        <div class="form-group mt-2">

                            <?php foreach($products as $product){ ?>
                                
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

                            <label for="product_name" class="form-label"> Title </label>
                            <input type="text" class="form-control" id="product-name" value="<?php echo $product['product_name']; ?>" name="product_name" placeholder="Title">
                        </div>
                        <div class="form-group mt-2">
                            <label for="product_description" class="form-label"> Description </label>
                            <input type="text" class="form-control" id="product-desc" value="<?php echo $product['product_description']; ?>" name="product_description" placeholder="Description">
                        </div>
                        <div class="form-group mt-2">
                            <label for="product_price" class="form-label"> Price </label>
                            <input type="text" class="form-control" id="product-price" value="<?php echo $product['product_price']; ?>" name="product_price" placeholder="Price">
                        </div>
                        <div class="form-group mt-2">
                            <label for="product_category" class="form-label"> Category </label>
                            <select name="product_category" class="form-select">
                                <option value="shirts">Shirts</option>
                                <option value="t-shirts">T-Shirts</option>
                                <option value="shorts">Shorts</option>
                                <option value="pants">Pants</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <img src="../img/products/<?php echo $product['product_image']; ?>" alt="" style="width: 70px; height: 70px;">
                            <input type="file" class="form-control" name="image" id="image" placeholder="Image">
                        </div>

                        <?php } ?>
                        
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary" name="edit_btn">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>