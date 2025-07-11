<?php
$conn = mysqli_connect("localhost:3307", "root", "", "ourwebsite");

// Check if the product ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete product from the database
    $sql = "DELETE FROM products WHERE id = $id";
    if ($conn->query($sql)) {
        echo "<script>alert('Product deleted successfully!'); window.location='display.php';</script>";
    } else {
        echo "<script>alert('Error deleting product: " . $conn->error . "'); window.location='display.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location='display.php';</script>";
}
?>
