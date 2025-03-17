<?php
// Include database and model files
require_once '../../config/database.php';
require_once '../../models/Author.php';

// Ensure request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
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

// Check if 'author' is provided
if (!isset($data->author) || empty($data->author)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

// Assign data to Author object
$author->author = $data->author;

// Create Author
if ($author->create()) {
    echo json_encode(['message' => 'Author Created']);
} else {
    echo json_encode(['message' => 'Author Not Created']);
}
?>
