<?php
include '../header.php';
session_start();
include "../db.php";
require_once '../lib/password.php';


// Use classic isset() checks compatible with PHP 5.6
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Validate input
if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Username and password are required.']);
    exit;
}

// Look up user
$sql = "SELECT * FROM users WHERE username = ?";
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

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];

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
