<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title> ElectroNacer</title>
</head>
<body>

<header>
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <a href="#" class="list-group-item list-group-item-action py-2 ripple" data-category="Graphics cards">
                    <span>Graphics cards</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-2 ripple" data-category="Arduino">
                    <span>Arduino</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-2 ripple" data-category="Raspberry pi">
                    <span>Raspberry pi</span>
                </a>
                <a href="users.php" class="list-group-item list-group-item-action py-2 ripple" data-category="Users">
                    <span>Users</span>
                </a>
            </div>
        </div>
    </nav>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
      <a class="h2 text-center mt-5 mb-4 mr-3" href="#">ElectroNaser</a>
   
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Log out</a>
          </li>
        </ul>
      </div>
  </div>
</nav>
 

<?php
require_once '../config/connection.php'; 

$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$recordsPerPage = 3;
$totalRecords = count($products);
$totalPages = ceil($totalRecords / $recordsPerPage);

if (!isset($_GET['page']) || !is_numeric($_GET['page']) || $_GET['page'] < 1 || $_GET['page'] > $totalPages) {
    $currentPage = 1;
} else {
    $currentPage = $_GET['page'];
}

$offset = ($currentPage - 1) * $recordsPerPage;
$paginationProducts = array_slice($products, $offset, $recordsPerPage);

?>
<div class="container-fluid mt-5">
<h2 class="list">List de produit</h2>
    <table class="table table-bordered custom-table">
        <thead>
            <tr>
                <th>Reference</th>
                <th>Name</th>
                <th>Image</th>
                <th>Codebar</th>
                <th>Price (Init)</th>
                <th>Price (Final)</th>
                <th>Quantity (Min)</th>
                <th>Quantity (Stock)</th>
                <th>Reduction (%)</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($paginationProducts as $product): ?>
                <tr>
                    <td><?php echo $product['reference']; ?></td>
                    <td><?php echo $product['name_prod']; ?></td>
                    <td><img src="data:image/jpg;base64,<?php echo base64_encode($product['image_prod']); ?>" alt="<?php echo $product['name_prod']; ?>" width="100"></td>
                    <td><?php echo $product['codebar']; ?></td>
                    <td><?php echo $product['price_init']; ?></td>
                    <td><?php echo $product['price_fin']; ?></td>
                    <td><?php echo $product['quantite_min']; ?></td>
                    <td><?php echo $product['quantite_stock']; ?></td>
                    <td><?php echo $product['reduc']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td>
                       <a href="../includes/edit_product.php?reference=<?php echo $product['reference']; ?>" class="btn btn-sm btn-primary">Edit</a>
                       <a href="../includes/delete_product.php?reference=<?php echo $product['reference']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="container mt-3">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
</div>
<a href="../includes/add_product.php" class="btn btn-primary button">Add Product</a>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 <script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all category links
    var categoryLinks = document.querySelectorAll('#sidebarMenu a');

    // Add click event listeners to each category link
    categoryLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            // Remove 'active' class from all links
            categoryLinks.forEach(function(innerLink) {
                innerLink.classList.remove('active');
            });

            // Add 'active' class to the clicked link
            link.classList.add('active');

            // Get the category data attribute value
            var category = link.getAttribute('data-category');

            // Reload the page with the category filter in the URL
            window.location.href = '?category=' + category;
        });
    });
});
</script> 
</body>
</html>
