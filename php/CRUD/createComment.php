<?php
include_once __DIR__ . "/connection.php";
if (isset($_POST["createComment"])) {
    $success = false;
    $username =  $_SESSION["username"];
    $email = $_SESSION["email"];
    $user_id = $_SESSION["id"];
    $comment = $_POST["comment"];

    $stmt = $conn->prepare("INSERT INTO comment (username, email, comment, user_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $username, $email, $comment, $user_id);

    if ($stmt->execute()) {
        $success = true;
        echo "<script>alert('Comment Added!')</script>";
    }
    $conn->close();
}
