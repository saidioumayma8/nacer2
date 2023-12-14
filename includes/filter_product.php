<?php
// Include your database connection file (connection.php)
require_once 'connection.php';

// Check if the 'category' parameter is set in the GET request
if (isset($_GET['category'])) {
    $categoryFilter = $_GET['category'];

    // Prepare and execute a SQL query to fetch products based on the selected category
    $stmt = $pdo->prepare("SELECT * FROM product WHERE fk_idcat = :category");
    $stmt->bindParam(':category', $categoryFilter);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the HTML for the product rows
    foreach ($products as $product) {
        echo '<tr>';
        echo '<td>' . $product['reference'] . '</td>';
        echo '<td>' . $product['name_prod'] . '</td>';
        echo '<td><img src="data:image/jpg;base64,' . base64_encode($product['image_prod']) . '" alt="' . $product['name_prod'] . '" width="100"></td>';
        echo '<td>' . $product['codebar'] . '</td>';
        echo '<td>' . $product['price_init'] . '</td>';
        echo '<td>' . $product['price_fin'] . '</td>';
        echo '<td>' . $product['quantite_min'] . '</td>';
        echo '<td>' . $product['quantite_stock'] . '</td>';
        echo '<td>' . $product['reduc'] . '</td>';
        echo '<td>' . $product['description'] . '</td>';
        echo '<td>
                <a href="edit_product.php?reference=' . $product['reference'] . '" class="btn btn-sm btn-primary">Edit</a>
                <a href="delete_product.php?reference=' . $product['reference'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this product?\')">Delete</a>
              </td>';
        echo '</tr>';
    }
} else {
    // Handle the case when no category is specified (optional)
    echo 'Invalid category';
}
?>