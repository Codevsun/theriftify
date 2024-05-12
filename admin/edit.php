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
    <style>
        /* Custom CSS for fixing layout issues */
        body {
            padding-top: 70px;
            /* Adjusted padding for navbar */
            margin-bottom: 100px;
            /* Added margin for footer */
        }

        .card {
            height: 100%;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        /* Custom CSS for search bar */
        .search-bar {
            margin-bottom: 20px;
        }

        /* Custom CSS for smaller images */
        .card-img-top {
            max-height: 200px;
            /* Adjust as needed */
        }

        /* Custom CSS for smaller containers */
        .col-md-4 {
            max-width: 250px;
            /* Adjust as needed */
        }
    </style>
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
    <div class="container-fluid">
        <!-- Search bar -->
        <div class="row search-bar">
            <div class="col-md-12">
                <input class="form-control me-2" type="search" placeholder="Search by product name" aria-label="Search" id="searchInput">
            </div>
        </div>

        <div class="row">
            <?php
            require('db_con.php');

            // Check connection
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            // Default SQL query
            $sql = "SELECT * FROM products";

            // Check if search query is present
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search = $connection->real_escape_string($_GET['search']);
                // Modify the SQL query to filter by product name
                $sql = "SELECT * FROM products WHERE Product_Name LIKE '%$search%'";
            }

            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <!-- Update the src attribute with the correct image URL -->
                            <img class="card-img-top" src="<?php echo $row['Product_Img_URL']; ?>" alt="<?php echo $row['Product_Name']; ?>">
                            <div class="card-body">
                                <p class="card-text"><?php echo $row['Product_Name']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="modify.php?id=<?php echo $row['Product_ID']; ?>"><button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "0 results";
            }
            $connection->close();
            ?>

        </div>
    </div>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
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

    <!-- Your JavaScript imports -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        // JavaScript for search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            var searchValue = this.value.toLowerCase().trim();
            var cards = document.querySelectorAll('.card');
            cards.forEach(function(card) {
                var textContent = card.textContent.toLowerCase();
                if (textContent.includes(searchValue)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>