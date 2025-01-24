<?php
require_once 'backend/config/config.php';

header('Content-Type: application/json');

$zone = isset($_GET['zone']) ? intval($_GET['zone']) : 0;

$stmt = $conn->prepare("SELECT * FROM info WHERE zone=$zone ORDER BY date DESC LIMIT 50");

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $infos = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($infos);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to retrieve info']);
}

$stmt->close();
$conn->close();
?>