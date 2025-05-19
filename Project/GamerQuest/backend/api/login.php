<?php
include '../header.php';
include "../db.php";
require_once '../lib/password.php';



$data = json_decode(file_get_contents("php://input"), true);
$username = isset($data['username']) ? trim($data['username']) : '';
$password = isset($data['password']) ? trim($data['password']) : '';


// Validate input
if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Username and password are required.']);
    exit;
}

// Look up user
$sql = "SELECT * FROM gq_users WHERE username = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Database error: prepare failed']);
    exit;
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['username'] = $user['username'];

        echo json_encode([
            'success' => true,
            'message' => 'Login successful.',
            'user' => $user['username']
        ]);
        exit;
    }
}

// Login failed
echo json_encode([
    'success' => false,
    'message' => 'Invalid username or password.'
]);

$stmt->close();
$conn->close();
