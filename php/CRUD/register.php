<?php
include_once __DIR__ . "/connection.php";


if (isset($_POST["register"])) {
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $stmt = $conn->prepare("INSERT INTO users (username, email,password) VALUES (?, ?, ?)");
    if ($password === $confirmPassword) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        // Checks if the user is already registered
        $stmt2 = $conn->prepare("SELECT id FROM users WHERE username= ? OR email = ?");
        $stmt2->bind_param("ss", $username, $email);
        $stmt2->execute();
        $result = $stmt2->get_result();
        if ($result->num_row = 0) {
            echo "<script>alert('User already registered!')</script>";
            return;
        }
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss", $username, $email, $hashed_pass);
        if ($stmt->execute()) {
            echo "<script>
    alert('Account Created Successfully!');
    window.location.href='login.php';
</script>";
            exit;
        } else {
            echo "<script>alert('Something went wrong when creating an account!'.$conn->error')</script>";
        }
    } else {
        echo "<script>alert('Password does not match')</script>";
    }
}
