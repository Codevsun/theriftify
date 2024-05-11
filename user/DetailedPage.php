<?php
// Start the session
session_start();

require_once "db_connection.php";

// Check if the ID parameter exists in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id']; // Get the raw product ID

    // Prepare a statement to fetch product details
    $stmt = $connection->prepare("SELECT * FROM products WHERE Product_ID = ?");
    $stmt->bind_param("s", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product = array(
            'id' => $row['Product_ID'],
            'name' => $row['Product_Name'],
            'description' => $row['Product_Description'],
            'price' => $row['Product_Price'],
            'image' => $row['Product_Img_URL'],
            'quantity' => $row['Product_Quantity']
        );
    } else {
        header("Location: 404.php");
        exit();
    }

    if (isset($_POST['add_to_cart'])) {
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1; // Default to 1 if quantity is not set
        if (isset($_SESSION['cart'])) {
            if (array_key_exists($product['id'], $_SESSION['cart'])) {
                $_SESSION['cart'][$product['id']] += $quantity;
            } else {
                $_SESSION['cart'][$product['id']] = $quantity;
            }
        } else {
            $_SESSION['cart'] = array($product['id'] => $quantity);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="keywords" content="MKI Hoodie, Phonetic Hoodie, Men's Fashion, Casual Wear, High-Quality Cotton, Sustainable Fashion, Eco-Friendly Clothing, Thrift Store" />
  <meta name="description" content="Explore the MKI Phonetic Hoodie on THRIFTIFY. This high-quality cotton hoodie combines style and comfort, perfect for your casual wardrobe." />
  <title>Product Detail Page</title>
  <link rel="stylesheet" href="Detail.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
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
        </ul>
      </div>
    </div>
  </nav>


  <!-- Buttons Section -->
  <!-- Buttons with Dropdown Menus -->


  <div class="product-detail-container" style="margin-top: 100px;">
    <div class="product-image-container">
      <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image" />
    </div>

    <div class="product-info-container">
      <h1 class="product-name"><?php echo $product['name']; ?></h1>
      <p class="product-description"><?php echo $product['description']; ?></p>
      <p class="product-price">$<?php echo $product['price']; ?></p>
      <p class="size-guide" onclick="openSizeGuide()">Size Guide 𖣳</p>
      <div class="size-selection">
        <table>
          <tr>
            <td>Small</td>
            <td>Medium</td>
          </tr>
        </table>
      </div>
      <p class="quantity-label">In stock: <?php echo $product['quantity']; ?></p>

      <!-- Quantity Selector -->
      <form method="post">
        <div class="quantity-selector">
          <button onclick="decrementQuantity()" aria-label="Decrease quantity">
            -
          </button>
          <input type="number" id="quantity" value="1" min="1" readonly name="quantity" />
          <button onclick="incrementQuantity()" aria-label="Increase quantity">
            +
          </button>
        </div>

        <div class="add-to-cart-container">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <button class="add-to-cart-button" type="submit" name="add_to_cart" style="width: 120px; height: 40px; margin: 15px">
              Add to Cart
            </button>
        </div>
      </form>

      <div class="product-description">
        <details>
          <summary>Detailed Description</summary>
          <p>
            Speak the language of style with <?php echo $product['name']; ?>. Made
            from soft, high-quality fabric, it's adorned with a phonetic print
            and is sure to be a cool and casual addition to any wardrobe.
          </p>
          <ul>
            <li>100% Cotton</li>
            <li>Drawstring Hood</li>
            <li>Kangaroo Pocket</li>
            <li>Ribbed Trims</li>
            <li>Printed Branding</li>
          </ul>
        </details>
      </div>
    </div>
  </div>

  <div id="size-guide-modal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeSizeGuide()">&times;</span>
      <img src="../images/size.jpg" alt="Size Guide" />
    </div>
  </div>

  <script>
    // Dummy functions for placeholder actions
    function openSizeGuide() {
      document.getElementById("size-guide-modal").style.display = "block";
    }

    function closeSizeGuide() {
      document.getElementById("size-guide-modal").style.display = "none";
    }

    function incrementQuantity() {
      var quantity = parseInt(document.getElementById("quantity").value, 10);
      document.getElementById("quantity").value = quantity + 1;
    }

    function decrementQuantity() {
      var quantity = parseInt(document.getElementById("quantity").value, 10);
      if (quantity > 1) {
        document.getElementById("quantity").value = quantity - 1;
      }
    }
  </script>



</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
  // Get the quantity value
  var quantity = parseInt(<?php echo $product['quantity']; ?>);

  // Function to update button state and label based on quantity
  function updateButtonState() {
    var addButton = document.querySelector('.add-to-cart-button');
    var quantityInput = document.getElementById('quantity');
    var quantityLabel = document.querySelector('.quantity-label');

    if (quantity === 0) {
      addButton.disabled = true;
      addButton.style.backgroundColor = 'lightgrey';
      addButton.textContent = 'Out of stock';
      quantityInput.disabled = true;
      quantityLabel.textContent = 'Not Available';
    } else {
      addButton.disabled = false;
      quantityInput.disabled = false;
      quantityLabel.textContent = 'In stock: ' + quantity;
    }
  }

  // Call the function to initially set button state
  updateButtonState();
</script>

<!-- Footer -->
<footer class="bg-dark text-light py-3 text-center">
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
          THRIFTIFY and the THRIFTIFY logo are trademarks of Thriftify and are
          registered or pending registration in numerous jurisdictions around
          the world. &copy; Copyright 2024 Thriftify. All rights reserved.
        </p>
      </div>
    </div>
  </div>
</footer>

</html>
