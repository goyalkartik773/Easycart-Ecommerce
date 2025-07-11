<?php
$conn = mysqli_connect("localhost:3307", "root", "", "ourwebsite");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $image = $_FILES['image'];

    // Handle image upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($image["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Validate image type
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowedTypes)) {
        echo "<script>alert('Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
        $uploadOk = 0;
    }

    // Attempt to upload file
    if ($uploadOk && move_uploaded_file($image["tmp_name"], $targetFile)) {
        // Insert product details into the database
        $sql = "INSERT INTO products (name, description, price, stock, productimage) 
                VALUES ('$name', '$description', '$price', '$stock', '$targetFile')";
        if ($conn->query($sql)) {
            echo "<script>alert('Product added successfully!'); window.location='display.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } else {
        if ($uploadOk) {
            echo "<script>alert('Error uploading image.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        /* Gradient background */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ff7eb3, #ff758c, #ff9770);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            color: #333;
        }

        /* Gradient animation */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Marquee heading */

        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        /* Form container */
        form {
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="file"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background: #f9f9f9;
        }

        form textarea {
            resize: vertical;
            min-height: 100px;
        }

        form button {
            display: inline-block;
            width: 100%;
            padding: 12px 20px;
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.3s;
        }

        form button:hover {
            transform: scale(1.05);
            background: linear-gradient(90deg, #2575fc, #6a11cb);
        }
    </style>
</head>
<body>
    <h1>Add Product</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" required></textarea>

        <label for="price">Price</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" required>

        <label for="image">Product Image</label>
        <input type="file" id="image" name="image" accept="image/*">

        <button type="submit">Add Product</button>
    </form>
</body>
</html>

