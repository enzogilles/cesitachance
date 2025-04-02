document.addEventListener('DOMContentLoaded', function() {
  // Fonction utilitaire pour afficher une notification stylisée
  function showNotification(message, type = "info") {
    document.querySelectorAll(".notification").forEach(notification => notification.remove());
    const notification = document.createElement("div");
    notification.className = `notification ${type}`;
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
      default:
        notification.style.backgroundColor = "#dbeafe";
        notification.style.color = "#1e3a8a";
        break;
    }

    document.body.appendChild(notification);
    setTimeout(() => {
      notification.remove();
    }, 3000);
  }

  // GESTION DU BOUTON MODIFIER
  document.querySelectorAll('.btn-modifier').forEach(button => {
    button.addEventListener('click', function() {
      const piloteId = this.getAttribute("data-id");
      window.location.href = `${BASE_URL}pilote/modifier/${piloteId}`;
    });
  });

  // GESTION DU BOUTON SUPPRIMER
  document.querySelectorAll('.btn-supprimer').forEach(button => {
    button.addEventListener('click', function() {
      const piloteId = this.getAttribute("data-id");
      if (confirm("Voulez-vous vraiment supprimer ce pilote ?")) {
        fetch(`${BASE_URL}api/pilote/delete/${piloteId}`, {
          method: "DELETE"
        })
        .then(response => response.json())
        .then(data => {
          showNotification(data.message, data.success ? "success" : "error");
          if (data.success) {
            setTimeout(() => {
              location.reload();
            }, 1000);
          }
        })
        .catch(error => {
          console.error("Erreur de suppression :", error);
          showNotification("Une erreur s'est produite.", "error");
        });
      }
    });
  });

  // GESTION DU FORMULAIRE DE CREATION
  const createPiloteForm = document.getElementById("create-pilote-form");
  if (createPiloteForm) {
    createPiloteForm.addEventListener("submit", function(event) {
      event.preventDefault();
      const formData = new FormData(this);
      fetch(`${BASE_URL}api/pilote/create`, {
        method: "POST",
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        showNotification(data.message, data.success ? "success" : "error");
        if (data.success) {
          setTimeout(() => {
            location.reload();
          }, 1000);
        }
      })
      .catch(error => {
        console.error("Erreur lors de la création :", error);
        showNotification("Une erreur s'est produite.", "error");
      });
    });
  }
});
