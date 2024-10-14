<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'kartamci';
    private $username = 'root'; 
    private $password = ''; 
    private $conn;

    // Fungsi untuk koneksi ke database
    public function connect() {
        $this->conn = null;

        try {
            // Menggunakan PDO untuk koneksi yang lebih aman
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);  // Keamanan tambahan
        } catch (PDOException $e) {
            echo "Koneksi Gagal: " . $e->getMessage();
        }

        return $this->conn;
    }
}

// Contoh penggunaan 
$db = new Database(); 
$conn = $db->connect();  // Use $conn instead of $pdo

// HTML table
?>