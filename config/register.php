<?php
require 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if username already exists
    $checkStmt = $conn->prepare(
        "SELECT COUNT(*) FROM users WHERE username = :username"
    );
    $checkStmt->execute(['username' => $username]);
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        echo "⚠️ Username already exists.";
    } else {
        // Insert new user
        $insertStmt = $conn->prepare(
            "INSERT INTO users (username, password) VALUES (:username, :password)"
        );

        if ($insertStmt->execute([
            'username' => $username,
            'password' => $password
        ])) {
            echo "✅ Registration successful! <a href='login.php'>Login</a>";
        } else {
            echo "⚠️ Something went wrong.";
        }
    }
}
?>



