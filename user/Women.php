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
            <a href="#" class="nav-link" id="contactLink" onclick="showContactPopup()"><i class="bi bi-bag" style="margin-right: 20px"><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 2C0.447715 2 0 2.44772 0 3V12C0 12.5523 0.447715 13 1 13H14C14.5523 13 15 12.5523 15 12V3C15 2.44772 14.5523 2 14 2H1ZM1 3L14 3V3.92494C13.9174 3.92486 13.8338 3.94751 13.7589 3.99505L7.5 7.96703L1.24112 3.99505C1.16621 3.94751 1.0826 3.92486 1 3.92494V3ZM1 4.90797V12H14V4.90797L7.74112 8.87995C7.59394 8.97335 7.40606 8.97335 7.25888 8.87995L1 4.90797Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                </svg></i>contact us
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="modal-overlay">

    <div class="modal-content">

      <span class="close">&times;</span>
      <!-- Your contact form goes here -->

      <div class="contact-container">
        <!-- form -->
        <div class="form-container">

          <h3>Contact Us</h3>
          <form action="https://formsubmit.co/Theriftify@gmail.com" method="POST" class="contact-form">
            <input type="text" name="name" id="name" placeholder="Enter your Name.." />
            <input type="email" name="email" id="email" placeholder="Enter your Email.." />
            <textarea name="message" id="message" cols="30" rows="10" placeholder="Write your Message Here.."></textarea>
            <button type="submit" value="Send" class="send-button">Send</button>
          </form>

        </div>
        <!-- map -->
        <div class="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3574.180323779947!2d50.18744047422594!3d26.385361276965362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e49efcf3bf6ab17%3A0xeef45f58f7dd7827!2sIAU%20Building%20650!5e0!3m2!1sen!2ssa!4v1710355976125!5m2!1sen!2ssa" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>
  </div>

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



  // Close the database connection (optional, as PHP will automatically close it when the script ends)
  mysqli_close($connection);
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

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        // Get the modal element
        var modal = document.querySelector(".modal-overlay");

        // Get the <span> element that closes the modal
        var span = modal.querySelector(".close");

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        };
      });

      // Get the "Contact Us" link
      var contactLink = document.getElementById("contactLink");

      // When the user clicks on "Contact Us" link, open the modal
      document.addEventListener("click", function(event) {
        var modal = document.querySelector(".modal-overlay");
        if (event.target === modal) {
          modal.style.display = "none";
        }
      });
      // Form validation
      var form = document.querySelector(".contact-form");
      form.addEventListener("submit", function(event) {
        var name = document.getElementById("name").value.trim();
        var email = document.getElementById("email").value.trim();
        var message = document.getElementById("message").value.trim();

        if (name === "" || email === "" || message === "") {
          alert("Please fill in all fields.");
          event.preventDefault();
        }
      });
    </script>
</body>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var modal = document.querySelector(".modal-overlay");
    var span = modal.querySelector(".close");
    var contactLink = document.getElementById("contactLink");

    contactLink.addEventListener("click", function(event) {
      event.preventDefault();
      modal.style.display = "flex";
    });

    span.onclick = function() {
      modal.style.display = "none";
    };

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };

    // Form validation
    var form = document.getElementById("contactForm");
    form.addEventListener("submit", function(event) {
      var name = document.getElementById("name").value.trim();
      var email = document.getElementById("email").value.trim();
      var message = document.getElementById("message").value.trim();

      if (name === "" || email === "" || message === "") {
        alert("Please fill in all fields.");
        event.preventDefault();
      }
    });
  });
</script>
<footer class="bg-dark text-light py-3 text-center" style="margin-top: -159">

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

</html>