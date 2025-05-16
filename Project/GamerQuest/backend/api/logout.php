<?php
session_start();
include '../header.php';
session_destroy();

echo json_encode(['success' => true, 'message' => 'Logged out']);
