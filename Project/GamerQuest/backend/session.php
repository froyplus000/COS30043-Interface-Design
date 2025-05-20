<?php
session_start();
include './header.php';
include './db.php';
require_once './lib/password.php';



// if (isset($_SESSION['username'])) {




//     echo json_encode([
//             'loggedIn' => true,
//             'user' => $_SESSION['username']
//         ]);
// } else {
//     echo json_encode([
//         'loggedIn' => false
//     ]);
// }


if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $sql = "SELECT firstname, lastname, email FROM gq_users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode([
            'loggedIn' => true,
            'user' => [
                'username' => $username,
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'email' => $row['email'],
            ]
        ]);
    } else {
        echo json_encode([
            'loggedIn' => true,
            'user' => [
                'username' => $username
            ]
        ]);
    }
} else {
    echo json_encode([
        'loggedIn' => false
    ]);
}

$stmt->close();
$conn->close();