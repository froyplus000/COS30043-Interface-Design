<?php
include '../header.php';
include '../db.php';

$data = json_decode(file_get_contents("php://input"), true);
$rawg_id = isset($data['rawg_id']) ? trim($data['rawg_id']) : '';


if (empty($rawg_id)){
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

$sql = 'SELECT username, rating, comment, created_at FROM gq_reviews WHERE rawg_id = ? ORDER BY created_at DESC; ';
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Get Review SQL Error: ' . $conn->error]);
    exit;
}

$stmt->bind_param("i", $rawg_id);
$stmt->execute();
$result = $stmt->get_result();

$reviews = [];

while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}

echo json_encode([
    "success" => true,
    "reviews" => $reviews
]);


$stmt->close();
$conn->close();