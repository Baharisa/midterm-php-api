<?php
// Include database and model files
require_once '../../config/database.php';
require_once '../../models/Author.php';

// Ensure request method is DELETE
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode(['message' => 'Method Not Allowed']);
    exit();
}

// Get database connection
$database = new Database();
$db = $database->connect();

// Initialize Author object
$author = new Author($db);

// Get the raw posted data
$data = json_decode(file_get_contents("php://input"));

// Check if 'id' is provided
if (!isset($data->id) || empty($data->id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

// Assign data to Author object
$author->id = $data->id;

// Delete Author
if ($author->delete()) {
    echo json_encode(['message' => 'Author Deleted']);
} else {
    echo json_encode(['message' => 'Author Not Deleted']);
}
?>
