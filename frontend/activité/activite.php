<?php require '../general/header/header.php'; ?>
<head>
  <link rel="stylesheet" href="activite.css">
</head>
<body>
  <header>
    <h1>Activités Catastrophes Naturelles</h1>
    <div class="filter-buttons">
    <button onclick="filtrerParZone()">Toutes les zones</button>
      <button onclick="filtrerParZone(1)">Zone 1</button>
      <button onclick="filtrerParZone(2)">Zone 2</button>
      <button onclick="filtrerParZone(3)">Zone 3</button>
      <button onclick="filtrerParZone(4)">Zone 4</button>
      <button onclick="filtrerParZone(5)">Zone 5</button>
    </div>
  </header>
  <main>
    <div id="activites-container"></div>
  </main>
  <script src="script.js"></script>
</body>
</html>
