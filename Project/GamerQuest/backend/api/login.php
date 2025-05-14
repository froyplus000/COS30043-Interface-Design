<?php
include '../header.php';
session_start();
include "../db.php";

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

// Validate input
if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Username and password are required.']);
    exit;
}

// Look up user
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    // Credentials are correct → start session
    $_SESSION['user'] = $user['username'];

    echo json_encode([
        'success' => true,
        'message' => 'Login successful.',
        'user' => $user['username']
    ]);
} else {
    // Invalid login
    echo json_encode([
        'success' => false,
        'message' => 'Invalid username or password.'
    ]);
}

$stmt->close();
$conn->close();
