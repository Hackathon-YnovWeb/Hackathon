<?php
$zone = isset($_GET['id']) ? intval($_GET['id']) : 1;
if ($zone < 1 || $zone > 5) {
    http_response_code(404);
    echo "Zone invalide";
    exit;
}
?>

<?php 
$titiPage = "Zone $zone";
require './frontend/general/header/header.php';
 ?>
<div class="container">
    <div class="cyber-grid"></div>
    <h1 class="title">░▒▓█ SYSTÈME DE SURVEILLANCE ZONE <?php echo $zone; ?> █▓▒░</h1>
    <div class="info-container" id="info-list"></div>
</div>

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








