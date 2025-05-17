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
$rawg_id = isset($data['rawg_id']) ? intval($data['rawg_id']) : 0;
$rating = isset($data['rating']) ? floatval($data['rating']) : 0;
$comment = isset($data['comment']) ? trim($data['comment']) : '';

if ($rawg_id <= 0 || $rating <= 0 || empty($comment))  {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

$sql = "UPDATE gq_reviews SET rating = ?, comment = ? WHERE username = ? AND rawg_id = ?;";
$stmt = $conn->prepare($sql);
if (!$stmt) {
  echo json_encode(["success" => false, "message" => "Edit Review SQL error: " . $conn->error]);
  exit;
}
$stmt->bind_param("dssi", $rating, $comment, $username, $rawg_id);

if ($stmt->execute()) {
  echo json_encode(["success" => true, "message" => "Review updated successfully"]);
} else {
  echo json_encode(["success" => false, "message" => "Failed to update review"]);
}

$stmt->close();
$conn->close();
