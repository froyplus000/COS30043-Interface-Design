<?php
session_start();
include '../header.php';
include '../db.php';

if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$username = $_SESSION['username'];
$data = json_decode(file_get_contents("php://input"), true);

$rawg_id = $data['rawg_id'];
$status = $data['status'];

// Validate status
$valid_statuses = ['wishlist', 'playing', 'completed'];
if (!in_array($status, $valid_statuses)) {
    echo json_encode(['success' => false, 'message' => 'Invalid status']);
    exit;
}


$sql = "UPDATE gq_user_games SET status = ? WHERE username = ? AND rawg_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $status, $username, $rawg_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'DB error']);
}

$stmt->close();
$conn->close();