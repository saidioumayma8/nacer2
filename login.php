<?php
// session_start();
// include 'connection.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = $_POST["username"];
//     $password = $_POST["password"];

//     try {
//         $query = "SELECT * FROM usertable WHERE login = :admin AND pass = :pass";
//         $stmt = $conn->prepare($query);
//         $stmt->bindParam(':admin', $username);
//         $stmt->bindParam(':pass', $password);
//         $stmt->execute();

//         if ($stmt->rowCount() == 1) {
//             $_SESSION['loggedin'] = true;
//             $_SESSION['username'] = $username;

//             header("Location: home.php");
//             exit();
//         } else {
//             echo "Invalid username or password.";
//         }
//     } catch (PDOException $e) {
//         echo "Error: " . $e->getMessage();
//     }

//     $conn = null;
// }
?>
