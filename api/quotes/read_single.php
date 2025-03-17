<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Include database and model
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

// Initialize Database
$database = new Database();
$db = $database->connect();

// Initialize Quote object
$quote = new Quote($db);

// Check if 'id' is provided in the request
$quote->id = isset($_GET['id']) ? intval($_GET['id']) : die(json_encode(['message' => 'Missing Required Parameter: id']));

// Fetch quote
$result = $quote->read_single();

if ($result) {
    echo json_encode($result);
} else {
    echo json_encode(['message' => 'Quote Not Found']);
}
?>
 
