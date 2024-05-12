<?php
// delete_item.php
$user = "root";
$password = "";
$database = 'products';
$servername = "localhost:4306";
$mysql = mysqli_connect($servername, $user, $password, "products");

if (!$mysql) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['prod_id'])) {
    $prodId = $_POST['prod_id'];
    $sql = "DELETE FROM prod WHERE prod_id = '$prodId'";
    if (mysqli_query($mysql, $sql)) {
        header("Location: http://localhost/dashboard/Hello/milstone-2/interfaces/admin/delete.html");
		exit;
        //redirect after deletion
    } else {
        echo "Error deleting item: " . mysqli_error($mysql);
    }
} else {
    echo "Invalid request";
}

mysqli_close($mysql);
?>
