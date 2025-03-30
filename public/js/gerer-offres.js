document.addEventListener('DOMContentLoaded', function() {

  // Fonction utilitaire : affiche une pop-up de confirmation
  function showCustomConfirm(message, onConfirm) {
    // Créer l'overlay
    const overlay = document.createElement('div');
    overlay.classList.add('custom-confirm-overlay');

    // Créer la fenêtre
    const modal = document.createElement('div');
    modal.classList.add('custom-confirm-modal');

    // Message
    const text = document.createElement('p');
    text.textContent = message;

    // Boutons
    const btnContainer = document.createElement('div');
    btnContainer.style.display = "flex";
    btnContainer.style.justifyContent = "space-around";
    btnContainer.style.marginTop = "20px";

    const btnOk = document.createElement('button');
    btnOk.textContent = "OK";
    btnOk.classList.add('btn-ok');

    const btnCancel = document.createElement('button');
    btnCancel.textContent = "Annuler";
    btnCancel.classList.add('btn-cancel');

    btnOk.addEventListener('click', () => {
      onConfirm();
      document.body.removeChild(overlay);
    });

    btnCancel.addEventListener('click', () => {
      document.body.removeChild(overlay);
    });

    // Composer la fenêtre
    btnContainer.appendChild(btnOk);
    btnContainer.appendChild(btnCancel);
    modal.appendChild(text);
    modal.appendChild(btnContainer);
    overlay.appendChild(modal);
    document.body.appendChild(overlay);
  }

  // GESTION DU BOUTON MODIFIER (exemple)
  document.querySelectorAll('.btn-modifier').forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const offreId = this.dataset.id;
      window.location.href = `${BASE_URL}index.php?controller=offre&action=modifier&id=${offreId}`;
    });
  });

  // GESTION DU BOUTON SUPPRIMER
  document.querySelectorAll('.btn-supprimer').forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const offreId = this.dataset.id;

      showCustomConfirm("Voulez-vous vraiment supprimer cette offre ?", () => {
        fetch(`${BASE_URL}api/gerer-offres.php?action=delete&id=${offreId}`, {
          method: "DELETE"
        })
        .then(response => response.json())
        .then(data => {
          alert(data.message);
          location.reload();
        })
        .catch(error => console.error("Erreur de suppression :", error));
      });
    });
  });

});
