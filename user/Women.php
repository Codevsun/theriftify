<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Discover a variety of pre-loved Women's clothing at Thriftify. Shop sustainable fashion with our wide range of dresses, jackets, pants, and more." />
  <meta name="keywords" content="Women's clothing, thrift shop, sustainable fashion, pre-loved clothes, second-hand dresses, affordable fashion, eco-friendly clothing, thrift store" />
  <title>Thrift Shop - Women's Clothing</title>
  <link rel="stylesheet" href="MenWomen.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <style>
    .modal-overlay {
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
      display: flex;
    }

    .modal-overlay {
      display: none;
      /* Add other styling as needed */
    }

    .modal-content {
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      width: 100%;
      max-width: 600px;
      /* Set a maximum width for the modal */
    }

    * {
      font-family: "Nunito", sans-serif;
      margin: 0;
      padding: 0;
      scroll-behavior: smooth;
      box-sizing: border-box;
    }

    /* body {
     width: 100%;
     height: 100vh;
     display: flex;
     flex-direction: column;
     color: black;
     /* background: #ffffff; */
    /* justify-content: center;
     letter-spacing: 0.2em;
   } */
    .contact-container {
      max-width: 960px;
      margin: auto;
      width: 100%;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1.5rem;
      background: #cccccc;
      box-shadow: 0 0 1rem hsla(0 0 0 / 16%);
      border-radius: 0.5rem;
      overflow: hidden;
      letter-spacing: 0.2em;
    }

    .form-container {
      padding: 20px;
      letter-spacing: 0.2em;
    }

    .form-container h3 {
      font-size: 1.2rem;
      font-weight: 600;
      margin-bottom: 1rem;
      letter-spacing: 0.2em;
    }

    .contact-form {
      display: grid;
      row-gap: 1rem;
    }

    .contact-form input,
    .contact-form button,
    .contact-form textarea {
      width: 100%;
      border: none;
      outline: none;
      background: #ffffff;
      padding: 10px;
      font-size: 0.9rem;
      color: black;
      border-radius: 0.4rem;
      letter-spacing: 0.2em;
    }

    .contact-form textarea {
      resize: none;
      height: 200px;
    }

    .contact-form .send-button {
      border: none;
      outline: none;
      background: #ffffff;
      font-size: 1rem;
      font-weight: 500;
      text-transform: uppercase;
      cursor: pointer;
      letter-spacing: 0.2em;
    }

    .contact-form .send-button:hover {
      background: hsla(0, 0%, 94%, 0.8);
      transition: 0.3s all linear;
    }

    .map iframe {
      width: 100%;
      height: 100%;
    }

    /* responsivie */
    @media (max-width: 964px) {
      .contact-container {
        margin: 0 auto;
        width: 90%;
      }
    }

    @media (max-width: 700px) {
      .contact-container {
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-top: 20rem !important;
      }

      .map iframe {
        height: 400px;
      }
    }

    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }

    .contact-popup {
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
</head>

<body>

  <?php include "./partials/navbar.html" ?>


  <?php
  require_once "db_connection.php";

  // Initialize selected category variable
  $selectedCategory = $_GET['category'] ?? 'women'; // Default to 'women' if category is not set

  // Query to select products based on the selected category
  $query = "SELECT * FROM products WHERE Product_Category = '$selectedCategory'";
  $result = mysqli_query($connection, $query);

  // Initialize an array to store product information
  $products = array();

  // Check if there are any products in the database
  if (mysqli_num_rows($result) > 0) {
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
      // Extract product information from the current row
      $productId = $row['Product_ID'];
      $productName = $row['Product_Name'];
      $productDescription = $row['Product_Description'];
      $productPrice = $row['Product_Price'];
      $productImage = $row['Product_Img_URL'];

      // Store product information in an associative array
      $product = array(
        'id' => $productId,
        'name' => $productName,
        'description' => $productDescription,
        'price' => $productPrice,
        'image' => $productImage
      );

      // Push the product array into the products array
      $products[] = $product;
    }
  }


  $queryMaxID = "SELECT COUNT(*) AS max_id FROM products WHERE Product_Category = '$selectedCategory'";
  $resultMaxID = mysqli_query($connection, $queryMaxID);

  // Initialize a variable to store the maximum ID
  $maxID = 0;

  // Check if the query was successful
  if ($resultMaxID) {
    // Fetch the result as an associative array
    $rowMaxID = mysqli_fetch_assoc($resultMaxID);

    // Get the maximum ID
    $maxID = $rowMaxID['max_id'];
  } else {
    // Display an error message if the query fails
    echo "Error: " . mysqli_error($connection);
  }



  ?>
  <!-- Main Content -->
  <!-- Buttons Section -->

  <!-- Buttons with Dropdown Menus -->
  <div class="d-flex justify-content-between">
    <div style="margin-top: 60px">
      <select id="categoryDropdown" class="form-select m-3">
        <option value="women">Women</option>
        <option value="men">Men</option>
      </select>
    </div>


  </div>


  <main>
    <div class="item-count">
      <p>Items Available: <?php echo $maxID; ?> </p>
      <!-- Adjust the number of items as needed -->
    </div>
    <!-- Row grid -->

    <div class="product-grid">
      <?php foreach ($products as $product) : ?>
        <div class="product-card">
          <a href="DetailedPage.php?id=<?php echo $product['id']; ?>">
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image" />
            <div class="product-info">
              <p class="product-name"><?php echo $product['name']; ?></p>
              <p class="product-description"><?php echo $product['description']; ?></p>
              <p class="product-price">$<?php echo $product['price']; ?></p>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>

</body>


<script>
  // Select the dropdown menu
  let selectmenu = document.querySelector('#categoryDropdown');

  // Listen for the change event on the dropdown menu
  selectmenu.addEventListener('change', function(e) {
    // Get the selected category value
    let selectedCategory = e.target.value;
    // Redirect to the corresponding page with the selected category value
    window.location.href = 'Women.php?category=' + selectedCategory;
  });
</script>

<?php include "./partials/footer.html" ?>