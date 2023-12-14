<!-- delete_product.php -->
<?php
require_once 'connection.php';

if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];

    // Perform the deletion
    $stmt = $pdo->prepare("DELETE FROM product WHERE reference = :reference");
    $stmt->bindParam(':reference', $reference);
    $stmt->execute();

    // Redirect back to the main page after deletion
    header("Location: main_page.php");
    exit();
} else {
    // Redirect to the main page if reference is not provided
    header("Location: main_page.php");
    exit();
}
?>
