<?php
// Database connection
$conn = mysqli_connect("localhost:3307", "root", "", "ourwebsite");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to create the `products` table
$query = "
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";

// Execute the query
if (mysqli_query($conn, $query)) {
    echo "<script>alert('Table created successfully');</script>";
} else {
    echo "<script>alert('Error creating table: " . mysqli_error($conn) . "');</script>";
}

// Close the connection
mysqli_close($conn);
?>
