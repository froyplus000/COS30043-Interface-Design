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
$status = 'wishlist';



if (empty($username) || empty($rawg_id) ) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}
$sql = "INSERT INTO gq_user_games (username, rawg_id, status) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'SQL Error: ' . $conn->error]);
    exit;
}

$stmt->bind_param("sis", $username, $rawg_id, $status);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Game add successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Could not add a game.']);
}

$stmt->close();
$conn->close();