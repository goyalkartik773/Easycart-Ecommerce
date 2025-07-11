<?php
$conn = mysqli_connect("localhost:3307", "root", "", "ourwebsite");

// Fetch all products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            color: #007BFF;
            margin: 20px 0;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007BFF;
            color: white;
        }

        img {
            width: 80px;
            height: auto;
            border-radius: 5px;
        }

        .btn {
            padding: 8px 15px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 5px;
        }

        .btn:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Product Management</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['stock']; ?></td>
                        <td>
                            <?php if (!empty($row['productimage'])): ?>
                                <img src="<?php echo $row['productimage']; ?>" alt="Product Image">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="btn" href="editproduct.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a class="btn btn-delete" href="deleteproduct.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">No products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
