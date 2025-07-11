<?php
$conn = mysqli_connect("localhost:3307", "root", "", "ourwebsite");

// Check if the product ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch product details
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "<script>alert('Product not found!'); window.location='display.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid request!'); window.location='display.php';</script>";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Update product in the database
    $sql = "UPDATE products SET name='$name', description='$description', price='$price', stock='$stock' WHERE id=$id";
    if ($conn->query($sql)) {
        echo "<script>alert('Product updated successfully!'); window.location='display.php';</script>";
    } else {
        echo "<script>alert('Error updating product: " . $conn->error . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #007BFF;
            margin-top: 20px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        form input[type="text"],
        form input[type="number"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
            background-color: #f9f9f9;
        }

        form textarea {
            resize: vertical;
            min-height: 100px;
        }

        form button {
            display: inline-block;
            width: 100%;
            padding: 12px 20px;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            form {
                padding: 15px;
            }

            form button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST" action="">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required>
        <label for="description">Description</label>
        <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea>
        <label for="price">Price</label>
        <input type="number" id="price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" value="<?php echo $product['stock']; ?>" required>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
