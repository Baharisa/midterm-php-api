<?php
// Include database and object files
require_once "../../config/Database.php";
require_once "../../models/Author.php";

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate author object
$author = new Author($db);

// Check if an ID parameter is provided
if (isset($_GET['id'])) {
    $author->id = $_GET['id'];
    $result = $author->read_single();

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(["message" => "Author Not Found"]);
    }
} else {
    // Fetch all authors
    $result = $author->read();
    $num = $result->rowCount();

    if ($num > 0) {
        $authors_arr = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $authors_arr[] = ['id' => $id, 'author' => $author];
        }
        echo json_encode($authors_arr);
    } else {
        echo json_encode(["message" => "No Authors Found"]);
    }
}
?>
