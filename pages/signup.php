<?php
session_start();
include '../config/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['pass'];


    try {

        $stmt = $pdo->prepare("INSERT INTO usertable (email, login, pass) VALUES (:email, :login, :pass)");

        $stmt->bindParam(':login', $username);
        $stmt->bindParam(':pass', $password);
        $stmt->bindParam(':email', $email);

        $stmt->execute();
        echo "Success";
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
    <title>Sign Up</title>
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
            <h2>Sign Up</h2>
            <form method="post">
                <div class="form-group">
                    <label for="signupUsername">Username</label>
                    <input type="text" class="form-control" id="signupUsername" placeholder="Enter your username" name="login" required>
                </div>
                <div class="form-group">
                    <label for="signupUsername">Email</label>
                    <input type="text" class="form-control" id="signupEmail" placeholder="Enter your email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="signupPassword">Password</label>
                    <input type="password" class="form-control" id="signupPassword" placeholder="Enter your password" name="pass" required>
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
                <p>Already have an account? <a href="index.php">Sign In</a></p>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
