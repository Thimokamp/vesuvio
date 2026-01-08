<?php
require __DIR__ . '/../config/dbconnect.php';

$stmt = $conn->prepare("
UPDATE customers
SET name = ?, email = ?, address = ?
WHERE id = ?
");

$stmt->execute([
    $_POST['name'],
    $_POST['email'],
    $_POST['address'],
    $_POST['customer_id']
]);

header("Location: orders.php");

session_start();

if ($_SESSION['role'] !== 'management') {
    die("Geen toegang");
}

?>