<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reference = $_POST['reference'];
    $name = $_POST['name'];
    $image = $_FILES['image']['tmp_name'];
    $codebar = $_POST['codebar'];
    $price_init = $_POST['price_init'];
    $price_fin = $_POST['price_fin'];
    $quantite_min = $_POST['quantite_min'];
    $quantite_stock = $_POST['quantite_stock'];
    $reduc = $_POST['reduc'];
    $description = $_POST['description'];
    $category = $_POST['category']; 

    $stmt = $pdo->prepare("INSERT INTO product (reference, name_prod, image_prod, codebar, price_init, price_fin, quantite_min, quantite_stock, reduc, description, fk_idcat) 
                           VALUES (?, ?, LOAD_FILE(?), ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$reference, $name, $image, $codebar, $price_init, $price_fin, $quantite_min, $quantite_stock, $reduc, $description, $category]);


    header('Location: home.php');
    exit();
}
?>
