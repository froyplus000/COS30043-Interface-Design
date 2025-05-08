<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Handle preflight requests (OPTIONS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['message'])) {
  echo json_encode(['status' => 'success', 'message' => 'Message received: ' . $data['message']]);
} else {
  echo json_encode(['status' => 'error', 'message' => 'No message received']);
}
?>
