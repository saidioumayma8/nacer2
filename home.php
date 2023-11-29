<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<header class="headd">
        Electro Nacer
    </header>
<header>
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a href="#"class="list-group-item list-group-item-action py-2 ripple"aria-current="true">
          <span>Graphics cards</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
          <span>Arduino</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
          <span>Rasberry pi</span></a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
          <span>Users</span></a>
      </div>
    </div>
  </nav>
</header>

        <?php

        require_once 'connection.php'; 

        $stmt = $pdo->prepare("SELECT * FROM product");
        $stmt->execute();


        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="container-fluid mt-5">
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
                    <?php foreach ($products as $product): ?>
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
                        </tr>
                    <?php endforeach; ?>
    </table>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>   
</html>
