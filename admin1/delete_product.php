<?php
// Check if the product ID is set and not empty
if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
    // Connect to the database
    $connection = mysqli_connect("localhost:3309", "root", "", "theriftify");

    // Get the product ID from the form submission
    $productId = $_POST['product_id'];

    // Query to delete the product from the database
    $query = "DELETE FROM products WHERE Product_ID = '$productId'";
    
    // Execute the query
    if (mysqli_query($connection, $query)) {
        // Product deleted successfully
        echo "Product deleted successfully.";
        header("Location: delete.php");
        exit();
    } else {
        // Error occurred while deleting the product
        echo "Error deleting product: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    // Product ID not provided or empty
    echo "Product ID not provided or empty.";
}
?>
