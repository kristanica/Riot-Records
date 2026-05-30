<?php
include_once __DIR__ . "/connection.php";

$stmt = $conn->prepare("SELECT * FROM merch");

$stmt->execute();
$result = $stmt->get_result();

$prod  = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $prod[] = $row;
    }
} else {
    echo "<script>alert('Failed to Query'.$conn->error.')</script>";
}
