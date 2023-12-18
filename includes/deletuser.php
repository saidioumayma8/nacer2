<?php
require_once '../config/connection.php';

if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];

    $stmt = $pdo->prepare("DELETE FROM usertable WHERE reference = :reference");
    $stmt->bindParam(':reference', $reference);
    $stmt->execute();

    header("Location: ../pages/users.php");
    exit();
} else {
    header("Location: ../pages/users.php");
    exit();
}
?>