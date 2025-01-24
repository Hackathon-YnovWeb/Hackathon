// script.js
let activites = []; // Contiendra les données JSON

// URL de l'API
const API_ACTIVITIES_ENDPOINT = "/api/activites";
// Charger les données depuis l'API
async function chargerActivites() {
  try { 
    const response = await fetch(API_ACTIVITIES_ENDPOINT);
    if (!response.ok) throw new Error('Erreur réseau');
    activites = await response.json();
    if (!Array.isArray(activites)) {
      throw new Error('Les données reçues ne sont pas valides.');
    }
    afficherActivites(activites);
    console.log(activites);
  } catch (error) {
    afficherErreur('Impossible de charger les activités. Veuillez réessayer plus tard.');
    console.error('Erreur lors du chargement des activités:', error);
  }
}

// Afficher les activités dans le conteneur
function afficherActivites(activitesFiltrees) {
  const container = document.getElementById('activites-container');
  container.innerHTML = ''; 
  activitesFiltrees.forEach(activite => {
    const card = creerCarteActivite(activite);
    container.appendChild(card);
  });
}

// Créer une carte pour une activité
function creerCarteActivite(activite) {
  const card = document.createElement('div');
  card.className = 'activity-card';

  const inscrit = localStorage.getItem(`activite-${activite.nom}`) === 'true';

  card.innerHTML = `
     <div class="activity-card bg-light p-3 m-3">
                  <h2 class="mt-0">${activite.nom}</h2>
                  <p class="my-2"><strong>Type:</strong> ${activite.type}</p>
                  <p class="my-2"><strong>Description:</strong> ${activite.description}</p>
                  <p class="my-2"><strong>Date:</strong> ${new Date(activite.dateEtHeure).toLocaleString('fr-FR', {
                      weekday: 'long',
                      year: 'numeric',
                      month: 'long',
                      day: 'numeric',
                      hour: '2-digit',
                      minute: '2-digit',
                      hour12: false,
                  })}</p>
                  <p class="my-2"><strong>Danger:</strong> ${activite.danger}</p>
                  <p class="my-2"><strong>Nombre de participants:</strong> 
                      <span id="participants-${activite.nom}">${activite.nombreDeParticipants}</span>
                  </p>
                  <p class="my-2"><strong>Zone:</strong> ${activite.zone}</p>
                  <button type="button" class="btn btn-success"  data-nom="${activite.nom}" ${inscrit ? 'disabled' : ''}>S'inscrire</button>
                  <button type="button" class="btn btn-warning" data-nom="${activite.nom}">Se désinscrire</button>
              </div>
  `;

  if (inscrit) {
    card.querySelector('.inscrire').disabled = true;
  }

  return card;
}

// Afficher un message d’erreur
function afficherErreur(message) {
  const container = document.getElementById('activites-container');
  container.innerHTML = `<p class="error">${message}</p>`;
}


// // Gérer l'inscription
// function sInscrire(nomActivite) {
//   const participantsElement = document.getElementById(`participants-${nomActivite}`);
//   const nombreDeParticipants = parseInt(participantsElement.textContent, 10);

//   // Mettre à jour le nombre de participants
//   participantsElement.textContent = nombreDeParticipants + 1;

//   // Mémoriser l'inscription dans localStorage
//   localStorage.setItem(`activite-${nomActivite}`, 'true');

//   // Désactiver le bouton d'inscription
//   chargerActivites();
// }

// // Gérer la désinscription
// function seDesinscrire(nomActivite) {
//   const participantsElement = document.getElementById(`participants-${nomActivite}`);
//   const nombreDeParticipants = parseInt(participantsElement.textContent, 10);

//   // Mettre à jour le nombre de participants
//   participantsElement.textContent = Math.max(0, nombreDeParticipants - 1);

//   // Supprimer l'inscription dans localStorage
//   localStorage.removeItem(`activite-${nomActivite}`);

//   // Réactiver le bouton d'inscription
//   chargerActivites();
// }


// Filtrer les activités par zone
function filtrerParZone(zone = null) {
    let activitesFiltrees;
  
    // Si aucune zone n'est fournie, afficher toutes les activités
    if (zone === null) {
      activitesFiltrees = activites.activitesDroles;
    } else {
      // Filtrer uniquement les activités correspondant à la zone donnée
      activitesFiltrees = activites.activitesDroles.filter(activite => activite.zone === zone);
    }
  
    afficherActivites(activitesFiltrees);
  }
  

// Charger les activités au démarrage
chargerActivites();
