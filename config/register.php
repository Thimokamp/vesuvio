<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
    <input type="text" name="naam" placeholder="Gebruikersnaam" required>
    <input type="password" name="password" placeholder="Wachtwoord" required>

    <select name="role" required>
        <option value="management">Management</option>
        <option value="magazijn">Magazijn</option>
        <option value="verzending">Verzending</option>
    </select>

    <button type="submit">Registreren</button>
</form>

</body>
</html>

<?php
require 'config/dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $naam = $_POST['naam'];
    $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare(
        "INSERT INTO users (naam, wachtwoord, role) VALUES (:u, :p, :r)"
    );

    $stmt->execute([
        ':u' => $naam,
        ':p' => $wachtwoord,
        ':r' => $role
    ]);

    echo "Gebruiker geregistreerd";
}




