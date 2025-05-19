<?php
include '../header.php';
include '../db.php';
require_once '../lib/password.php';


$data = json_decode(file_get_contents("php://input"), true);
$firstname = isset($data['firstname']) ? trim($data['firstname']) : '';
$lastname = isset($data['lastname']) ? trim($data['lastname']) : '';
$username = isset($data['username']) ? trim($data['username']) : '';
$password = isset($data['password']) ? trim($data['password']) : '';
$email = isset($data['email']) ? trim($data['email']) : '';

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
