document.addEventListener("DOMContentLoaded", function () {
<<<<<<< Updated upstream
    // Fonction utilitaire : Affichage des notifications
    function showNotification(message, type = "info") {
      document.querySelectorAll(".notification").forEach(n => n.remove());
      const notification = document.createElement("div");
      notification.className = "notification " + type;
      notification.textContent = message;
      notification.style.position = "fixed";
      notification.style.top = "130px";
      notification.style.left = "50%";
      notification.style.transform = "translateX(-50%)";
      notification.style.zIndex = "1000";
      document.body.appendChild(notification);
      setTimeout(() => {
        notification.remove();
      }, 3000);
    }
  
    // Gestion de la recherche d'offres
    const searchForm = document.querySelector(".search-form");
    const offresContainer = document.querySelector(".offers-container");
  
    if (searchForm && offresContainer) {
      searchForm.addEventListener("submit", function (e) {
        e.preventDefault();
  
        // Affichage de la notification de recherche
        showNotification("🔍 Recherche d'offres en cours...");
  
        // Récupération de la valeur saisie dans l'input "motcle"
        const keyword = document.getElementById("motcle").value.trim().toLowerCase();
  
        // Appel à l'API pour récupérer les offres correspondantes
        fetch(`../api/get_offres.php?search=${encodeURIComponent(keyword)}`)
          .then(response => response.json())
          .then(offres => {
            // Réinitialisation du conteneur d'offres
            offresContainer.innerHTML = "";
            
            if (offres.length === 0) {
              offresContainer.innerHTML = "<p style='text-align: center; color: #777;'>Aucune offre correspondante.</p>";
              return;
            }
            
            // Pour chaque offre, créer une carte d'offre
            offres.forEach(offre => {
              const offerCard = document.createElement("div");
              offerCard.classList.add("offer-card");
              
              offerCard.innerHTML = `
                <h4>${offre.titre} - ${offre.entreprise}</h4>
                <p><strong>Rémunération :</strong> ${offre.remuneration}€</p>
                <div class="offer-buttons">
                  <a href="offre-detail.php?id=${offre.id}" class="btn-voir">Voir</a>
                  <button class="btn btn-add-wishlist" data-title="${offre.titre}" data-id="${offre.id}">Ajouter à la wishlist</button>
                </div>
              `;
              offresContainer.appendChild(offerCard);
            });
          })
          .catch(error => console.error("Erreur lors du chargement des offres :", error));
      });
    }
  });
=======
  const searchForm = document.querySelector(".search-form");
  const resetButton = document.querySelector(".search-form .bouton-reset");

  function showNotification(message, type = "info", duration = 3000) {
    document.querySelectorAll(".notification").forEach(n => n.remove());
    
    const notification = document.createElement("div");
    notification.className = "notification " + type;
    notification.textContent = message;
    notification.style.position = "fixed";
    notification.style.top = "130px";
    notification.style.left = "50%"; // Centré correctement
    notification.style.transform = "translateX(-50%)";
    notification.style.zIndex = "1000";
    notification.style.padding = "12px 24px";
    notification.style.borderRadius = "8px";
    notification.style.fontWeight = "600";
    notification.style.boxShadow = "0 4px 12px rgba(0,0,0,0.1)";
    
    // Couleurs par type
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
  }

  if (resetButton) {
    resetButton.addEventListener("click", function (e) {
      e.preventDefault();
      // URL mise à jour pour utiliser les URLs propres
      window.location.href = BASE_URL + "offre/index";
    });
  }

  // Gestion des notifications via URL ou query parameters
  const url = new URL(window.location.href);
  const notif = url.searchParams.get("notif");

  if (notif === "1") {
    showNotification("🔍 Résultat(s) de la recherche affiché(s)", "info", 5000);
    // Nettoyer l'URL après avoir affiché la notification
    url.searchParams.delete("notif");
    window.history.replaceState({}, "", url.toString());
  } else if (notif === "created") {
    showNotification("✅ Offre créée avec succès", "success", 5000);
    url.searchParams.delete("notif");
    window.history.replaceState({}, "", url.toString());
  } else if (notif === "updated") {
    showNotification("✅ Offre mise à jour avec succès", "success", 5000);
    url.searchParams.delete("notif");
    window.history.replaceState({}, "", url.toString());
  } else if (notif === "postuler") {
    showNotification("✅ Candidature envoyée avec succès", "success", 5000);
    url.searchParams.delete("notif");
    window.history.replaceState({}, "", url.toString());
  }

  // Gestion du fichier CV
  const cvInput = document.getElementById('cv');
  if (cvInput) {
    cvInput.addEventListener('change', function() {
      const removeButton = document.getElementById('remove-cv');
      const fileNameLabel = document.getElementById('cv-label');
      if (this.files.length > 0) {
        fileNameLabel.textContent = this.files[0].name;
        removeButton.style.display = 'inline-block';
      } else {
        fileNameLabel.textContent = '';
        removeButton.style.display = 'none';
      }
    });
  }

  const removeButton = document.getElementById('remove-cv');
  if (removeButton) {
    removeButton.addEventListener('click', function() {
      const cvInput = document.getElementById('cv');
      const fileNameLabel = document.getElementById('cv-label');
      cvInput.value = '';
      fileNameLabel.textContent = '';
      this.style.display = 'none';
    });
  }

  const resetBtn = document.querySelector('.reset-btn');
  if (resetBtn) {
    resetBtn.addEventListener('click', function() {
      const cvInput = document.getElementById('cv');
      const fileNameLabel = document.getElementById('cv-label');
      const removeButton = document.getElementById('remove-cv');
      if (cvInput && fileNameLabel && removeButton) {
        cvInput.value = '';
        fileNameLabel.textContent = '';
        removeButton.style.display = 'none';
      }
    });
  }
});
>>>>>>> Stashed changes
