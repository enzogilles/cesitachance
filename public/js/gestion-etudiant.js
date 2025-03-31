document.addEventListener("DOMContentLoaded", function () {
  // Sélectionne le formulaire et le bouton reset
  const searchForm = document.querySelector(".search-form");
  const resetButton = document.querySelector(".search-form .bouton-reset");

  // Fonction utilitaire pour afficher une notification
  function showNotification(message, type = "info", duration = 3000) {
    // On supprime d’abord d’éventuelles notifications existantes
    document.querySelectorAll(".notification").forEach(n => n.remove());

    const notification = document.createElement("div");
    notification.className = "notification " + type;
    notification.textContent = message;
    notification.style.position = "fixed";
    notification.style.top = "130px";
    notification.style.left = "37%";
    notification.style.transform = "translateX(-50%)";
    notification.style.zIndex = "1000";

    document.body.appendChild(notification);

    setTimeout(() => {
      notification.remove();
    }, duration);
  }

  if (resetButton) {
    resetButton.addEventListener("click", function (e) {
      e.preventDefault();
      window.location.href = BASE_URL + "index.php?controller=gestionutilisateurs&action=index";
    });
  }

  // Afficher la notification si l'URL contient ?notif=1
  const currentUrl = new URL(window.location.href);
  const notif = currentUrl.searchParams.get("notif");

  if (notif === "1") {
    showNotification("🔍 Résultat de la recherche affiché", "info", 5000);

    currentUrl.searchParams.delete("notif")
    window.history.replaceState({}, "", currentUrl.toString());
  }
});

document.addEventListener("DOMContentLoaded", function () {
  // === GESTION CONFIRMATION SUPPRESSION UTILISATEUR PAR FORMULAIRE ===

  // Crée une popup de confirmation
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
      onConfirm();
      overlay.remove();
    });

    btnCancel.addEventListener('click', () => {
      overlay.remove();
    });

    btnContainer.appendChild(btnOk);
    btnContainer.appendChild(btnCancel);
    modal.appendChild(text);
    modal.appendChild(btnContainer);
    overlay.appendChild(modal);
    document.body.appendChild(overlay);
  }

  // Sélectionne les boutons "Supprimer" dans les formulaires
  document.querySelectorAll('form[action*="gestionutilisateurs"][method="POST"] .btn-supprimer').forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const form = this.closest('form');

      showCustomConfirm("Voulez-vous vraiment supprimer cet utilisateur ?", () => {
        form.submit(); // Envoie le formulaire classique
      });
    });
  });
});


