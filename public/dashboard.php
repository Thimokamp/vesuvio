<?php
session_start();

if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}

echo "Welkom! Rol: " . $_SESSION['role'];

if ($_SESSION['role'] === 'management') {
    echo "<p>📊 Management dashboard</p>";
}

if ($_SESSION['role'] === 'magazijn') {
    echo "<p>📦 Magazijn overzicht</p>";
}

if ($_SESSION['role'] === 'verzending') {
    echo "<p>🚚 Verzending scherm</p>";
}
