<?php
session_start();
include '../header.php';
include '../db.php';


if (!isset($_SESSION["username"])) {
  echo json_encode(["success" => false, "message" => "User not logged in"]);
  exit;
}


$username = $_SESSION["username"];
$data = json_decode(file_get_contents("php://input"), true);
$rawg_id = isset($data['rawg_id']) ? trim($data['rawg_id']) : '';
$rating = isset($data['rating']) ? floatval($data['rating']) : '';
$comment = isset($data['comment']) ? trim($data['comment']) : '';

if (empty($username) || empty($rawg_id) || empty($rating) || empty($comment) ) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}


$check_sql = "SELECT id FROM gq_reviews WHERE username = ? AND rawg_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("si", $username, $rawg_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
  echo json_encode(["success" => false, "message" => "You already reviewed this game."]);
  exit;
}
$check_stmt->close();


// Add Review
$sql = "INSERT INTO gq_reviews (username, rawg_id, rating, comment) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Add Review SQL Error: ' . $conn->error]);
    exit;
}
$stmt->bind_param("sids", $username, $rawg_id, $rating, $comment);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Add review successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Could not add review.']);
}

$stmt->close();
$conn->close();