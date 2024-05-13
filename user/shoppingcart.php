<?php
// Start session
session_start();

$totalQuantity = 0;
$totalPrice = 0;
// Initialize an empty array to store products
$products = array();

// Assuming you have already established a database connection
require_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['delete_product_id'])) {
    $delete_product_id = $_POST['delete_product_id'];
    // Remove the product from the cart if it exists
    if (isset($_SESSION['cart'][$delete_product_id])) {
      unset($_SESSION['cart'][$delete_product_id]);
    }
  }

  if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    
    // Update the session cart
    if (isset($_SESSION['cart'][$product_id])) {
      $_SESSION['cart'][$product_id] = $quantity;
    }
  }
}

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
  $products = []; // Array to hold product details

  foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $stmt = $connection->prepare("SELECT * FROM products WHERE Product_ID = ?");
    $stmt->bind_param("s", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $product = array(
        'id' => $row['Product_ID'],
        'name' => $row['Product_Name'],
        'description' => $row['Product_Description'],
        'price' => $row['Product_Price'],
        'image' => $row['Product_Img_URL'],
        'quantity' => $quantity,
        'max_quantity' => $row['Product_Quantity']
      );
      $products[] = $product;
      $totalQuantity += $quantity;
      $totalPrice += $product['price'] * $quantity;
    }
  }
} else {
  echo "Your shopping cart is empty!";
}

ob_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Shopping Cart - Thriftify</title>

  <!-- Font URL -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet" />
  <!-- Connecting bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
  <link href="shoppingcart.css" rel="stylesheet" />
  <link href="MenWomen.css" rel="stylesheet" />
</head>

