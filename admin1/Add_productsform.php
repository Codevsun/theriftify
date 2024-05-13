<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Add_Products.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Add Products</title>

    </head>


    <body>
        <!-- Navbar -->
    
        <?php include "./partials/header.html" ?>
    <!-- Main Content -->
    <!-- Buttons Section -->
    <!-- Buttons with Dropdown Menus -->
    <div class="d-flex justify-content-between">
        <div class="dropdown" style="margin-top: 60px;">
        </div>     
    </div>

        <div class="tittle_conatiner">
            <h3>Add New Product</h3>
            <hr class="horz-line">  
        </div>

       
         <!-- Form -->
         <div class="info-container">
          <form id="productForm" method="post" action="Add_Products.php" enctype="multipart/form-data">
            <div class="product_info">

              <!-- Prooduct Name -->
              <label for="ProductName" class="form-label">Product Name</label>
              <input type="text" name="ProductName" class="form-control" id="ProductName" placeholder="Enter product name">
            </div>

            <!-- Product Desc -->
            <div class="product_info">
              <label for="ProductDescreption" class="form-label">Product Description</label>
              <textarea class="form-control" name="ProductDescreption" id="ProductDescreption" placeholder="Enter product description"></textarea>
            </div>

            <!-- Product Size -->
            <div class="product_info">
              <label for="ProductSize" class="form-label">Size</label>
              <select class="form-select" name="ProductSize" id="ProductSize" >
                <option value="">Choose size...</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
              </select>
            </div>

            <!-- Product Price -->
            <div class="product_info">
              <label for="ProductPrice" class="form-label">Price</label>
              <input type="number" name="ProductPrice" class="form-control" id="ProductPrice" placeholder="Enter product price"  min="1">
            </div>

             <!-- Product Quantity -->
            <div class="product_info">
              <label for="ProductQty" class="form-label">Quantity</label>
              <input type="number" name="ProductQty" class="form-control" id="ProductQty" placeholder="Enter product quantity"  min="1">
            </div>

             <!-- Product Category -->
            <div class="product_info">
              <label for="ProductCategory" class="form-label">Product Category</label>
              <select class="form-select" name="ProductCategory" id="ProductCategory">
                <option value="">Choose category...</option>
                <option value="Men">Men</option>
                <option value="Women">Women</option>
              </select>
            </div>
        
            <!-- Product Image -->
            <div class="product-image">
              <div class="upload-container">
                <input type="file" name="ProductImage" id="image-upload" accept=".png, .jpg, .jpeg" >
                <div class="image-icon">
                  <i class="bx bx-cloud-upload icon"></i>
                </div>
                <p class="upload-text">Upload Image</p>
                <label for="image-upload" class="upload-button">Select Image</label>
        
                <div class="image-container">
                  <img id="image-preview" style="max-width: 100%; max-height: 100%;" alt="" src="">
                </div>
              </div>
            </div>
        
            <!-- Error message for validation -->
            <div id="error-message" class="error-message"></div>
            
            <div>
              <button class="Add_product_button" type="submit">Add Product</button>
              
            </div>
          </form>
        </div>
        


                
                <!-- Footer -->
        <footer class="bg-dark text-light py-3 text-center ">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <a class="nav-link text-light" href="#">Contact Us</a>
                    </div>
                    <div class="col">
                        <a class="nav-link text-light" href="#">FAQs</a>
                    </div>
                    <div class="col">
                        <a class="nav-link text-light" href="#">Country/Region: Saudi Arabia</a>
                    </div>
                </div>
                <div class="row mt-2"> <!-- Added margin top to create space -->
                    <div class="col">
                        <p>THRIFTIFY and the THRIFTIFY logo are trademarks of Thriftify and are registered or pending
                            registration in
                            numerous jurisdictions around the world. &copy; Copyright 2024 Thriftify. All rights
                            reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
            </div>
             
            <script src="Add_Products.js"></script>
            <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>
    </body>
</html>