<?php include "header.php"; ?>

<?php

if(isset($_GET['order_id'])){

    $order_id = $_GET['order_id'];

    $stmt = $connection->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $orders = $stmt->get_result();
    
} else if(isset($_POST['edit_order'])){

    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $order_date = $_POST['order_date'];
    
    $query = $connection->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
    $query->bind_param('si', $order_status, $order_id);
    
    if($query->execute()){
        header('location: index.php?edit_success_message=Order has been updated successfully');
    } else {
        header('location: index.php?edit_failure_message=Error occurred, try again');
    }

} else {
    header('location: index.php');
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

            <h2>Edit Order</h2>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form id="edit-order-form" method="post" action="edit_order.php">
                        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>
                        <div class="form-group my-3">

                            <?php foreach($orders as $order){ ?>
                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">                            
                                    
                            <label for="order_id" class="form-label"> OrderId </label>
                            <p class="my-4"><?php echo $order['order_id']; ?></p>

                        </div>

                        <div class="form-group mt-3">
                            <label for="order_price" class="form-label"> Order Price </label>
                            <p class="my-4"><?php echo $order['order_cost']; ?></p>
                        </div>

                        <div class="form-group my-3">
                            <label for="order_status" class="form-label"> Order Status </label>
                            <select class="form-select" name="order_status">
                                <option value="not paid <?php if($order['order_status'] == "not paid"){ echo "selected";}?>">Not Paid</option>
                                <option value="paid <?php if($order['order_status'] == "paid"){ echo "selected";}?>">Paid</option>
                                <option value="shipped <?php if($order['order_status'] == "shipped"){ echo "selected";}?>">Shipped</option>
                                <option value="delivered <?php if($order['order_status'] == "delivered"){ echo "selected";}?>">Delivered</option>
                            </select>
                        </div>

                        <div class="form-group my-3">
                            <label for="order_date" class="form-label"> Order Date </label>
                            <p class="my-4"><?php echo $order['order_date']; ?></p>
                        </div>

                        <?php } ?>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary" name="edit_order">Edit</button>
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