<?php
require_once '../config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reference = $_POST['reference'];
    $name_prod = $_POST['name_prod'];
    $photoTmp = $_FILES['img_prod']['tmp_name'];
    $photoData = file_get_contents($photoTmp);
    $codebar = $_POST['codebar'];
    $price_init = $_POST['price_init'];
    $price_fin = $_POST['price_fin'];
    $quantite_min = $_POST['quantite_min'];
    $quantite_stock = $_POST['quantite_stock'];
    $reduc = $_POST['reduc'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("UPDATE product SET 
        name_prod = :name_prod,  
        image_prod = :img_prod,
        codebar = :codebar, 
        price_init = :price_init, 
        price_fin = :price_fin, 
        quantite_min = :quantite_min, 
        quantite_stock = :quantite_stock, 
        reduc = :reduc, 
        description = :description 
        WHERE reference = :reference");

    $stmt->bindParam(':name_prod', $name_prod);
    $stmt->bindParam(':img_prod', $photoData, PDO::PARAM_LOB);
    $stmt->bindParam(':codebar', $codebar);
    $stmt->bindParam(':price_init', $price_init);
    $stmt->bindParam(':price_fin', $price_fin);
    $stmt->bindParam(':quantite_min', $quantite_min);
    $stmt->bindParam(':quantite_stock', $quantite_stock);
    $stmt->bindParam(':reduc', $reduc);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':reference', $reference);

    $stmt->execute();
}

if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];
    $stmt = $pdo->prepare("SELECT * FROM product WHERE reference = :reference");
    $stmt->bindParam(':reference', $reference);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    header("Location: ../pages/home.php");
} else {
    
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Edit Product</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Product</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="reference" value="<?php echo $product['reference']; ?>">

            <div class="form-group">
                <label for="name_prod">Product Name:</label>
                <input type="text" class="form-control" name="name_prod" value="<?php echo $product['name_prod']; ?>">
            </div>
            <div>
                <label>Image produit:</label>
                                <input type="file" id="image_prod" name="img_prod"><br>
            </div>
            <div class="form-group">
                <label for="codebar">Codebar:</label>
                <input type="text" class="form-control" name="codebar" value="<?php echo $product['codebar']; ?>">
            </div>

            <div class="form-group">
                <label for="price_init">Price (Init):</label>
                <input type="text" class="form-control" name="price_init" value="<?php echo $product['price_init']; ?>">
            </div>

            <div class="form-group">
                <label for="price_fin">Price (Final):</label>
                <input type="text" class="form-control" name="price_fin" value="<?php echo $product['price_fin']; ?>">
            </div>

            <div class="form-group">
                <label for="quantite_min">Quantity (Min):</label>
                <input type="text" class="form-control" name="quantite_min" value="<?php echo $product['quantite_min']; ?>">
            </div>

            <div class="form-group">
                <label for="quantite_stock">Quantity (Stock):</label>
                <input type="text" class="form-control" name="quantite_stock" value="<?php echo $product['quantite_stock']; ?>">
            </div>

            <div class="form-group">
                <label for="reduc">Reduction (%):</label>
                <input type="text" class="form-control" name="reduc" value="<?php echo $product['reduc']; ?>">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description"><?php echo $product['description']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
