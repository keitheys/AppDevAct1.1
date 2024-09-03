<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Products</title>
</head>
<body>
    <?php
    $sql = 'SELECT * FROM products';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<h2>Product List</h2>';
        echo '<table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row['ID'] . '</td>
                    <td>' . $row['Name'] . '</td>
                    <td>' . $row['Description'] . '</td>
                    <td>' . $row['Price'] . '</td>
                    <td>' . $row['Quantity'] . '</td>
                    <td>' . $row['ToCreate'] . '</td>
                    <td>' . $row['ToUpdate'] . '</td>
                    <td>
                        <a href="Createupdate.php?id=' . $row['ID'] . '">Update</a>
                        <a href="Createdelete.php?id=' . $row['ID'] . '">Delete</a>
                    </td>
                </tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<div>No products found.</div>';
    }
    ?>
    <a href="Createcrud.php">Add New Product</a>
</body>
</html>
