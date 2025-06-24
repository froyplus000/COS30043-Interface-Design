<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../lib/password.php';

$db_server = 'localhost';
$db_user = 'root';
$db_pw = 'root';
$db_name = 'GamerQuest';

$conn = mysqli_connect($db_server, $db_user, $db_pw, $db_name);
mysqli_set_charset($conn, 'utf8');

if (!$conn) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}


