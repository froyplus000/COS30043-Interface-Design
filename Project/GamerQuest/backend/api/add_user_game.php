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


// Check if game already exist for this user
$check_sql = "SELECT id FROM gq_user_games WHERE username = ? AND rawg_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("si", $username, $rawg_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
  echo json_encode(['success' => false, 'message' => 'Game already exists in your library.']);
  exit;
}
$check_stmt->close();



// add game
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