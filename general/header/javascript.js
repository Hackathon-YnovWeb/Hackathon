   let flashInfos = [];
    let rotationCount = 0;
    const MAX_ROTATIONS = 3;
    const ROTATION_INTERVAL = 20000;
    const PAUSE_INTERVAL = 10000;

    const flashContainer = document.getElementById('flash-container');
    const flashContent = document.getElementById('flash-content');
    const alertPopup = document.getElementById('alert-popup');
    const alertPopupContent = document.getElementById('alert-popup-content');
    const alertCloseButton = document.getElementById('alert-close');
    const alertTitle = document.getElementById('alert-title');
    const alertDescription = document.getElementById('alert-description');
    const alertPreventiveMessage = document.getElementById('alert-preventive-message');
    let alertAlreadyShown = false;

    // Messages préventifs prédéfinis
    const preventiveMessages = {
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

    fetch('./general/footer/flash_infos.json')
        .then(response => response.json())
        .then(data => {
            flashInfos = data.flash_infos;
            startNewsRotation();
        })
        .catch(error => {
            console.error('Erreur de chargement du JSON:', error);
            masquerFlashInfo();
        });

    function startNewsRotation() {
        if (flashInfos.length === 0) {
            masquerFlashInfo();
            return;
        }
        
        const level5Infos = flashInfos.filter(info => info.niveau === "5" && !info.shown);
        
        if (level5Infos.length === 0) {
            flashInfos.forEach(info => {
                if (info.niveau === "5") info.shown = false;
            });
        }
        
        const info = level5Infos.length > 0 
            ? level5Infos[Math.floor(Math.random() * level5Infos.length)]
            : flashInfos[Math.floor(Math.random() * flashInfos.length)];
        
        flashContent.innerHTML = `
            <span class="breaking">FLASH INFOS</span>
            <span class="flash-text">${info.nom} : ${info.description} (Niveau: ${info.niveau})</span>
        `;
        
        flashContainer.classList.add('active');
        
        setTimeout(() => {
            flashContent.classList.add('scrolling');
            
            if (info.niveau === "5" && !alertAlreadyShown) {
                afficherPopupAlerte(info);
                info.shown = true;
                alertAlreadyShown = true;
            }
        }, 100);
        
        rotationCount = 0;
        setupRotationTimer();
    }

    function afficherPopupAlerte(info) {
        alertTitle.textContent = `ALERTE NIVEAU ${info.niveau} : ${info.nom}`;
        alertDescription.textContent = info.description;
        alertPreventiveMessage.textContent = preventiveMessages[info.nom] || 
            "Restez vigilant et suivez les recommandations des autorités compétentes.";
        
        alertPopup.style.display = 'flex';
    }

    function setupRotationTimer() {
        const rotationTimer = setInterval(() => {
            rotationCount++;
            
            if (rotationCount >= MAX_ROTATIONS) {
                clearInterval(rotationTimer);
                masquerFlashInfo();
                
                setTimeout(startNewsRotation, PAUSE_INTERVAL);
            }
        }, ROTATION_INTERVAL);
    }

    function masquerFlashInfo() {
        flashContent.classList.remove('scrolling');
        flashContainer.classList.remove('active');
    }

    alertCloseButton.addEventListener('click', () => {
        alertPopup.style.display = 'none';
        alertAlreadyShown = false;
    });