<header id="header-container" class="bg-primary p-4"></header>
<h1>Météo en Temps Réel à Toulouse</h1>
<div id="map"></div>

<script>
    // Initialisation de la carte Leaflet
    var map = L.map('map').setView([43.6047, 1.4442], 12);  // Coordonnées de Toulouse

    // Ajouter un fond de carte OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Fonction pour obtenir la météo de Toulouse
    fetch('https://api.openweathermap.org/data/2.5/weather?lat=43.6047&lon=1.4442&appid=VOTRE_CLE_API&units=metric')
        .then(response => response.json())
        .then(data => {
            const temperature = data.main.temp;
            const weatherDescription = data.weather[0].description;
            const icon = `https://openweathermap.org/img/wn/${data.weather[0].icon}.png`;

            // Afficher un marqueur à Toulouse avec les informations météo
            var marker = L.marker([43.6047, 1.4442]).addTo(map);
            marker.bindPopup(`
                <b>Météo à Toulouse</b><br>
                Température: ${temperature}°C<br>
                Condition: ${weatherDescription}<br>
                <img src="${icon}" alt="Weather Icon"/>
            `).openPopup();
        })
        .catch(error => console.error('Erreur:', error));

       
</script>