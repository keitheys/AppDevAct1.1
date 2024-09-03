<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <?php
    if (isset($_POST['submit'])) {
        // Retrieve form values
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $createdat = $_POST['createdat'];
        $updatedat = $_POST['updatedat'];

        // Prepare SQL statement
        $sql = 'INSERT INTO products (Name, Description, Price, Quantity, ToCreate, ToUpdate) VALUES (?, ?, ?, ?, ?, ?)';

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ssdiis", $name, $description, $price, $quantity, $createdat, $updatedat);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<div>Product saved successfully.</div>";
            } else {
                echo "<div>Oops, something went wrong!</div>";
            }

            $stmt->close();
        } else {
            echo "<div>Prepare failed: " . $conn->error . "</div>";
        }
    }
    ?>
    <h2>Create Product</h2>
    <form action="Createcrud.php" method="POST">
        <div>
            <label>Name</label>
            <input type="text" placeholder="Enter Product Name" name="name" required>
        </div><br>
        <div>
            <label>Description</label>
            <input type="text" placeholder="Enter Product Description" name="description" required>
        </div><br>
        <div>
            <label>Price</label>
            <input type="text" placeholder="Enter Product Price" name="price" required>
        </div><br>
        <div>
            <label>Quantity</label>
            <input type="text" placeholder="Enter Product Quantity" name="quantity" required>
        </div><br>
        <div>
            <label>Created At</label>
            <input type="datetime-local" name="createdat" required>
        </div><br>
        <div>
            <label>Updated At</label>
            <input type="datetime-local" name="updatedat" required>
        </div><br>
        <button type="submit" name="submit">Save</button>
        <a href="Createretrive.php">Retrieve Data</a>
    </form>
</body>
</html>
