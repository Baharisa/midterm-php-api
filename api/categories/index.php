<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    if (isset($_GET['id'])) {
        require 'read_single.php';
    } else {
        require 'read.php';
    }
} elseif ($method === 'POST') {
    require 'create.php';
} else {
    echo json_encode(['message' => 'Invalid Request Method']);
}
?>
