document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById("add-offer-form");
  
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Récupération des valeurs du formulaire
      const titre = document.getElementById("titre").value.trim();
      const description = document.getElementById("description").value.trim();
      const entreprise = document.getElementById("entreprise").value.trim();
      const remuneration = document.getElementById("remuneration").value.trim();
      const dateDebut = document.getElementById("date-debut").value;
      const dateFin = document.getElementById("date-fin").value;
      
      // Vérification des champs obligatoires
      if (!titre || !description || !entreprise || !remuneration || !dateDebut || !dateFin) {
        showNotification("⚠️ Veuillez remplir tous les champs.", "error");
        return;
      }
      
      // Si vous utilisez AJAX pour soumettre le formulaire
      const formData = new FormData(form);
      
      fetch(form.action, {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Erreur réseau');
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          showNotification("✅ Offre ajoutée avec succès !", "success");
          form.reset();
          
          // Utiliser BASE_URL pour la redirection - défini dans la vue
          setTimeout(() => {
            window.location.href = BASE_URL + "offre/index";
          }, 2000);
        } else {
          showNotification("⚠️ " + (data.message || "Erreur lors de l'ajout de l'offre"), "error");
        }
      })
      .catch(error => {
        console.error("Erreur:", error);
        showNotification("❌ Une erreur est survenue lors de l'ajout de l'offre", "error");
      });
    });
  }
});

function showNotification(message, type = "info") {
  // Supprime les notifications existantes
  document.querySelectorAll(".notification").forEach(n => n.remove());

  const notification = document.createElement("div");
  notification.className = `notification ${type}`;
  notification.textContent = message;
  
  // Styles communs - CORRECTION DU CENTRAGE
  notification.style.position = "fixed";
  notification.style.left = "50%"; // Centre horizontal (milieu de l'écran)
  notification.style.transform = "translateX(-50%)"; // Décalage de moitié de sa propre largeur
  notification.style.zIndex = "9999";
  notification.style.padding = "15px 25px";
  notification.style.borderRadius = "8px";
  notification.style.fontWeight = "bold";
  notification.style.boxShadow = "0 4px 12px rgba(0,0,0,0.1)";
  notification.style.maxWidth = "400px";
  notification.style.textAlign = "center";

  // Positionne la notification en haut pour tous les types
  notification.style.top = "20px";
  
  // Couleurs par type
  if (type === "error") {
    notification.style.backgroundColor = "#fee2e2";
    notification.style.color = "#991b1b";
  } else if (type === "success") {
    notification.style.backgroundColor = "#d1fae5";
    notification.style.color = "#065f46";
  } else {
    notification.style.backgroundColor = "#dbeafe";
    notification.style.color = "#1e3a8a";
  }
  
  document.body.appendChild(notification);

  // Animation de fade out
  setTimeout(() => {
    notification.style.opacity = "0";
    notification.style.transition = "opacity 0.5s ease";
    setTimeout(() => {
      notification.remove();
    }, 500);
  }, 2500);
}
