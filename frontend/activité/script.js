// script.js
$(document).ready(() => {
  let activites = []; // Contiendra les données JSON

  // Charger les données depuis un fichier JSON
  function chargerActivites() {
      $.getJSON('ActivitesCatastrophes.json')
          .done((data) => {
              activites = data;
              afficherActivites(activites.activitesDroles);
          })
          .fail((error) => {
              console.error('Erreur lors du chargement des activités:', error);
          });
  }

  // Afficher les activités dans le conteneur
  function afficherActivites(activitesFiltrees) {
      const $container = $('#activites-container');
      $container.empty(); // Réinitialise le contenu avant d'afficher

      activitesFiltrees.forEach((activite) => {
          const inscrit = localStorage.getItem(`activite-${activite.nom}`) === 'true';

          const card = `
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
          $container.append(card);
      });
  }

  // Gérer l'inscription
  $(document).on('click', '.inscrire', function () {
      const nomActivite = $(this).data('nom');
      const $participantsElement = $(`#participants-${nomActivite}`);
      const nombreDeParticipants = parseInt($participantsElement.text(), 10);

      // Mettre à jour le nombre de participants
      $participantsElement.text(nombreDeParticipants + 1);

      // Mémoriser l'inscription dans localStorage
      localStorage.setItem(`activite-${nomActivite}`, 'true');

      // Désactiver le bouton d'inscription
      $(this).prop('disabled', true);
  });

  // Gérer la désinscription
  $(document).on('click', '.desinscrire', function () {
      const nomActivite = $(this).data('nom');
      const $participantsElement = $(`#participants-${nomActivite}`);
      const nombreDeParticipants = parseInt($participantsElement.text(), 10);

      // Mettre à jour le nombre de participants
      $participantsElement.text(Math.max(0, nombreDeParticipants - 1));

      // Supprimer l'inscription dans localStorage
      localStorage.removeItem(`activite-${nomActivite}`);

      // Réactiver le bouton d'inscription
      $(`.inscrire[data-nom="${nomActivite}"]`).prop('disabled', false);
  });

  // Filtrer les activités par zone
  function filtrerParZone(zone = null) {
      let activitesFiltrees;

      // Si aucune zone n'est fournie, afficher toutes les activités
      if (zone === null) {
          activitesFiltrees = activites.activitesDroles;
      } else {
          // Filtrer uniquement les activités correspondant à la zone donnée
          activitesFiltrees = activites.activitesDroles.filter((activite) => activite.zone === zone);
      }

      afficherActivites(activitesFiltrees);
  }

  // Charger les activités au démarrage
  chargerActivites();
});
