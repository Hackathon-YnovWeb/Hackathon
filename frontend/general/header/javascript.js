$(document).ready(() => {
    // Charger le JSON et démarrer la rotation des nouvelles
    $.getJSON('./general/footer/flash_infos.json', (data) => {
        startNewsRotation(data.flash_infos);
    }).fail(() => {
        console.error('Erreur de chargement du JSON');
        $('#flash-container').removeClass('active');
    });

    // Fermer la popup lorsque le bouton de fermeture est cliqué
    $('#alert-close').on('click', () => {
        $('#alert-popup').css('display', 'none');
    });

    // Fonction pour démarrer la rotation des nouvelles
    function startNewsRotation(flashInfos) {
        if (flashInfos.length === 0) {
            $('#flash-container').removeClass('active');
            return;
        }

        const level5Infos = flashInfos.filter(info => info.niveau === "5" && !info.shown);

        // Réinitialiser les messages de niveau 5 après rotation
        if (level5Infos.length === 0) {
            flashInfos.forEach(info => {
                if (info.niveau === "5") info.shown = false;
            });
        }

        const info = level5Infos.length > 0 
            ? level5Infos[Math.floor(Math.random() * level5Infos.length)]
            : flashInfos[Math.floor(Math.random() * flashInfos.length)];

        $('#flash-content').html(`
            <span class="breaking">FLASH INFOS</span>
            <span class="flash-text">${info.nom} : ${info.description} (Niveau: ${info.niveau})</span>
        `);

        $('#flash-container').addClass('active');

        setTimeout(() => {
            $('#flash-content').addClass('scrolling');

            if (info.niveau === "5" && $('#alert-popup').css('display') === 'none') {
                $('#alert-title').text(`ALERTE NIVEAU ${info.niveau} : ${info.nom}`);
                $('#alert-description').text(info.description);
                $('#alert-preventive-message').text(getPreventiveMessage(info.nom));
                $('#alert-popup').css('display', 'flex');
                info.shown = true;
            }
        }, 100);

        setupRotationTimer(flashInfos);
    }

    // Fonction pour obtenir un message préventif
    function getPreventiveMessage(category) {
        const messages = {
            "Météo": "Restez à l'abri et suivez les recommandations des autorités locales. Préparez un kit de survie de base.",
            "Sport": "Vérifiez votre équipement de sécurité et restez vigilant lors de toute activité sportive.",
            "Économie": "Protégez vos avoirs et restez informé des changements économiques.",
            "Santé": "Contactez immédiatement un professionnel de santé et suivez ses conseils.",
            "Politique": "Restez calme et suivez les instructions officielles. Évitez les zones de tension.",
            "Technologie": "Protégez vos données personnelles et soyez prudent avec vos informations.",
            "Insolite": "Gardez votre sang-froid et évaluez attentivement la situation avant toute action.",
            "Astronomie": "Observez les instructions des autorités scientifiques et astronomiques.",
            "Mode": "Soyez attentif à votre environnement et aux changements potentiels.",
            "Animaux": "Maintenez une distance de sécurité et contactez les autorités compétentes si nécessaire."
        };
        return messages[category] || "Restez vigilant et suivez les recommandations des autorités compétentes.";
    }

    // Fonction pour gérer le minuteur de rotation
    function setupRotationTimer(flashInfos) {
        let rotationCount = 0;
        const MAX_ROTATIONS = 3;
        const ROTATION_INTERVAL = 20000;
        const PAUSE_INTERVAL = 10000;

        const rotationTimer = setInterval(() => {
            rotationCount++;
            if (rotationCount >= MAX_ROTATIONS) {
                clearInterval(rotationTimer);
                $('#flash-content').removeClass('scrolling');
                $('#flash-container').removeClass('active');

                setTimeout(() => startNewsRotation(flashInfos), PAUSE_INTERVAL);
            }
        }, ROTATION_INTERVAL);
    }
});
