<?php


$conn = mysqli_connect("localhost:3309", "root", "", "theriftify");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product details based on ID
if (isset($_GET['id'])) {
    $productId = $_GET['id'];
    $sql = "SELECT * FROM products WHERE Product_ID = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Product not found";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <style>
        body {
            background-color: #f5f5f5;
            font-family: "Nunito", sans-serif;
        }

        .card {
            background-color: #ffffff;
            font-family: "Nunito", sans-serif;
            margin-bottom: 20px;
            padding: 30px;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <!-- Brand centered -->
            <a href="index.php" class="navbar-brand">THRIFTIFY</a>
            <!-- Navbar toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <!-- Left side of navbar -->
                    <li class="nav-item">
                        <a href="index.php" class="nav-link"><i class="bi bi-house" style="margin-right: 20px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                                </svg></i>Home</a>
                    </li>

                    <!-- right side of navbar -->
                    <li class="nav-item">
                        <a href="AdminAuthentication.php" class="nav-link"><i class="bi bi-person" style="margin-right: 20px"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                </svg></i>Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <!-- Buttons Section -->
    <!-- Buttons with Dropdown Menus -->
    <div class="d-flex justify-content-between">
        <div class="dropdown" style="margin-top: 60px">
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">All products</a></li>
                <li><a class="dropdown-item" href="#">Women</a></li>
                <li><a class="dropdown-item" href="#">Men</a></li>
            </ul>
        </div>
        <div class="dropdown" style="margin-top: 60px"></div>
    </div>



    <div class="container">
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">General Information</h4>
                <p class="card-title-desc">Please fill all fields</p>
                <hr />
                <!-- General Information Content Here -->
                <form action="modify_script.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <div class="form-group mb-3">
                        <label for="productimage" class="mb-2">Product Image</label>
                        <input type="file" class="form-control" id="productimage" name="productimage" accept=".png, .jpg, .jpeg">
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="productname" class="mb-2">Product Name</label>
                                <input id="productname" name="productname" type="text" class="form-control" value="<?php echo isset($row['Product_Name']) ? $row['Product_Name'] : ''; ?>" />
                            </div>
                        </div>
                        <div class="product_info">
                            <label for="Size" class="fomb-2">Size</label>
                            <select class="form-select" id="Size" name="size" required="">
                                <option value="">Choose...</option>
                                <?php
                                $sizes = array("XS", "S", "M", "L", "XL", "XXL");
                                foreach ($sizes as $size) {
                                    echo '<option' . (isset($row['Product_Size']) && $row['Product_Size'] == $size ? ' selected' : '') . '>' . $size . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="product_info">
                            <label for="Quantity" class="mb-2">Quantity</label>
                            <input type="number" class="form-control" id="Quantity" name="quantity" placeholder="" value="<?php echo isset($row['Product_Quantity']) ? $row['Product_Quantity'] : ''; ?>" required="" />
                        </div>

                        <!-- Add other fields here -->
                        <div class="form-group mb-3">
                            <label for="price" class="mb-2">Price</label>
                            <input id="price" name="price" type="text" class="form-control" value="<?php echo isset($row['Product_Price']) ? $row['Product_Price'] : ''; ?>" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="productdesc" class="mb-2">Product Description</label>
                            <textarea class="form-control" id="productdesc" name="productdesc" rows="5"><?php echo isset($row['Product_Description']) ? $row['Product_Description'] : ''; ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-auto">
                                <button type="submit" class="btn btn-dark me-1">Save Changes</button>
                                <a href="index.php" class="btn btn-light">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            form.addEventListener("submit", function(event) {
                const productName = document.getElementById("productname").value;
                const price = document.getElementById("price").value;

                if (!/[a-zA-Z]/.test(productName.trim())) {
                    alert("Product name should contain at lest one alphabet.");
                    event.preventDefault();
                    return;
                }
                if (isNaN(parseFloat(price)) || price <= 0) {
                    alert("Please enter a valid price.");
                    event.preventDefault();
                    return;
                }
            });
        });
    </script>

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
                    registered in Saudi Arabia. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap & Core JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-7V5F4xXgFFfYDPzkgjgT9zRlsfFAYCYS8n8JLvGJ5B+JvOlmP7rjXhwLI1Bd4g1o" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-SRv04Lq8X1vEzx/5Eo2QHLjgd6+rpICbV8Nci+vyH/qc29PcA3/JmCCff9RuGOqD" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-yEeLwU8sW/5l+dp0fVoSwPcFkUNQszY5VgiFe4mHbUJefGlgd0gkExO1tBO+Cug9" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>
</body>

</html>