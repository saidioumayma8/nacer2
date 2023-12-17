<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
      

        .container {
            margin-top: 100px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Sign In</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="signinUsername">email</label>
                        <input type="text" class="form-control" id="signinUsername" placeholder="Enter your email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="signinPassword">Password</label>
                        <input type="password" class="form-control" id="signinPassword" placeholder="Enter your password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign In</button>
                    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
                </form>
            </div>
        </div>
    </div>
    <?php
    session_start();
    include '../config/connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        try {
            $query = "SELECT * FROM usertable WHERE email = :email AND pass = :pass";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':pass', $password);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {

                header("Location: home.php");
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>