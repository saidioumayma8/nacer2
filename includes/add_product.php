<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Add Product</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Add Product</h2>
        <form action="process_add_product.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="reference">Reference:</label>
                <input type="text" class="form-control" id="reference" name="reference" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="codebar">Codebar:</label>
                <input type="text" class="form-control" id="codebar" name="codebar" required>
            </div>
            <div class="form-group">
                <label for="price_init">Price (Init):</label>
                <input type="number" class="form-control" id="price_init" name="price_init" required>
            </div>
            <div class="form-group">
                <label for="price_fin">Price (Final):</label>
                <input type="number" class="form-control" id="price_fin" name="price_fin" required>
            </div>
            <div class="form-group">
                <label for="quantite_min">Quantity (Min):</label>
                <input type="number" class="form-control" id="quantite_min" name="quantite_min" required>
            </div>
            <div class="form-group">
                <label for="quantite_stock">Quantity (Stock):</label>
                <input type="number" class="form-control" id="quantite_stock" name="quantite_stock" required>
            </div>
            <div class="form-group">
                <label for="reduc">Reduction (%):</label>
                <input type="number" class="form-control" id="reduc" name="reduc" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
