<?php
include '../header.php';
include '../db.php';
require_once '../lib/password.php';


// $username = trim($_POST['username'] ?? '');
// $password = trim($_POST['password'] ?? '');
$firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
$lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

// Basic validation
if (empty($firstname) || empty($lastname) || empty($username) || empty($password) || empty($email) ) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepared statement to insert new user
$sql = "INSERT INTO gq_users (firstname, lastname, username, password_hash, email) VALUES (?, ?, ?, ?, ?)"; // Question Mark means place holder for values
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'SQL Error: ' . $conn->error]);
    exit;
}

$stmt->bind_param("sssss", $firstname, $lastname, $username, $hashedPassword, $email);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'User registered successfully!']);
} else {
    echo json_encode(['success' => false, 'message' => 'Could not register user. Username may already exist.']);
}

$stmt->close();
$conn->close();
