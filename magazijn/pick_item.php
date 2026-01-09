<?php
session_start();

if ($_SESSION['role'] !== 'magazijn') {
    die("Geen toegang");
}

require __DIR__ . '/../config/dbconnect.php';

$orderItemId = $_POST['order_item_id'];

$stmt = $conn->prepare("
UPDATE parts
SET picked = 1
WHERE id = ?
");
$stmt->execute([$orderItemId]);

header("Location: magazijn.php");
exit;

