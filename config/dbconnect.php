<?php  
$db = new Database();
$conn = $db->connect();

$stmt = $conn->query("SELECT * FROM users");
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

print_r($result);


class Database {
    private $host = "localhost";
    private $dbname = "oop";
    private $username = "root";
    private $password = "";
    public $conn;

    public function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;

        } catch (PDOException $e) {
            echo "Fout bij verbinden: " . $e->getMessage();
        }
    }
}
