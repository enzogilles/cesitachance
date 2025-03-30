document.addEventListener('DOMContentLoaded', function() {

  function showNotification(message) {
    const notif = document.createElement('div');
    notif.classList.add('custom-notification');
    notif.textContent = message;
    document.body.appendChild(notif);

    setTimeout(() => {
      if (notif.parentNode) {
        notif.parentNode.removeChild(notif);
      }
    }, 3000);
  }

  function showCustomConfirm(message, onConfirm) {
    const overlay = document.createElement('div');
    overlay.classList.add('custom-confirm-overlay');

    const modal = document.createElement('div');
    modal.classList.add('custom-confirm-modal');

    const text = document.createElement('p');
    text.textContent = message;

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
      onConfirm();               k
      document.body.removeChild(overlay);
    });

    btnCancel.addEventListener('click', () => {
      document.body.removeChild(overlay);
    });

    btnContainer.appendChild(btnOk);
    btnContainer.appendChild(btnCancel);
    modal.appendChild(text);
    modal.appendChild(btnContainer);
    overlay.appendChild(modal);
    document.body.appendChild(overlay);
  }

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
          showNotification(data.message);
          location.reload();
        })
        .catch(error => console.error("Erreur de suppression :", error));
      });
    });
  });

});
