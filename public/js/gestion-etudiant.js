document.addEventListener('DOMContentLoaded', function() {
  // Fonction utilitaire pour afficher une notification stylisée
  function showNotification(message, type = "info") {
    document.querySelectorAll(".notification").forEach(notification => notification.remove());
    const notification = document.createElement("div");
    notification.className = `notification ${type}`;
    notification.textContent = message;
<<<<<<< Updated upstream
    document.body.appendChild(notification);
    setTimeout(() => {
      notification.remove();
    }, 3000);
  }

  // RECHERCHE
  const searchForm = document.getElementById('search-etudiant-form');
  if (searchForm) {
    searchForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const email = document.getElementById('email-etudiant').value.trim();
      fetch(`../api/gestion-etudiants.php?action=search&email=${email}`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('res-nom').textContent = data.nom || "Introuvable";
          document.getElementById('res-prenom').textContent = data.prenom || "-";
          document.getElementById('res-email').textContent = data.email || "-";
        })
        .catch(error => console.error("Erreur de recherche :", error));
    });
  }

  // CREER
  const createForm = document.getElementById('create-etudiant-form');
  if (createForm) {
    createForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(createForm);
      fetch("../api/gestion-etudiants.php?action=create", {
        method: "POST",
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        showNotification(data.message, data.success ? "success" : "error");
        if (data.success) {
          createForm.reset();
        }
      })
      .catch(error => {
        console.error("Erreur :", error);
        showNotification("Une erreur s'est produite.", "error");
      });
    });
  }

  // MODIFIER
  const updateForm = document.getElementById('update-etudiant-form');
  if (updateForm) {
    updateForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(updateForm);
      fetch("../api/gestion-etudiants.php?action=update", {
        method: "POST",
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        showNotification(data.message, data.success ? "success" : "error");
        if (data.success) {
          updateForm.reset();
        }
      })
      .catch(error => {
        console.error("Erreur :", error);
        showNotification("Une erreur s'est produite.", "error");
      });
    });
  }

  // SUPPRIMER
  const deleteForm = document.getElementById('delete-etudiant-form');
  if (deleteForm) {
    deleteForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(deleteForm);
      fetch("../api/gestion-etudiants.php?action=delete", {
        method: "POST",
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        showNotification(data.message, data.success ? "success" : "error");
        if (data.success) {
          deleteForm.reset();
        }
      })
      .catch(error => {
        console.error("Erreur :", error);
        showNotification("Une erreur s'est produite.", "error");
      });
    });
=======
    notification.style.position = "fixed";
    notification.style.top = "130px";
    notification.style.left = "50%"; // Centré
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
      case "info":
      default:
        notification.style.backgroundColor = "#dbeafe";
        notification.style.color = "#1e3a8a";
        break;
    }

    document.body.appendChild(notification);

    // Animation de fondu
    setTimeout(() => {
      notification.style.opacity = "0";
      notification.style.transition = "opacity 0.5s ease";
      setTimeout(() => {
        notification.remove();
      }, 500);
    }, duration);
>>>>>>> Stashed changes
  }

  if (resetButton) {
    resetButton.addEventListener("click", function (e) {
      e.preventDefault();
      // URL mise à jour pour utiliser les URLs propres
      window.location.href = BASE_URL + "gestionutilisateurs/index";
    });
  }

  const currentUrl = new URL(window.location.href);
  const notif = currentUrl.searchParams.get("notif");

  if (notif === "1") {
    showNotification("🔍 Résultat de la recherche affiché", "info", 5000);

    currentUrl.searchParams.delete("notif")
    window.history.replaceState({}, "", currentUrl.toString());
  }

  if (notif === "deleted") {
    showNotification("✅ Utilisateur supprimé avec succès", "success", 5000);
    currentUrl.searchParams.delete("notif");
    window.history.replaceState({}, "", currentUrl.toString());
  }

  // === POPUP DE CONFIRMATION ===
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

  // === MISE À JOUR DU SÉLECTEUR POUR LES FORMULAIRES ===
  // Utiliser un sélecteur plus générique pour attraper tous les boutons de suppression
  document.querySelectorAll('.btn-supprimer[data-id]').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      
      const userId = this.getAttribute('data-id');
      const form = this.closest('form');
      
      showCustomConfirm("Voulez-vous vraiment supprimer cet utilisateur ?", () => {
        if (form) {
          // Si le bouton est dans un formulaire, soumettre le formulaire
          form.submit();
        } else {
          // Sinon, rediriger vers l'URL de suppression avec l'ID
          window.location.href = `${BASE_URL}gestionutilisateurs/supprimer/${userId}`;
        }
      });
    });
  });

  // Sélecteur alternatif pour les formulaires sans attribut data-id sur le bouton
  document.querySelectorAll('form[action*="gestionutilisateurs"] .btn-supprimer:not([data-id])').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const form = this.closest('form');
      
      if (form) {
        showCustomConfirm("Voulez-vous vraiment supprimer cet utilisateur ?", () => {
          form.submit();
        });
      }
    });
  });
});
