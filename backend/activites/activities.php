<?php
// Include the database configuration
require_once '../config/config.php';

// Set headers for JSON response and CORS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle different HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        handleGetActivities($conn); 
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}

// Function to handle GET requests and retrieve activities
function handleGetActivities($conn) {

    $sql = 'SELECT * FROM activities'; 
    $result = $conn->query($sql);

    if ($result) {
        $activities = [];
        while ($row = $result->fetch_assoc()) {
            $activities[] = $row;
        }

    
        echo json_encode($activities);
    } else {
       
        http_response_code(500);
        echo json_encode(['error' => 'Failed to retrieve activities: ' . $conn->error]);
    }
}
$conn->close();

?>

    