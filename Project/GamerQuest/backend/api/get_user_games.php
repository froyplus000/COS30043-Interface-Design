<?php
session_start();
include '../header.php';
include __DIR__ . '/../db.php';


// Check login
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}
$username = $_SESSION['username'];

// Query all games for this user
$sql = "SELECT rawg_id, gamename, status FROM gq_user_games WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$usergamelist = [
    'wishlist' => [],
    'playing' => [],
    'completed' => []
];

// Group by status
while ($row = $result->fetch_assoc()) {
    $usergamelist[$row['status']][] = [
        'rawg_id' => (int)$row['rawg_id'],
        'gamename' => $row['gamename'],
    ];
}

echo json_encode(['success' => true, 'usergamelist' => $usergamelist]);

$stmt->close();
$conn->close();

