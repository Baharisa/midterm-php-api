<?php
class Category {
    private $conn;
    private $table = "categories";

    public $id;
    public $category;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all categories
    public function read() {
        $query = "SELECT id, category FROM " . $this->table . " ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Fetch a single category by ID
    public function read_single() {
        $query = "SELECT id, category FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return ['id' => $row['id'], 'category' => $row['category']];
        }
        return null;
    }

    // Create a new category
    public function create() {
        $query = "INSERT INTO " . $this->table . " (category) VALUES (:category)";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->category = htmlspecialchars(strip_tags($this->category));

        // Bind parameter
        $stmt->bindParam(':category', $this->category);

        // Execute the query
        return $stmt->execute();
    }

    // Update a category
    public function update() {
        $query = "UPDATE " . $this->table . " SET category = :category WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameters
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        // Execute the query
        return $stmt->execute();
    }

    // Delete a category
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameter
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        // Execute the query
        return $stmt->execute();
    }
}
?>
