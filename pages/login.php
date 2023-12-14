<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["login"];
    $password = $_POST["pass"];

    try {
        $query = "SELECT * FROM usertable WHERE login = :login AND pass = :pass";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':login', $username);
        $stmt->bindParam(':pass', $password);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            header("Location: home.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom styles -->
    <style>
        body {
            background: linear-gradient(to right, #87CEEB, #C9A0DC);
        }
        .container {
            margin-top: 100px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <!-- Login Form -->
        <div class="col-md-6">
            <h2>Login</h2>
            <form method="post">
                <div class="form-group">
                    <label for="loginUsername">Username</label>
                    <input type="text" class="form-control" id="loginUsername" placeholder="Enter your username" name="login" required>
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" class="form-control" id="loginPassword" placeholder="Enter your password" name="pass" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
