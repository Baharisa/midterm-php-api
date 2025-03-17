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

// Fetch quotes
$result = $quote->read();
$num = $result->rowCount();

if ($num > 0) {
    $quotes_arr = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $quotes_arr[] = [
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
        ];
    }

    echo json_encode($quotes_arr);
} else {
    echo json_encode(['message' => 'No Quotes Found']);
}
?>
