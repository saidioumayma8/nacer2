<?php
$dbname = "electronacer";
$dbuser = "root";
$dbpass = "";
$dbhost = "localhost";

try {
    $pdo = new PDO("mysql:host=" . $dbhost . ";dbname=" . $dbname, $dbuser, $dbpass);
} catch (PDOException $err) {
    echo "Error: " . $err->getMessage();
}
?>
