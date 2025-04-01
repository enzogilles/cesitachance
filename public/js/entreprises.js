document.addEventListener('DOMContentLoaded', function () {
  const url = new URL(window.location.href);
  const notif = url.searchParams.get("notif");

  // 🔔 Affichage de la notification si notif dans l'URL
  if (notif === "updated") {
      showNotification("✅ Entreprise modifiée avec succès", "success", 4000);
  } else if (notif === "created") {
      showNotification("✅ Entreprise créée avec succès", "success", 4000);
  } else if (notif === "deleted") {
      showNotification("🗑️ Entreprise supprimée avec succès", "success", 4000);
  }

  // Nettoie l’URL pour éviter que la notif réapparaisse
  if (notif) {
      url.searchParams.delete("notif");
      window.history.replaceState({}, "", url.toString());
  }

  // 🧼 Affiche une notification stylée
  function showNotification(message, type = "info", duration = 3000) {
      document.querySelectorAll(".notification").forEach(n => n.remove());

      const notification = document.createElement("div");
      notification.className = "notification " + type;
      notification.textContent = message;
      notification.style.position = "fixed";
      notification.style.top = "100px";
      notification.style.left = "50%";
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

  // ✅ Confirmation personnalisée avant suppression
  document.querySelectorAll('.btn-supprimer').forEach(button => {
      button.addEventListener('click', function (e) {
          e.preventDefault();
          const href = this.getAttribute("href");

          showCustomConfirm("Voulez-vous vraiment supprimer cette entreprise ?", () => {
              // Redirection avec le paramètre notif=deleted ajouté
              window.location.href = href; // Attention : notif=deleted doit être ajouté par le contrôleur PHP après suppression
          });
      });
  });

  // 💬 Fenêtre modale de confirmation
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
});
