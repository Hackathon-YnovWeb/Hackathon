<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site HTML avec Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="general/header/header.css" rel="stylesheet">
    <link rel="stylesheet" href="general/header/header.css">
    <!-- Inclure les fichiers CSS et JS dans le HTML -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="general/header/javascript.js"></script>
    <script src="/general/header/javascript.js"></script>

<header class="bg-primary">
    <nav>
        <div class="container">
            <div class="d-flex justify-content-start">
                <div>
                    <a href="/#">
                        <img src="/general/header/logoHome.png" alt="logo" class="img-fluid" style="width: 100px;">
                    </a>
                </div>
                <div class="d-flex align-items-center mx-5">
                    <a href="#" class="mx-auto">Chat</a>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Zone
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><button class="dropdown-item" type="button">Zone 1</button></li>
                        <li><button class="dropdown-item" type="button">Zone 2</button></li>
                        <li><button class="dropdown-item" type="button">Zone 3</button></li>
                        <li><button class="dropdown-item" type="button">Zone 4</button></li>
                        <li><button class="dropdown-item" type="button">Zone 5</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- <div id="alert-popup">
    <div id="alert-popup-content">
        <button id="alert-close">✕</button>
        <div class="alert-icons">
            <i class="fas fa-exclamation-triangle"></i>
            <i class="fas fa-bell"></i>
            <i class="fas fa-radiation"></i>
        </div>
        <h2 id="alert-title"></h2>
        <p id="alert-description"></p>
        <div class="preventive-message">
            <strong>Message préventif :</strong>
            <p id="alert-preventive-message"></p>
        </div>
    </div>
</div> -->

<div id="flash-container" class="flash-container">
    <div id="flash-content" class="flash-content"></div>
</div>

