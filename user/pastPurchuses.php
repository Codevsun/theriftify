<!DOCTYPE html>
<html>
  <head>
    <!-- Bootstrap CDN -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="pastpurcheses.css" />
  </head>

  <body>
    <!-- Navbar -->
      <?php include "./partials/navbar.html" ?>

    <div class="d-flex justify-content-between">
      <div class="dropdown" style="margin-top: 60px; margin-bottom: 50px"></div>
    </div>

    <!-- <br> -->
    <div style="margin-bottom: 550px">
      <div class="m-2">
        <h1>Past Purchuses</h1>
        <div class="table-responsive">
          <!-- <table class="table" id="pastPurchasesTable">
            <thead>
              <tr>
                <th>Order</th>
                <th>Quantity</th>
                <th>Total</th>
               </tr>
            </thead> -->
            <?php
// Check if the order cookie is set
if(isset($_COOKIE['user_order'])) {
    // Unserialize the order data from the cookie
    $orderData = unserialize($_COOKIE['user_order']);
    // Access the orders
    $orders = $orderData['orders'];

    // Check if there are any orders
    if(!empty($orders)) {
        // Display the table header
        echo "<table class='table' id='pastPurchasesTable'>";
        echo "<tr><th>Order</th><th>Quantity</th><th>Total</th></tr>";

        // Loop through each order and display it in a table row
        foreach ($orders as $order) {
            $orderName = $order['order'];
            $quantity = $order['purchase_history'];
            $total = $order['total'];
            echo "<tr><td>$orderName</td><td>$quantity</td><td>$total</td></tr>";
        }

        echo "</table>";
    } else {
        echo "No orders yet.";
    }
} else {
    echo "Order cookie is not set.";
}
?>

          <!-- </table> -->
        </div>
      </div>

      <!-- Footer -->
      <a href="Women.html">
        <button
          type="button"
          class="btn btn-secondary"
          style="
            margin-top: 50px;
            margin-left: 550px;
            width: 120px;
            height: 40px;
          "
        >
          Back
        </button>
      </a>
    </div>
    <?php include "./partials/footer.html" ?>
