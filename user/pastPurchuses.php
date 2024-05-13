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

    <div style="margin-bottom: 550px">
      <div class="m-2">
        <h1>Past Purchases</h1>
        <div class="table-responsive">
          <table class="table" id="pastPurchasesTable">
            <thead>
              <tr>
                <th>Order</th>
                <th>Quantity</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Check if the order cookie is set
              if(isset($_COOKIE['purchase'])) {
                  // Retrieve and decode the purchase data from the cookie
                  $purchaseData = json_decode($_COOKIE['purchase'], true);
                  
                  // Check if there are any purchases
                  if(!empty($purchaseData)) {
                      // Loop through each purchase and display it in a table row
                      foreach ($purchaseData as $purchase) {
                          echo "<tr>";
                          echo "<td>" . $purchase['name'] . "</td>";
                          echo "<td>" . $purchase['quantity'] . "</td>";
                          echo "<td>$" . $purchase['price'] * $purchase['quantity'] . "</td>";
                          echo "</tr>";
                      }
                  } else {
                      echo "<tr><td colspan='3'>No purchases yet.</td></tr>";
                  }
              } else {
                  echo "<tr><td colspan='3'>Purchase cookie is not set.</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Footer -->
      <a href="Women.php">
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
  </body>
</html>
