<?php
include_once __DIR__ . "/connection.php";

if (isset($_POST["updateComment"])) {
    $newComment = $_POST["editComment"];
    $commentId = $_POST["comment_id"];

    $stmt = $conn->prepare("UPDATE comment SET comment = ? WHERE comment_id = ?");
    $stmt->bind_param("si", $newComment, $commentId);
    if ($stmt->execute()) {
        header("Location: comments.php");
    }
}
