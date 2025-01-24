
<?php
require_once '../config/config.php'; // connexion à la base de données

//inscrire
$data = json_decode(file_get_contents('php://input'), true);
$nom = $data['nom'];
$pdo->prepare('UPDATE activities SET nombreDeParticipants = nombreDeParticipants + 1 WHERE nom = ?')->execute([$nom]);



// /desinscrire
$data = json_decode(file_get_contents('php://input'), true);
$nom = $data['nom'];
$pdo->prepare('UPDATE activities SET nombreDeParticipants = GREATEST(nombreDeParticipants - 1, 0) WHERE nom = ?')->execute([$nom]);

?>
