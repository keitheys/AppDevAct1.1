<?php
include 'config.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id) {
    $sql = 'DELETE FROM products WHERE ID = ?';
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo "<div>Product deleted successfully.</div>";
        } else {
            echo "<div>Failed to delete product or product not found.</div>";
        }

        $stmt->close();
    } else {
        echo "<div>Prepare failed: " . $conn->error . "</div>";
    }
} else {
    echo "<div>Invalid ID.</div>";
}
?>
<a href="Createretrive.php">Back to List</a>
<a href="Createcrud.php">Add New Product</a>
