<?php
include '../header.php';
include '../db.php';

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

// Basic validation
if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepared statement to insert new user
$sql = "INSERT INTO users (username, password) VALUES (?, ?)"; // Question Mark means place holder for values
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'SQL Error: ' . $conn->error]);
    exit;
}
// ss -> string, string
$stmt->bind_param("ss", $username, $hashedPassword);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'User registered successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Could not register user. Username may already exist.']);
}

$stmt->close();
$conn->close();
