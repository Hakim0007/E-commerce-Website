<?php include "header.php"; ?>

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

            <h2>Create Product</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form id="create-form" enctype="multipart/form-data" method="post" action="create_product.php">
                        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                        <div class="form-group mt-2">
                            <label for="product_name" class="form-label"> Title </label>
                            <input type="text" class="form-control" id="product-name" name="product_name" placeholder="Title">
                        </div>
                        <div class="form-group mt-2">
                            <label for="product_description" class="form-label"> Description </label>
                            <input type="text" class="form-control" id="product-desc" name="product_description" placeholder="Description">
                        </div>
                        <div class="form-group mt-2">
                            <label for="product_price" class="form-label"> Price </label>
                            <input type="text" class="form-control" id="product-price" name="product_price" placeholder="Price">
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
                            <label for="product_image" class="form-label"> Image </label>
                            <input type="file" class="form-control" name="image" id="image" placeholder="Image">
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary" name="create_product">Create</button>
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