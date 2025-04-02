document.addEventListener('DOMContentLoaded', function() {

  if (notif === "deleted") {
    showNotification("🗑️ Offre supprimée", "success", 4000);
  } else if (notif === "updated") {
    showNotification("✅ Offre modifiée avec succès", "success", 4000);
  } else if (notif === "created") {
    showNotification("✅ Offre créée avec succès", "success", 4000);
  }

  if (notif) {
    // Préserver le paramètre de pagination en supprimant seulement la notification
    url.searchParams.delete("notif");
    window.history.replaceState({}, "", url.toString());
  }

  function showNotification(message, type = "info", duration = 3000) {
    document.querySelectorAll(".notification").forEach(n => n.remove());

    const notification = document.createElement("div");
    notification.className = "notification " + type;
    notification.textContent = message;
    notification.style.position = "fixed";
    notification.style.top = "100px";
    notification.style.left = "50%"; // Centré correctement
    notification.style.transform = "translateX(-50%)";
    notification.style.zIndex = "1000";
    notification.style.padding = "12px 24px";
    notification.style.borderRadius = "8px";
    notification.style.fontWeight = "600";
    notification.style.boxShadow = "0 4px 12px rgba(0,0,0,0.1)";

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
      notification.style.opacity = "0";
      notification.style.transition = "opacity 0.5s ease";
      setTimeout(() => {
        notification.remove();
      }, 500);
    }, duration);
  }

  // Confirmation avant suppression
  document.querySelectorAll('.btn-supprimer').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const id = this.getAttribute("data-id");
      
      // URL mise à jour pour utiliser les nouvelles URLs propres
      showCustomConfirm("Voulez-vous vraiment supprimer cette offre ?", () => {
        window.location.href = `${BASE_URL}offre/supprimer/${id}`;
      });
    });
  });

  function showCustomConfirm(message, onConfirm) {
    // Supprimer tout confirm box existant
    document.querySelectorAll('.custom-confirm-overlay').forEach(el => el.remove());
    
    const overlay = document.createElement('div');
    overlay.classList.add('custom-confirm-overlay');
    overlay.style.position = "fixed";
    overlay.style.top = "0";
    overlay.style.left = "0";
    overlay.style.width = "100%";
    overlay.style.height = "100%";
    overlay.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
    overlay.style.display = "flex";
    overlay.style.alignItems = "center";
    overlay.style.justifyContent = "center";
    overlay.style.zIndex = "2000";

    const modal = document.createElement('div');
    modal.classList.add('custom-confirm-modal');
    modal.style.backgroundColor = "white";
    modal.style.padding = "20px";
    modal.style.borderRadius = "8px";
    modal.style.maxWidth = "400px";
    modal.style.width = "90%";
    modal.style.boxShadow = "0 4px 12px rgba(0, 0, 0, 0.15)";

    const text = document.createElement('p');
    text.textContent = message;
    text.style.marginBottom = "20px";
    text.style.fontSize = "16px";
    text.style.textAlign = "center";

    const btnContainer = document.createElement('div');
    btnContainer.style.display = "flex";
    btnContainer.style.justifyContent = "space-around";
    btnContainer.style.marginTop = "20px";

    const btnOk = document.createElement('button');
    btnOk.textContent = "Confirmer";
    btnOk.classList.add('btn-ok');
    btnOk.style.padding = "8px 16px";
    btnOk.style.backgroundColor = "#ef4444";
    btnOk.style.color = "white";
    btnOk.style.border = "none";
    btnOk.style.borderRadius = "4px";
    btnOk.style.cursor = "pointer";
    btnOk.style.fontWeight = "bold";

    const btnCancel = document.createElement('button');
    btnCancel.textContent = "Annuler";
    btnCancel.classList.add('btn-cancel');
    btnCancel.style.padding = "8px 16px";
    btnCancel.style.backgroundColor = "#e5e7eb";
    btnCancel.style.color = "#374151";
    btnCancel.style.border = "none";
    btnCancel.style.borderRadius = "4px";
    btnCancel.style.cursor = "pointer";

    btnOk.addEventListener('click', () => {
      onConfirm();
      document.body.removeChild(overlay);
    });
  });

    btnCancel.addEventListener('click', () => {
      document.body.removeChild(overlay);
    });
    
    // Fermer en cliquant en dehors de la boîte de dialogue
    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) {
        document.body.removeChild(overlay);
      }
    });

    btnContainer.appendChild(btnCancel);
    btnContainer.appendChild(btnOk);
    modal.appendChild(text);
    modal.appendChild(btnContainer);
    overlay.appendChild(modal);
    document.body.appendChild(overlay);
  }
});
