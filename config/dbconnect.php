<?php

class Database {
    private $host = "localhost";
    private $db = "vesuvio";
    private $user = "root";
    private $pass = "";
    private $conn;

    public function connect() {
        try {
            if ($this->conn === null) {
                $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
                $this->conn = new PDO($dsn, $this->user, $this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        return $this->conn;
    }
}

$db = new Database();
$conn = $db->connect();

if ($conn) {
    echo " Database verbinding gelukt!";
} else {
    echo " Verbinding mislukt";
}


$sql = "SELECT id, naam,wachtwoord FROM users";
$stmt = $conn->query($sql);

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($rows) > 0) {
    foreach ($rows as $row) {
        echo "id: " . $row["id"] . " - Naam: " . $row["naam"] . "<br>";
    }
} else {
    echo "0 results";
}


