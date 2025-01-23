// script.js
let activites = []; // Contiendra les données JSON

// Charger les données depuis un fichier JSON
async function chargerActivites() {
  try {
    const response = await fetch('ActivitesCatastrophes.json');
    if (!response.ok) throw new Error('Erreur réseau');
    activites = await response.json();
    afficherActivites(activites.activitesDroles);
  } catch (error) {
    console.error('Erreur lors du chargement des activités:', error);
  }
}

// Afficher les activités dans le conteneur
function afficherActivites(activitesFiltrees) {
  const container = document.getElementById('activites-container');
  container.innerHTML = ''; // Réinitialise le contenu avant d'afficher
  activitesFiltrees.forEach(activite => {
    const card = document.createElement('div');
    card.className = 'activity-card';

    // Vérifier si l'utilisateur est déjà inscrit (localStorage)
    const inscrit = localStorage.getItem(`activite-${activite.nom}`) === 'true';

    card.innerHTML = `
      <h2>${activite.nom}</h2>
      <p><strong>Type:</strong> ${activite.type}</p>
      <p><strong>Description:</strong> ${activite.description}</p>
      <p><strong>Date:</strong> ${new Date(activite.dateEtHeure).toLocaleString()}</p>
      <p><strong>Danger:</strong> ${activite.danger}</p>
      <p><strong>Nombre de participants:</strong> <span id="participants-${activite.nom}">${activite.nombreDeParticipants}</span></p>
      <p><strong>Zone:</strong> ${activite.zone}</p>
      <button class="inscrire" onclick="sInscrire('${activite.nom}')">S'inscrire</button>
      <button class="desinscrire" onclick="seDesinscrire('${activite.nom}')">Se désinscrire</button>
    `;

    // Désactiver le bouton d'inscription si déjà inscrit
    if (inscrit) {
      card.querySelector('.inscrire').disabled = true;
    }

    container.appendChild(card);
  });
}

// Gérer l'inscription
function sInscrire(nomActivite) {
  const participantsElement = document.getElementById(`participants-${nomActivite}`);
  const nombreDeParticipants = parseInt(participantsElement.textContent, 10);

  // Mettre à jour le nombre de participants
  participantsElement.textContent = nombreDeParticipants + 1;

  // Mémoriser l'inscription dans localStorage
  localStorage.setItem(`activite-${nomActivite}`, 'true');

  // Désactiver le bouton d'inscription
  chargerActivites();
}

// Gérer la désinscription
function seDesinscrire(nomActivite) {
  const participantsElement = document.getElementById(`participants-${nomActivite}`);
  const nombreDeParticipants = parseInt(participantsElement.textContent, 10);

  // Mettre à jour le nombre de participants
  participantsElement.textContent = Math.max(0, nombreDeParticipants - 1);

  // Supprimer l'inscription dans localStorage
  localStorage.removeItem(`activite-${nomActivite}`);

  // Réactiver le bouton d'inscription
  chargerActivites();
}


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
