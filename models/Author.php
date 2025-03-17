<?php
class Author {
    private $conn;
    private $table = "authors";

    public $id;
    public $author;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all authors
    public function read() {
        $query = "SELECT id, author FROM " . $this->table . " ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Fetch a single author by ID
    public function read_single() {
        $query = "SELECT id, author FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return ['id' => $row['id'], 'author' => $row['author']];
        }
        return null;
    }

    // Create a new author
    public function create() {
        $query = "INSERT INTO " . $this->table . " (author) VALUES (:author)";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->author = htmlspecialchars(strip_tags($this->author));

        // Bind parameter
        $stmt->bindParam(':author', $this->author);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
