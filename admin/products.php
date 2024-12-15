<?php include "header.php"; ?>

<?php

if (!isset($_SESSION['admin_logged_in'])) {
  header('location: login.php');
  exit;
}

?>

<?php

if(isset($_GET['page_no']) && $_GET['page_no'] != "") {
  // if user has already entered page then page number is the one that they selected
  $page_no = $_GET['page_no'];

} else {
  // if user just entered the page then default page is 1
  $page_no = 1;
}

// return number of products
$query = $connection->prepare("SELECT COUNT(*) AS total_records FROM products");

$query->execute();

$query->bind_result($total_records);

$query->store_result();

$query->fetch();

// products per page
$total_records_per_page = 8;

$offset = ($page_no - 1) * $total_records_per_page;

$previous_page = $page_no - 1;

$next_page = $page_no + 1;

$adjacents = "2";

$total_no_of_pages = ceil($total_records/$total_records_per_page);

// get all products

$stmt = $connection->prepare("SELECT * FROM products LIMIT $offset, $total_records_per_page");
$stmt->execute();
$products = $stmt->get_result();

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

      <h2>Products</h2>
        <?php if(isset($_GET['edit_success_message'])){ ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message']; ?></p>
        <?php } ?>

        <?php if(isset($_GET['edit_failure_message'])){ ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message']; ?></p>
        <?php } ?>

        <?php if(isset($_GET['deleted_successfully'])){ ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully']; ?></p>
        <?php } ?>

        <?php if(isset($_GET['deleted_failure'])){ ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure']; ?></p>
        <?php } ?>

        <?php if(isset($_GET['product_created'])){ ?>
            <p class="text-center" style="color: green;"><?php echo $_GET['product_created']; ?></p>
        <?php } ?>

        <?php if(isset($_GET['product_failed'])){ ?>
            <p class="text-center" style="color: red;"><?php echo $_GET['product_failed']; ?></p>
        <?php } ?>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Product Id</th>
              <th scope="col">Product Image</th>
              <th scope="col">Product Name</th>
              <th scope="col">Product Category</th>
              <th scope="col">Product Description</th>
              <th scope="col">Product Price</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach($products as $product){ ?>
            <tr>
              <td><?php echo $product['product_id']; ?></td>
              <td><img src="<?php echo "../img/products/". $product['product_image']; ?>" style="width: 70px; height: 70px;"></td>
              <td><?php echo $product['product_name']; ?></td>
              <td><?php echo $product['product_category']; ?></td>
              <td><?php echo $product['product_description']; ?></td>
              <td><?php echo "$". $product['product_price']; ?></td>

              <td><a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary">Edit</a></td>
              <td><a href="delete_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-danger">Delete</a></td>
            
            </tr>
            
            <?php } ?>

          </tbody>
        </table>

        <nav aria-label="Page navigation" class="mx-auto">
            <ul class="pagination mt-5 mx-auto">

                <li class="page-item <?php if($page_no <= 1){echo 'disabled';} ?>">
                  <a href="<?php if($page_no <= 1){echo '#';} else {echo "?page_no=".($page_no - 1);} ?>" class="page-link">Previous</a>
                </li>

                <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>

                <?php if($page_no >= 3) { ?>
                  <li class="page-item"><a href="#" class="page-link">...</a></li>
                  <li class="page-item"><a href="<?php echo "?page_no=".$page_no; ?>" class="page-link"><?php echo $page_no; ?></a></li>
                <?php } ?>

                <li class="page-item <?php if($page_no >= $total_no_of_pages){echo 'disabled';} ?>">
                  <a href="<?php if($page_no >= $total_no_of_pages){echo '#';} else {echo "?page_no=".($page_no + 1);} ?>" class="page-link">Next</a>
                </li>
            </ul>
        </nav>
      </div>
    </main>
  </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>