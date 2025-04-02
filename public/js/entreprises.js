document.addEventListener("DOMContentLoaded", function () {
  // Sélection du formulaire de recherche et de la liste d'entreprises
  const searchForm = document.querySelector(".search-form");
  const entreprisesList = document.getElementById("entreprises-list");

<<<<<<< Updated upstream
  // Gestion de la soumission du formulaire de recherche
  searchForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // Affichage de la notification de recherche
    document.querySelectorAll(".notification.info").forEach(notification => notification.remove());
    const notification = document.createElement("div");
    // Correction : retirer le point dans le className
    notification.className = "notification info";
    notification.textContent = "🔍 Recherche d'entreprise en cours...";

        // Positionnement de la notification en haut de la page
        notification.style.position = "fixed";
        notification.style.top = "130px";
        notification.style.left = "40%";
        notification.style.transform = "translateX(-50%)";
        notification.style.zIndex = "1000";
    
=======
  if (notif === "updated") {
    showNotification("✅ Entreprise modifiée avec succès", "success", 4000);
  } else if (notif === "created") {
    showNotification("✅ Entreprise créée avec succès", "success", 4000);
  } else if (notif === "deleted") {
    showNotification("🗑️ Entreprise supprimée avec succès", "success", 4000);
  }

  if (notif) {
    url.searchParams.delete("notif");
    window.history.replaceState({}, "", url.toString());
  }

  function showNotification(message, type = "info", duration = 3000) {
    document.querySelectorAll(".notification").forEach(notification => notification.remove());
    const notification = document.createElement("div");
    notification.className = `notification ${type}`;
    notification.textContent = message;
>>>>>>> Stashed changes
    document.body.appendChild(notification);

    // Suppression automatique de la notification après 3 secondes
    setTimeout(() => {
      notification.remove();
    }, 3000);

<<<<<<< Updated upstream
    // Récupération de la valeur saisie
    const searchValue = document.getElementById("recherche").value.trim().toLowerCase();

    // Appel à l'API pour récupérer les entreprises correspondant à la recherche
    fetch(`../api/get_entreprises.php?search=${encodeURIComponent(searchValue)}`)
      .then(response => response.json())
      .then(entreprises => {
        // Réinitialiser le contenu de la liste
        entreprisesList.innerHTML = "";

        // S'il n'y a aucun résultat, afficher un message
        if (entreprises.length === 0) {
          entreprisesList.innerHTML = "<p style='text-align: center; color: #777;'>Aucune entreprise trouvée.</p>";
          return;
        }

        // Pour chaque entreprise, créer un élément de liste
        entreprises.forEach(entreprise => {
          const listItem = document.createElement("li");
          listItem.setAttribute("data-id", entreprise.id);
          listItem.textContent = `${entreprise.nom} - ${entreprise.ville}`;
          entreprisesList.appendChild(listItem);
        });
      })
      .catch(error => console.error("Erreur lors du chargement des entreprises :", error));
  });

  // Gestion du clic sur un élément de la liste pour afficher les détails de l'entreprise
  entreprisesList.addEventListener("click", function (e) {
    if (e.target.tagName === "LI") {
      const entrepriseId = e.target.getAttribute("data-id");

      fetch(`../api/get_entreprise_details.php?id=${entrepriseId}`)
        .then(response => response.json())
        .then(details => {
          // Mise à jour des éléments de détail dans la page
          document.getElementById("detail-nom").textContent = details.nom;
          document.getElementById("detail-secteur").textContent = details.secteur;
          document.getElementById("detail-ville").textContent = details.ville;
          document.getElementById("detail-nb-stagiaires").textContent = details.nb_stagiaires || "0";
          document.getElementById("detail-moy-eval").textContent = details.moyenne_eval || "Aucune";
        })
        .catch(error => console.error("Erreur lors du chargement des détails de l'entreprise :", error));
    }
});
=======
  // Confirmation de suppression
  document.querySelectorAll('.btn-supprimer').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const id = this.getAttribute("data-id");
      showCustomConfirm("Voulez-vous vraiment supprimer cette entreprise ?", () => {
        window.location.href = BASE_URL + "entreprise/supprimer/" + id;
      });
    });
  });

  function showCustomConfirm(message, onConfirm) {
    // Supprimer tout confirm box existant
    document.querySelectorAll('.custom-confirm').forEach(el => el.remove());
    
    // Créer la boîte de confirmation
    const confirmBox = document.createElement('div');
    confirmBox.className = 'custom-confirm';
    
    const messageEl = document.createElement('p');
    messageEl.textContent = message;
    
    const buttonContainer = document.createElement('div');
    buttonContainer.className = 'confirm-buttons';
    
    const confirmBtn = document.createElement('button');
    confirmBtn.className = 'btn-confirm';
    confirmBtn.textContent = 'Confirmer';
    confirmBtn.addEventListener('click', () => {
      confirmBox.remove();
      onConfirm();
    });
    
    const cancelBtn = document.createElement('button');
    cancelBtn.className = 'btn-cancel';
    cancelBtn.textContent = 'Annuler';
    cancelBtn.addEventListener('click', () => {
      confirmBox.remove();
    });
    
    buttonContainer.appendChild(confirmBtn);
    buttonContainer.appendChild(cancelBtn);
    confirmBox.appendChild(messageEl);
    confirmBox.appendChild(buttonContainer);
    document.body.appendChild(confirmBox);
  }
>>>>>>> Stashed changes
});
