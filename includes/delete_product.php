<?php
require_once '../config/connection.php';

if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];

    $stmt = $pdo->prepare("DELETE FROM product WHERE reference = :reference");
    $stmt->bindParam(':reference', $reference);
    $stmt->execute();

    header("Location: ../pages/home.php");
    exit();
} else {
    header("Location: ../pages/home.php");
    exit();
}
?>
