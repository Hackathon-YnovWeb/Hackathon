<?php
// Fichier : router.php
$request = $_SERVER['REQUEST_URI']; // Récupère l'URL demandée

// Si le fichier demandé existe, le servir directement
if (file_exists(__DIR__ . $request) && !is_dir(__DIR__ . $request)) {
    return false; // Laisser PHP servir directement le fichier
}

switch ($request) {
   case '/':
        require __DIR__ . '/index.php';
        break;
   case '/zones':
        require __DIR__ . '/frontend/zones/chat/chat.php';
        break;
   case '/api/chat':
        require __DIR__ . '/backend/api/chat_api.php';
        break;
   default:
        http_response_code(404);
        require __DIR__ . '/404.php';
        break;
}
?>