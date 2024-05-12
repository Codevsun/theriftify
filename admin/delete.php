<?php
$connection = mysqli_connect("localhost:3309", "root", "", "theriftify");

// Initialize selected category variable
$selectedCategory = $_GET['category'] ?? 'women'; // Default to 'women' if category is not set

// Check if search query is submitted
if (isset($_POST['search'])) {
  // Get the search query
  $searchQuery = $_POST['search'];

  // Query to select products based on search query
  $query = "SELECT * FROM products WHERE Product_Name LIKE '%$searchQuery%'";
} else {
  // Query to select all products
  $query = "SELECT * FROM products";
}

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
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="keywords" content="thrift shop, men's clothing, sustainable fashion, pre-loved clothes, men's fashion,  affordable clothing, thrift store, eco-friendly fashion" />
  <meta name="description" content="Explore our wide range of men's clothing at Thriftify. Find great deals on quality, pre-loved men's fashion. Shop sustainably and stylishly." />
  <title>Thrift Shop - Men's Clothing</title>
  <link rel="stylesheet" href="MenWomen.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
      <!-- Brand centered -->
      <a href="index.html" class="navbar-brand">THRIFTIFY</a>
      <!-- Navbar toggler -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <!-- Left side of navbar -->
          <li class="nav-item">
            <a href="index.html" class="nav-link"><i class="bi bi-house" style="margin-right: 20px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                </svg></i>Home</a>
          </li>

          <!-- right side of navbar -->
          <li class="nav-item">
            <a href="sign_in.html" class="nav-link"><i class="bi bi-person" style="margin-right: 20px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg></i>Account</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="px-4 py-5 my-5 text-center">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="input-group rounded">
      <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" name="search" />
      <span class="input-group-text border-0" id="search-addon">
        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-search"></i></button>
      </span>
    </form>
  </div>
  <!-- Buttons Section -->

  <div class="container" style="display: flex; flex-wrap: wrap;">
    <?php foreach ($products as $product) : ?>
      <div class="col-md-4">
        <div class="card mb-4 box-shadow" style="margin-right: 10px;">
          <img class="card-img-top" src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
          <div class="card-body">
            <p class="card-text"><?php echo $product['name']; ?></p>
            <p class="card-text"><?php echo $product['description']; ?></p>
            <p class="card-text"><?php echo $product['price']; ?></p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <!-- Delete button with form -->
                <form method="POST" action="delete_product.php">
                  <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                  <button type="submit" class="btn btn-sm btn-outline-secondary" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Buttons with Dropdown Menus -->
  <div class="d-flex justify-content-between">
    <div class="dropdown" style="margin-top: 60px">
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="Women.php">Women</a></li>
        <li><a class="dropdown-item" href="Men.html">Men</a></li>
      </ul>
    </div>
  </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<!-- Footer -->
<footer class="bg-dark text-light py-3 text-center" style="margin-top: 150px">
  <div class="container">
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
</footer>

</html>