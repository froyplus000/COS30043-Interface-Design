<?php
session_start();
include './header.php';
require_once './lib/password.php';



if (isset($_SESSION['username'])) {
    echo json_encode([
        'loggedIn' => true,
        'user' => $_SESSION['username']
    ]);
} else {
    echo json_encode([
        'loggedIn' => false
    ]);
}
