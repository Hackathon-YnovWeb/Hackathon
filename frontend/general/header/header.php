<?php
require_once 'backend/config/config.php';
?>
   <!-- Inclusion de jQuery -->
   <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Ton fichier JavaScript -->
    <script src="/frontend/general/header/javascript.js" defer></script>

<header class="bg-primary">
    <nav>
        <div class="container">
            <div class="d-flex justify-content-start">
                <div>
                    <a href="/#">
                        <img src="/frontend/general/header/logoHome.png" alt="logo" class="img-fluid" style="width: 100px;">
                    </a>
                </div>
                <div class="d-flex align-items-center mx-5">
                    <a href="/frontend/activité/activite.php" class="mx-auto">Activité</a>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Zone
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="/zone?id=1">Zone 1</a></li>
                        <li><a href="/zone?id=2">Zone 2</a></li>
                        <li><a href="/zone?id=3">Zone 3</a></li>
                        <li><a href="/zone?id=4">Zone 4</a></li>
                        <li><a href="/zone?id=5">Zone 5</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<div id="alert-popup">
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
</div>

<div id="flash-container" class="flash-container">
    <div id="flash-content" class="flash-content"></div>
</div>

