<?php
include 'config.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id) {
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $createdat = $_POST['createdat'];
        $updatedat = $_POST['updatedat'];

        $sql = 'UPDATE products SET Name = ?, Description = ?, Price = ?, Quantity = ?, ToCreate = ?, ToUpdate = ? WHERE ID = ?';
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssdiisi", $name, $description, $price, $quantity, $createdat, $updatedat, $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "<div>Product updated successfully.</div>";
            } else {
                echo "<div>No changes made.</div>";
            }

            $stmt->close();
        } else {
            echo "<div>Prepare failed: " . $conn->error . "</div>";
        }
    }

    $sql = 'SELECT * FROM products WHERE ID = ?';
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $product = $stmt->get_result()->fetch_assoc();

        if (!$product) {
            echo "<div>Product not found.</div>";
            exit;
        }
    } else {
        echo "<div>Prepare failed: " . $conn->error . "</div>";
        exit;
    }
} else {
    echo "<div>Invalid ID.</div>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>
    <h2>Update Product</h2>
    <form action="Createupdate.php?id=<?php echo $id; ?>" method="POST">
        <div>
            <label>Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($product['Name']); ?>" required>
        </div><br>
        <div>
            <label>Description</label>
            <input type="text" name="description" value="<?php echo htmlspecialchars($product['Description']); ?>" required>
        </div><br>
        <div>
            <label>Price</label>
            <input type="text" name="price" value="<?php echo htmlspecialchars($product['Price']); ?>" required>
        </div><br>
        <div>
            <label>Quantity</label>
            <input type="text" name="quantity" value="<?php echo htmlspecialchars($product['Quantity']); ?>" required>
        </div><br>
        <div>
            <label>Created At</label>
            <input type="datetime-local" name="createdat" value="<?php echo htmlspecialchars($product['ToCreate']); ?>" readonly>
        </div><br>
        <div>
            <label>Updated At</label>
            <input type="datetime-local" name="updatedat" value="<?php echo htmlspecialchars($product['ToUpdate']); ?>">
        </div><br>
        <button type="submit" name="submit">Update</button>
        <a href="Createretrive.php">Back to List</a>
    </form>
</body>
</html>
