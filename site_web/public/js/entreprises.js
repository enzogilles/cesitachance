document.addEventListener("DOMContentLoaded", function () {
  // Sélection du formulaire de recherche et de la liste d'entreprises
  const searchForm = document.querySelector(".search-form");
  const entreprisesList = document.getElementById("entreprises-list");

  // Gestion de la soumission du formulaire de recherche
  searchForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // Affichage de la notification de recherche d'entreprise
    document.querySelectorAll(".notification.info").forEach(notification => notification.remove());
    const notification = document.createElement("div");
    notification.className = "notification info";
    notification.textContent = "🔍 Recherche d'entreprise en cours...";
    notification.style.position = "fixed";
    notification.style.top = "130px";
    notification.style.left = "40%";
    notification.style.transform = "translateX(-50%)";
    notification.style.zIndex = "1000";
    document.body.appendChild(notification);

    // Requête AJAX pour récupérer les offres filtrées
    fetch(`index.php?controller=offre&action=search&motcle=${encodeURIComponent(motcle)}`)
      .then(response => response.text()) // Récupération du HTML généré par PHP
      .then(html => {
        offresContainer.innerHTML = html; // Mise à jour de la liste des offres

        // Supprimer la notification après le chargement des résultats
        setTimeout(() => {
          notification.remove();

          const resultNotification = document.createElement("div");
          resultNotification.className = "notification info";
          resultNotification.textContent = "🔎 Recherche terminée.";
          document.body.appendChild(resultNotification);

          setTimeout(() => {
            resultNotification.remove();
          }, 3000);
        }, 1000);
      })
      .catch(error => {
        console.error("Erreur lors du chargement des offres :", error);
        notification.remove();
      });
  });

  // Suppression automatique de la notification après 3 secondes
  setTimeout(() => {
    notification.remove();
  }, 3000);

  // Récupération de la valeur saisie
  const searchValue = document.getElementById("recherche").value.trim().toLowerCase();

  // Appel à l'API pour récupérer les entreprises correspondant à la recherche
  fetch(`../api/get_entreprises.php?search=${encodeURIComponent(searchValue)}`)
    .then(response => response.json())
    .then(entreprises => {
      entreprisesList.innerHTML = "";
      if (entreprises.length === 0) {
        entreprisesList.innerHTML = "<p style='text-align: center; color: #777;'>Aucune entreprise trouvée.</p>";
        return;
      }
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
        document.getElementById("detail-nom").textContent = details.nom;
        document.getElementById("detail-secteur").textContent = details.secteur;
        document.getElementById("detail-ville").textContent = details.ville;
        document.getElementById("detail-nb-stagiaires").textContent = details.nb_stagiaires || "0";
        document.getElementById("detail-moy-eval").textContent = details.moyenne_eval || "Aucune";
      })
      .catch(error => console.error("Erreur lors du chargement des détails de l'entreprise :", error));
  }
});

// Recherche d'offres
searchForm.addEventListener("submit", function (e) {
  e.preventDefault();

  document.querySelectorAll(".notification.info").forEach(notification => notification.remove());
  const searchingNotification = document.createElement("div");
  searchingNotification.className = "notification info";
  searchingNotification.textContent = "🔍 Recherche d'offres en cours...";
  document.body.appendChild(searchingNotification);

  const searchTerm = document.getElementById("motcle").value.trim().toLowerCase();
  const offers = document.querySelectorAll(".offer-card");
  let foundCount = 0;

  offers.forEach(offer => {
    const offerText = offer.textContent.toLowerCase();
    if (offerText.includes(searchTerm)) {
      offer.style.display = "";
      foundCount++;
    } else {
      offer.style.display = "none";
    }
  });

  setTimeout(() => {
    searchingNotification.remove();
    const resultNotification = document.createElement("div");
    resultNotification.className = "notification info";
    resultNotification.textContent = foundCount === 0
      ? "Aucune offre ne correspond à la recherche."
      : foundCount + " offre(s) correspond(ent) à la recherche.";
    document.body.appendChild(resultNotification);
    setTimeout(() => {
      resultNotification.remove();
    }, 3000);
  }, 1500);
});

// Réinitialisation de la recherche : afficher toutes les offres
searchForm.addEventListener("reset", function () {
  const offers = document.querySelectorAll(".offer-card");
  offers.forEach(offer => {
    offer.style.display = "";
  });
  document.querySelectorAll(".notification.info").forEach(notification => notification.remove());
});

document.addEventListener("DOMContentLoaded", function () {
  const resetButton = document.querySelector(".search-form button[type='reset']");
  const searchInput = document.getElementById("motcle");

  resetButton.addEventListener("click", function () {
      searchInput.value = ""; // Efface le champ manuellement
  });
});
