
<?php
require_once '../config/config.php'; // connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $activityId = intval($_POST['id']);

    // Vérifie si l'ID est valide
    $stmt = $pdo->prepare("SELECT nombreDeParticipants FROM activities WHERE id = ?");
    $stmt->execute([$activityId]);
    $activity = $stmt->fetch();

    if ($activity) {
        // Réduit le nombre de participants (sans aller en dessous de 0)
        $newCount = max(0, $activity['nombreDeParticipants'] - 1);
        $updateStmt = $pdo->prepare("UPDATE activities SET nombreDeParticipants = ? WHERE id = ?");
        $updateStmt->execute([$newCount, $activityId]);

        echo json_encode(["success" => true, "newCount" => $newCount]);
    } else {
        echo json_encode(["success" => false, "message" => "Activité non trouvée."]);
    }
}
?>
