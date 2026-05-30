<?php


include_once __DIR__ . "/../config.php";


$servername = "localhost";
$username = "root";
$password = "";
$database = "paramore";
$port = "3306";
$conn = mysqli_connect($_ENV['DB_HOST'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    $_ENV['DB_NAME'],
    $_ENV['DB_PORT']);
if ($conn->connect_error) {
    die("coonection  Fialed" . $conn->connect_error);
}
