<?php
include_once __DIR__ . "/connection.php";
if (isset($_POST["deleteComment"])) {
    $id = $_POST["deleteCommentId"];

    $stmt = $conn->prepare("DELETE FROM comment WHERE comment_id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: comments.php");
    }
}
