<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

// Get raw DELETE data from input
$data = json_decode(file_get_contents("php://input"));

// Ensure ID is set
if (!isset($data->id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

// Set category ID to delete
$category->id = $data->id;

// Attempt delete
if ($category->delete()) {
    echo json_encode(['message' => 'Category Deleted']);
} else {
    echo json_encode(['message' => 'Category Not Found']);
}
?>
