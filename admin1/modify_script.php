<?php

// Create connection
$conn =  mysqli_connect("localhost:3309", "root", "", "theriftify");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $productId = $_POST["product_id"];
    $productname = $_POST["productname"];
    $price = $_POST["price"];
    $productdesc = $_POST["productdesc"];
    $quantity = $_POST["quantity"];
    $size = $_POST["size"];

    // Handle image upload
    if ($_FILES['productimage']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images/'; // Directory to upload images
        $uploadFile = $uploadDir . basename($_FILES['productimage']['name']);

        if (move_uploaded_file($_FILES['productimage']['tmp_name'], $uploadFile)) {
            // Image uploaded successfully, update the database
            $imgUrl = $uploadFile; // Use the URL of the uploaded image
            $sql = "UPDATE products SET Product_Name=?, Product_Description=?, Product_Price=?, Product_Quantity=?, Product_Size=?, Product_Img_URL=? WHERE Product_ID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdsssi", $productname, $productdesc, $price, $quantity, $size, $imgUrl, $productId);
        } else {
            // Image upload failed
            header("Location: error.html");
            exit();
        }
    } else {
        // No image uploaded
        $sql = "UPDATE products SET Product_Name=?, Product_Description=?, Product_Price=?, Product_Quantity=?, Product_Size=? WHERE Product_ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssi", $productname, $productdesc, $price, $quantity, $size, $productId);
    }

    if ($stmt->execute()) {
        // Redirect to success page
        header("Location: success.html");
        exit();
    } else {
        // Redirect to error page
        header("Location: error.html");
        exit();
    }

}


