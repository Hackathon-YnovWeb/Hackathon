<?php
// Include the database configuration
require_once 'backend/config/config.php';

// Set headers for JSON response and CORS
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle different HTTP methods
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        // Handle sending a new message
        handleSendMessage($conn);
        break;
    case 'GET':
        // Handle retrieving messages
        handleGetMessages($conn);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        break;
}

function handleSendMessage($conn) {
    // Get the raw POST data
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Validate input
    if (!isset($data['author']) || !isset($data['text'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing required fields']);
        return;
    }

    $author = $conn->real_escape_string($data['author']);
    $text = $conn->real_escape_string($data['text']);
    $time = date('Y-m-d H:i:s');

    // Prepare SQL to insert message
    $sql = "INSERT INTO messages (author, text, time) VALUES ('$author', '$text', '$time')";
    
    if ($conn->query($sql)) {
        http_response_code(201);
        echo json_encode(['status' => 'Message sent successfully', 'id' => $conn->insert_id]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to send message: ' . $conn->error]);
    }
}

function handleGetMessages($conn) {
    // Optional: Add pagination
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 50;
    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;

    // Retrieve messages
    $sql = "SELECT * FROM messages ORDER BY time DESC LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);

    if ($result) {
        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }

        echo json_encode($messages);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to retrieve messages: ' . $conn->error]);
    }
}

// Close the database connection at the end
$conn->close();
?>