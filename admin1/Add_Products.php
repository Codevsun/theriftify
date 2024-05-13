<?php
$database = mysqli_connect("localhost:3309", "root", "", "theriftify");

if (!$database) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requiredFields = ['ProductName', 'ProductDescreption', 'ProductSize', 'ProductPrice', 'ProductQty', 'ProductCategory'];
    $missingFields = [];

    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            $missingFields[] = $field;
        }
    }

    if (!empty($missingFields)) {
        echo "Required field(s) missing: " . implode(', ', $missingFields);
    } else {

        $productName = $_POST['ProductName'];
        $productDesc = $_POST['ProductDescreption'];
        $productSize = $_POST['ProductSize'];
        $productPrice = $_POST['ProductPrice'];
        $productQty = $_POST['ProductQty'];
        $productCategory = $_POST['ProductCategory'];

        // image upload
        if (isset($_FILES['ProductImage']) && $_FILES['ProductImage']['error'] === UPLOAD_ERR_OK) {
            $productImage = $_FILES['ProductImage']['name'];
            $tempFilePath = $_FILES['ProductImage']['tmp_name'];


            $uploadPath = "../admin1/imgUploads/" . basename($productImage);
            if (move_uploaded_file($tempFilePath, $uploadPath)) {

                $sql = "INSERT INTO products (Product_Name, Product_Description, Product_Size, Product_Price, Product_Quantity, Product_Category, Product_Img_URL)
                        VALUES ('$productName', '$productDesc', '$productSize', $productPrice, $productQty, '$productCategory', '$uploadPath')";

                if (mysqli_query($database, $sql)) {
                    echo "Product information has been added to the database successfully.<br><br>";
                    echo "Product Name: $productName<br>";
                    echo "Product Description: $productDesc<br>";
                    echo "Product Size: $productSize<br>";
                    echo "Product Price: $productPrice<br>";
                    echo "Product Quantity: $productQty<br>";
                    echo "Product Category: $productCategory<br>";
                    echo "Product Image: $uploadPath<br>";
                    header("location: index.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($database);
                }
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Error uploading file: " . $_FILES['ProductImage']['error'];
        }
    }
}

mysqli_close($database);
