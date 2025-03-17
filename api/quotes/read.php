<?php
// Assuming the headers and database connection are managed in index.php and this file is included there.

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
