<?php
header('Content-Type: application/json');


require_once '../../../backend/config/config.php';
try {
   
    $stmt = $conn->prepare("
        SELECT 
            id, 
            nom, 
            description, 
            niveauDanger AS niveau, 
            type, 
            date, 
            zone, 
            intensite_valeur, 
            intensite_unite
        FROM info 
        ORDER BY date DESC 
        LIMIT 20
    ");
    $stmt->execute();
    $result = $stmt->get_result();
    $flashInfos = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(['flash_infos' => $flashInfos]);
} catch(Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>