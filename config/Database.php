<?php
require __DIR__ . '/../vendor/autoload.php'; // Ensures all dependencies and autoloaders are included

// Initialize and load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

class Database {
    private $conn; // Hold the PDO connection object

    public function connect() {
        $this->conn = null; // Initialize connection to null
        try {
            // Create a new PDO connection using environment variables
            $this->conn = new PDO(
                "pgsql:host=" . $_ENV['DB_HOST'] . 
                ";port=" . $_ENV['DB_PORT'] . 
                ";dbname=" . $_ENV['DB_NAME'], 
                $_ENV['DB_USER'], 
                $_ENV['DB_PASS']
            );
            // Set error mode to exception to handle potential SQL errors more gracefully
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Properly handle and log the error instead of outputting it directly
            error_log("Connection error: " . $e->getMessage(), 0); // Consider sending this to a logger instead of echoing
        }
        return $this->conn; // Return the connection object
    }
}
?>
