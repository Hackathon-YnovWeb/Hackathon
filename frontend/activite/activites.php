<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="frontend/general/header/header.css" rel="stylesheet">
  <link href="frontend/activite/activites.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


  <title>Activités Catastrophes</title>
</head>
<body>
        <?php require 'frontend/general/header/header.php';?>

  <div>
    <h1>Activités Catastrophes Naturelles</h1>
    <div class="filter-buttons">
    <button onclick="filtrerParZone()">Toutes les zones</button>
      <button onclick="filtrerParZone(1)">Zone 1</button>
      <button onclick="filtrerParZone(2)">Zone 2</button>
      <button onclick="filtrerParZone(3)">Zone 3</button>
      <button onclick="filtrerParZone(4)">Zone 4</button>
      <button onclick="filtrerParZone(5)">Zone 5</button>
    </div>
  </div>
  <main>
    <div id="activites-container"></div>
  </main>
  <script src="frontend/activite/activites.js"></script>
</body>
</html>

