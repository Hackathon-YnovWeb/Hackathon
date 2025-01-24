<?php
header('Content-Type: application/json');
header('Cache-Control: no-cache');

require_once 'backend/config/config.php';

$lastId = isset($_GET['last_id']) ? intval($_GET['last_id']) : 0;
$zone = isset($_GET['zone']) ? intval($_GET['zone']) : 0;

$stmt = $conn->prepare("SELECT * FROM info WHERE id > ? and zone=$zone ORDER BY date DESC LIMIT 1");
$stmt->bind_param("i", $lastId);
$stmt->execute();
$result = $stmt->get_result();

if ($info = $result->fetch_assoc()) {
    echo json_encode([
        'hasNew' => true,
        'data' => $info
    ]);
} else {
    echo json_encode([
        'hasNew' => false,
        'data' => null
    ]);
}

$stmt->close();
$conn->close();