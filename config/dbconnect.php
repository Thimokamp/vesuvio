<?php
echo "PHP is running<br>";

class Database {
    private $host = "localhost";
    private $db = "vesuvio";
    private $user = "root";
    private $pass = "";
    private $conn;

    public function connect() {
        try {
            if ($this->conn == null) {
                $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4";
                $this->conn = new PDO($dsn, $this->user, $this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                echo "Connection successful!";
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $this->conn;
    }
}

$db = new Database();
$conn = $db->connect();

$sql = "SELECT id, naam, wachtwoord FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
} else {
  echo "0 results";
}



?>

