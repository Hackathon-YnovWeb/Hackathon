<?php
$zone = isset($_GET['id']) ? intval($_GET['id']) : 1;
if ($zone < 1 || $zone > 5) {
    http_response_code(404);
    echo "Zone invalide";
    exit;
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>░▒▓ ZONE <?php echo $zone; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="frontend/general/header/header.css" rel="stylesheet">
    <link rel="stylesheet" href="/frontend/zones/infos/info.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php require 'frontend/general/header/header.php';?>

    <div class="cyber-grid"></div>
    <h1 class="title">░▒▓█ SYSTÈME DE SURVEILLANCE ZONE <?php echo $zone; ?> █▓▒░</h1>
    <div class="info-container" id="info-list"></div>

    <script src="/frontend/zones/infos/simulation.js"></script>
    <script src="/frontend/zones/infos/info.js"></script>

    <script>
        const zone = <?php echo $zone; ?>;
        new InfoManager(zone);
        setInterval(async () => {
            generateAndSendDisaster(zone)
        }, 5000);
    </script>
</body>
</html>