<body>
  <script>
    function incrementQuantity(productId) {
      var quantityDisplay = document.getElementById("quantityDisplay" + productId);
      var quantity = parseInt(quantityDisplay.innerText);
      var maxQuantity = parseInt(document.getElementById("quantityDisplay" + productId).parentNode.getAttribute("data-max"));

      if (quantity < maxQuantity) {
        quantity++;
        quantityDisplay.innerText = quantity;
        submitQuantityChange(productId, quantity);
        recalculateTotalPrice();
      } else {
        alert("Maximum available quantity reached.");
      }
    }

    function decrementQuantity(productId) {
      var quantityDisplay = document.getElementById("quantityDisplay" + productId);
      var quantity = parseInt(quantityDisplay.innerText);
      if (quantity > 1) {
        quantity--;
        quantityDisplay.innerText = quantity;
        submitQuantityChange(productId, quantity);
        recalculateTotalPrice();
      }
    }

    function recalculateTotalPrice() {
        var total = 0;
        var items = document.querySelectorAll(".item");
        
        items.forEach(function(item) {
            var price = parseFloat(item.getAttribute("data-price")); // Ensure price is stored in an attribute
            var quantityDisplay = item.querySelector(".quantityDisplay");
            var quantity = parseInt(quantityDisplay.innerText);
            total += price * quantity;
        });

        // Display the total price in the appropriate element
        document.getElementById("totalPrice").innerText = "$" + total;
    }

    function submitQuantityChange(productId, newQuantity) {
        // Create a form dynamically
        var form = document.createElement('form');
        form.style.display = 'none';
        form.method = 'POST';
        form.action = window.location.href; // Submit to the same page or specify the endpoint

        // Add the product ID field
        var idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'product_id';
        idInput.value = productId;
        form.appendChild(idInput);

        // Add the quantity field
        var quantityInput = document.createElement('input');
        quantityInput.type = 'hidden';
        quantityInput.name = 'quantity';
        quantityInput.value = newQuantity;
        form.appendChild(quantityInput);

        // Append and submit the form
        document.body.appendChild(form);
        form.submit();
    }
  </script>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <!-- Brand centered -->
      <a href="Women.php" class="navbar-brand">THRIFTIFY</a>
      <!-- Navbar toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <!-- Left side of navbar -->
          <li class="nav-item">
            <a href="Women.php" class="nav-link"><i class="bi bi-house" style="margin-right: 20px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                </svg></i>Home</a>
          </li>

          <!-- right side of navbar -->
          <li class="nav-item">
            <a href="shoppingcart.php" class="nav-link"><i class="bi bi-bag" style="margin-right: 20px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                  <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                </svg></i>Cart</a>
          </li>
          <li class="nav-item">
            <a href="pastPurchuses.html" class="nav-link"><i class="bi bi-bag" style="margin-right: 20px"><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11 1.5C11 1.22386 10.7761 1 10.5 1C10.2239 1 10 1.22386 10 1.5V4H5V1.5C5 1.22386 4.77614 1 4.5 1C4.22386 1 4 1.22386 4 1.5V4H1.5C1.22386 4 1 4.22386 1 4.5C1 4.77614 1.22386 5 1.5 5H4V10H1.5C1.22386 10 1 10.2239 1 10.5C1 10.7761 1.22386 11 1.5 11H4V13.5C4 13.7761 4.22386 14 4.5 14C4.77614 14 5 13.7761 5 13.5V11H10V13.5C10 13.7761 10.2239 14 10.5 14C10.7761 14 11 13.7761 11 13.5V11H13.5C13.7761 11 14 10.7761 14 10.5C14 10.2239 13.7761 10 13.5 10H11V5H13.5C13.7761 5 14 4.77614 14 4.5C14 4.22386 13.7761 4 13.5 4H11V1.5ZM10 10V5H5V10H10Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg></i>past purchases</a>
          </li>
          <li class="nav-item">
            <a href="aboutUs.html" class="nav-link"><i class="bi bi-bag" style="margin-right: 20px"><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.877197 7.49984C0.877197 3.84216 3.84234 0.877014 7.50003 0.877014C11.1577 0.877014 14.1229 3.84216 14.1229 7.49984C14.1229 11.1575 11.1577 14.1227 7.50003 14.1227C3.84234 14.1227 0.877197 11.1575 0.877197 7.49984ZM7.50003 1.82701C4.36702 1.82701 1.8272 4.36683 1.8272 7.49984C1.8272 10.6328 4.36702 13.1727 7.50003 13.1727C10.633 13.1727 13.1729 10.6328 13.1729 7.49984C13.1729 4.36683 10.633 1.82701 7.50003 1.82701ZM7.12457 9.00001C7.06994 9.12735 6.33165 11.9592 6.33165 11.9592C6.26018 12.226 5.98601 12.3843 5.71928 12.3128C5.45255 12.2413 5.29425 11.9672 5.36573 11.7004C5.36573 11.7004 6.24661 8.87268 6.24661 8.27007V6.80099L4.28763 6.27608C4.0209 6.20461 3.86261 5.93045 3.93408 5.66371C4.00555 5.39698 4.27972 5.23869 4.54645 5.31016C4.54645 5.31016 6.20042 5.87268 6.84579 5.87268H8.15505C8.80042 5.87268 10.4534 5.31042 10.4534 5.31042C10.7202 5.23895 10.9943 5.39724 11.0658 5.66397C11.1373 5.93071 10.979 6.20487 10.7122 6.27635L8.74661 6.80303V8.27007C8.74661 8.87268 9.62663 11.6971 9.62663 11.6971C9.6981 11.9639 9.5398 12.238 9.27307 12.3095C9.00634 12.381 8.73217 12.2227 8.6607 11.956C8.6607 11.956 7.91994 9.12735 7.86866 9.00001C7.81994 8.87268 7.65006 8.87268 7.65006 8.87268H7.34317C7.34317 8.87268 7.16994 8.87268 7.12457 9.00001ZM7.50043 5.12007C8.12175 5.12007 8.62543 4.61639 8.62543 3.99507C8.62543 3.37375 8.12175 2.87007 7.50043 2.87007C6.87911 2.87007 6.37543 3.37375 6.37543 3.99507C6.37543 4.61639 6.87911 5.12007 7.50043 5.12007Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg></i>About</a>
          </li>
          <li class="nav-item">
            <a href="contactus.html" class="nav-link"><i class="bi bi-bag" style="margin-right: 20px"><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 2C0.447715 2 0 2.44772 0 3V12C0 12.5523 0.447715 13 1 13H14C14.5523 13 15 12.5523 15 12V3C15 2.44772 14.5523 2 14 2H1ZM1 3L14 3V3.92494C13.9174 3.92486 13.8338 3.94751 13.7589 3.99505L7.5 7.96703L1.24112 3.99505C1.16621 3.94751 1.0826 3.92486 1 3.92494V3ZM1 4.90797V12H14V4.90797L7.74112 8.87995C7.59394 8.97335 7.40606 8.97335 7.25888 8.87995L1 4.90797Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg></i>contact us
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->

  <div class="card">
    <div class="row">
      <div class="col-md-8 cart">
        <div class="title">
          <div class="row">
            <div class="col">
              <h4><b>Shopping Cart</b></h4>
            </div>
            <div class="col align-self-center text-right text-muted">
              <?php echo $totalQuantity; ?> items
            </div>
          </div>
        </div>
        <div class="row border-top border-bottom">
          <?php foreach ($products as $product) : ?>
            <div class="row main align-items-center">
              <div class="col-2">
                <!-- Display product image -->
                <img class="img-fluid" src="<?php echo $product['image']; ?>" />
              </div>
              <div class="col">
                <!-- Display products name -->
                <div class="row"><?php echo $product['name']; ?></div>
              </div>
              <div class="col">
                <!-- Quantity control buttons -->
                <div class="col item" data-price="<?php echo $product['price']; ?>" data-max="<?php echo $product['max_quantity']; ?>">
                  <!-- Quantity control buttons -->
                  <a href="#" onclick="decrementQuantity(<?php echo $product['id']; ?>); return false;">-</a>
                  <span id="quantityDisplay<?php echo $product['id'] ?>" class="quantityDisplay border"><?php echo $product['quantity']; ?></span>
                  <a href="#" onclick="incrementQuantity(<?php echo $product['id']; ?>); return false;">+</a>
                </div>

              </div>
              <form class="col" method="POST">
                $ <?php echo $product['price']; ?>
                <button type="submit" class="close" style="background-color: transparent; border: none;">x</button>
                <input type="hidden" name="delete_product_id" value="<?php echo $product['id']; ?>" style="display: none;">
              </form>
            </div>
            <?php
            // Update total quantity and price
            $totalQuantity += $product['quantity'];
            ?>
          <?php endforeach; ?>
        </div>

        <div class="row">
          <div class="row main align-items-center">

          </div>
        </div>
      </div>
      <div class="col-md-4 summary">
        <div>
          <h5><b>Summary</b></h5>
        </div>
        <hr />
        <div class="row">

        </div>
        <form>
          <p>SHIPPING</p>
          <select>
            <option class="text-muted">Standard-Delivery- $ 25</option>
            <option class="text-muted">Express-Delivery- $ 50</option>
          </select>
          <p>GIVE CODE</p>
          <input id="code" placeholder="Enter your code" />
        </form>
        <div class="row" style="border-top: 1px solid rgba(0, 0, 0, 0.1); padding: 2vh 0">
          <div class="col">TOTAL PRICE</div>
          <div class="col text-right" id="totalPrice">$<?php echo $totalPrice; ?></div>
        </div>
          <form action="thanks.php" method="POST" onsubmit="return setPurchaseCookie();">
            <button class="btn">CHECKOUT</button>
        </form>
      </div>
    </div>
  </div>

  <script>
  function setPurchaseCookie() {
    var products = <?php echo json_encode($products); ?>;
    var expiryDate = new Date();
    // Set the cookie to expire in 7 days
    expiryDate.setDate(expiryDate.getDate() + 7);
    document.cookie = "purchase=" + encodeURIComponent(JSON.stringify(products)) + ";expires=" + expiryDate.toUTCString() + ";path=/;Secure";
    return true;
  }
</script>

  <?php
    // Now you can set cookies or modify headers
    setcookie("purchase", json_encode($products));

    ob_end_flush(); // Send output buffer and turn off buffering
  ?>
  <!-- Footer -->

  <footer class="bg-dark text-light py-3 text-center fixed-bottom">
    <div class="container">
      <div class="row">
        <div class="col">
          <a class="nav-link text-light" href="contactus.html">Contact Us</a>
        </div>
        <div class="col">
          <a class="nav-link text-light" href="#">FAQs</a>
        </div>
        <div class="col">
          <a class="nav-link text-light" href="#">Country/Region: Saudi Arabia</a>
        </div>
      </div>
      <div class="row mt-2">
        <!-- Added margin top to create space -->
        <div class="col">
          <p>
            THRIFTIFY and the THRIFTIFY logo are trademarks of Thriftify and
            are registered or pending registration in numerous jurisdictions
            around the world. &copy; Copyright 2024 Thriftify. All rights
            reserved.
          </p>
        </div>
      </div>
    </div>
  </footer>
</body>


<!-- Bootstrap JS and dependencies -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>