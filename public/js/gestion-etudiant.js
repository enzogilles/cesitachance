document.addEventListener("DOMContentLoaded", function () {
  const BASE_URL = window.BASE_URL || "";

  function showNotification(message, type = "info", duration = 3000) {
    document.querySelectorAll(".notification").forEach(n => n.remove());

    const notification = document.createElement("div");
    notification.className = "notification " + type;
    notification.textContent = message;
    notification.style.position = "fixed";
    notification.style.top = "130px";
    notification.style.left = "37%";
    notification.style.transform = "translateX(-50%)";
    notification.style.zIndex = "1000";
    notification.style.padding = "12px 24px";
    notification.style.borderRadius = "8px";
    notification.style.fontWeight = "600";

    switch (type) {
      case "success":
        notification.style.backgroundColor = "#d1fae5";
        notification.style.color = "#065f46";
        break;
      case "error":
        notification.style.backgroundColor = "#fee2e2";
        notification.style.color = "#991b1b";
        break;
      case "info":
      default:
        notification.style.backgroundColor = "#dbeafe";
        notification.style.color = "#1e3a8a";
        break;
    }

    document.body.appendChild(notification);

    setTimeout(() => {
      notification.remove();
    }, duration);
  }

  // === Redirection / notifications ===
  const url = new URL(window.location.href);
  const notif = url.searchParams.get("notif");

  if (notif === "1") {
    showNotification("🔍 Résultat de la recherche affiché", "info", 5000);
    url.searchParams.delete("notif");
    window.history.replaceState({}, "", url.toString());
  }

  if (notif === "deleted") {
    showNotification("✅ Utilisateur supprimé avec succès", "success", 5000);
    url.searchParams.delete("notif");
    window.history.replaceState({}, "", url.toString());
  }

  // === Bouton réinitialiser ===
  const searchForm = document.querySelector(".search-form");
  const resetButton = document.querySelector(".search-form .bouton-reset");
  if (resetButton && searchForm) {
    resetButton.addEventListener("click", function (e) {
      e.preventDefault();
      // Au lieu de rediriger, on vide le champ et on reset le formulaire
      const searchInput = searchForm.querySelector('input[name="search_query"]');
      if (searchInput) {
        searchInput.value = "";
      }
      // Optionnel : focus sur le champ pour une nouvelle recherche
      if (searchInput) {
        searchInput.focus();
      }
    });
  }

  // === Confirmation suppression ===
  document.querySelectorAll('form[action*="gestionutilisateurs"][method="POST"] .btn-supprimer').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const form = this.closest('form');
      showCustomConfirm("Voulez-vous vraiment supprimer cet utilisateur ?", () => {
        form.submit();
      });
    });
  });

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
});
