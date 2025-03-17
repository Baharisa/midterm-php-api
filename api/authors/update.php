<?php
// Include database and model files
require_once '../../config/database.php';
require_once '../../models/Author.php';

// Ensure request method is PUT
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
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

// Check if all required data is provided
if (!isset($data->id, $data->author) || empty($data->id) || empty($data->author)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

// Assign data to Author object
$author->id = $data->id;
$author->author = $data->author;

// Update Author
if ($author->update()) {
    echo json_encode(['message' => 'Author Updated']);
} else {
    echo json_encode(['message' => 'Author Not Updated']);
}
?>
