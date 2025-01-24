<?php
header('Content-Type: application/json');
require_once 'backend/config/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$required_fields = ['nom', 'niveauDanger', 'type', 'zone'];
foreach ($required_fields as $field) {
    if (!isset($data[$field])) {
        http_response_code(400);
        echo json_encode(['error' => "Missing required field: $field"]);
        exit;
    }
}

// Créer des variables pour le bind_param
$nom = $data['nom'];
$description = $data['description'] ?? null;
$niveauDanger = $data['niveauDanger'];
$type = $data['type'];
$zone = $data['zone'];
$intensite_valeur = $data['intensite_valeur'] ?? null;
$intensite_unite = $data['intensite_unite'] ?? null;

$sql = "INSERT INTO info (nom, description, niveauDanger, type, date, zone, intensite_valeur, intensite_unite)
        VALUES (?, ?, ?, ?, NOW(), ?, ?, ?)";

$stmt = $conn->prepare($sql);

// Bind les paramètres avec des variables
$stmt->bind_param(
    "ssssdss",
    $nom,
    $description,
    $niveauDanger,
    $type,
    $zone,
    $intensite_valeur,
    $intensite_unite
);

if ($stmt->execute()) {
    $newId = $conn->insert_id;

    $select = $conn->prepare("SELECT * FROM info WHERE id = ?");
    $select->bind_param("i", $newId);
    $select->execute();
    $result = $select->get_result();
    $newInfo = $result->fetch_assoc();

    http_response_code(201);
    echo json_encode([
        'message' => 'Info added successfully',
        'info' => $newInfo
    ]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to add info']);
}

$stmt->close();
$conn->close();
?>