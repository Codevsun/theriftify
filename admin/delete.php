<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="keywords"
      content="thrift shop, men's clothing, sustainable fashion, pre-loved clothes, men's fashion,  affordable clothing, thrift store, eco-friendly fashion"
    />
    <meta
      name="description"
      content="Explore our wide range of men's clothing at Thriftify. Find great deals on quality, pre-loved men's fashion. Shop sustainably and stylishly."
    />
    <title>Thrift Shop - Men's Clothing</title>
    <link rel="stylesheet" href="MenWomen.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container-fluid">
        <!-- Brand centered -->
        <a href="index.html" class="navbar-brand">THRIFTIFY</a>
        <!-- Navbar toggler -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
            <!-- Left side of navbar -->
            <li class="nav-item">
              <a href="index.html" class="nav-link"
                ><i class="bi bi-house" style="margin-right: 20px"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-house"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"
                    /></svg></i
                >Home</a
              >
            </li>

            <!-- right side of navbar -->
            <li class="nav-item">
              <a href="sign_in.html" class="nav-link"
                ><i class="bi bi-person" style="margin-right: 20px"
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-person"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"
                    /></svg></i
                >Account</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="px-4 py-5 my-5 text-center">
    <div class="input-group rounded">
        <div class="px-4 py-5 my-5 text-center">
    <div class="input-group rounded">
        <div class="container">
    <div class="row">
        <!-- Start the loop to display products -->
		
		<div class="px-4 py-5 my-5 text-center">
    <div class="input-group rounded">
        <form method="POST" class="d-flex">
    <input
        type="search"
        class="form-control rounded"
        placeholder="Search product"
        aria-label="Search"
        aria-describedby="search-addon"
        id="search"
        name="search"
		/>

    <button type="submit" class="btn btn-primary">Search</button>

    <span class="input-group-text border-0" id="search-addon">
        <i class="fas fa-search"></i>
    </span>
</form>

    </div>

    <?php
    $user = "root";
    $password = "";
    $database = 'products';
    $servername = "localhost:4306";
    $mysql = mysqli_connect($servername, $user, $password, "products");

    if (!$mysql) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search = $_POST["search"];
        $sql = "SELECT * FROM prod WHERE ProductName LIKE '%$search%'";
        $result = mysqli_query($mysql, $sql);
        
        // Display search results
        $result = mysqli_query($mysql, $sql);
        }
   
    ?>
</div>
		
        <?php
        $user = "root";
        $password = "";
        $database = 'products';
        $servername = "localhost:4306";
        $mysql = mysqli_connect($servername, $user, $password, "products");

        if (!$mysql) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search = $_POST["search"];
            $sql = "SELECT * FROM prod WHERE ProductName LIKE '%$search%'";
        } else {
            $sql = "SELECT * FROM prod";
        }

        $result = mysqli_query($mysql, $sql); // Assign $result here
		
						/*   delete button   */
        // Display search results or all products
        while ($rows = mysqli_fetch_assoc($result)) {
            echo '<div class="col-md-4">';
            echo '<div class="card mb-4 box-shadow">';
echo '<img src="/dashboard/Hello/milstone-2/interfaces/' . $rows["prodImg"] . '" alt="image" >';
            echo '<div class="card-body">';
				echo '<p class="card-text">' . $rows['ProductName'] . '</p>';
            echo '<div class="d-flex justify-content-between align-items-center">';
            echo '<div class="btn-group">';
				echo '<form method="POST" action="delete_item.php" >';
				echo '<input type="hidden" name="prod_id" value="' . $rows['prod_id'] . '">';
				echo '<button type="submit" class="btn btn-danger">Delete</button>';
				echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        mysqli_close($mysql); // Close the database connection
        ?>
    </div> <!-- End row -->
</div> <!-- End container -->



         
        
    <!-- Buttons with Dropdown Menus -->
    <div class="d-flex justify-content-between">
      <div class="dropdown" style="margin-top: 60px">
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="Women.html">Women</a></li>
          <li><a class="dropdown-item" href="Men.html">Men</a></li>
        </ul>
      </div>
    </div>
  </body>

  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
  ></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"
  ></script>

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
