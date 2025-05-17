<?php
session_start();
include '../header.php';
include '../db.php';

if (!isset($_SESSION['username'])) {
  echo json_encode(["success" => false, "message" => "User not logged in"]);
  exit;
}

$username = $_SESSION['username'];

$data = json_decode(file_get_contents("php://input"), true);
$rawg_id = isset($data['rawg_id']) ? intval($data['rawg_id']) : 0;

if ($rawg_id <= 0) {
  echo json_encode(["success" => false, "message" => "Invalid rawg_id"]);
  exit;
}

$sql = "DELETE FROM gq_reviews WHERE username = ? AND rawg_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $username, $rawg_id);

if ($stmt->execute()) {
  echo json_encode(["success" => true, "message" => "Review deleted successfully"]);
} else {
  echo json_encode(["success" => false, "message" => "Failed to delete review"]);
}

$stmt->close();
$conn->close();
?>
