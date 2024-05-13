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

  // Handling checkout
  if (isset($_POST['checkout'])) {
    // Set the order data in a cookie
    $order = array(
      'order' => $product['name'],
      'quantity' => $_POST['quantity'],
      'total' => $product['price'] * $_POST['quantity']
    );
    setcookie('user_order', serialize(array('orders' => array($order))), time() + (86400 * 30), "/"); // 86400 = 1 day
    // Redirect to the thank you page
    header("Location: thanks.php");
    exit();
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
  <style>
    /* Add to Cart button styles */
    .add-to-cart {
      background-color: black;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .add-to-cart:hover {
      background-color: #272829;
    }

    /* Checkout button styles */
    .checkout {
      background-color: black;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .checkout:hover {
      background-color: #272829;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <?php include "./partials/navbar.html" ?>



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
      <form method="post" onsubmit="return validateQuantity()">
        <div class="quantity-selector">
          <button onclick="decrementQuantity()" aria-label="Decrease quantity">-</button>
          <input type="number" id="quantity" value="1" min="1" max="<?php echo $product['quantity']; ?>" name="quantity" />
          <button onclick="incrementQuantity()" aria-label="Increase quantity">+</button>
        </div>

        <form method="post">
          <div class="add-to-cart-container">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <button class="add-to-cart" type="submit" name="add_to_cart">
              Add to Cart
            </button>
          </div>
          <div class="add-to-cart-container">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <button class="checkout" type="submit" name="checkout">
              Checkout
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
      // Get the quantity input element
      var quantityInput = document.getElementById("quantity");
      // Get the current quantity value
      var currentQuantity = parseInt(quantityInput.value, 10);
      // Calculate the new quantity
      var newQuantity = currentQuantity + 1;
      // Update the quantity input value
      quantityInput.value = newQuantity;

      // Prevent the default form submission behavior
      return false;
    }

    function decrementQuantity() {
      var quantity = parseInt(document.getElementById("quantity").value, 10);
      if (quantity > 1) {
        document.getElementById("quantity").value = quantity - 1;
      }
    }
  </script>

  <script>
    // Function to validate the selected quantity
    function validateQuantity() {
      var quantityInput = document.getElementById("quantity");
      var selectedQuantity = parseInt(quantityInput.value, 10);
      var maxQuantity = parseInt('<?php echo $product['quantity']; ?>', 10);

      if (selectedQuantity > maxQuantity) {
        alert("You cannot add more items than what's available in stock.");
        return false; // Prevent form submission
      }

      return true; // Allow form submission
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
<?php include "./partials/footer.html" ?>