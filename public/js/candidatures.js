document.addEventListener("DOMContentLoaded", function () {
  // =====================================
  // Gestion des statuts des candidatures
  // =====================================
  const statusLabels = {
    "Accepted": "Acceptée",
    "Pending": "En Attente",
    "Rejected": "Refusée"
  };

  const statusClasses = {
    "Accepted": "accepted",
    "Pending": "pending",
    "Rejected": "refused"
  };

  // Charge les statuts sauvegardés dans le localStorage pour les candidatures
  function loadStatuses() {
    const savedStatuses = JSON.parse(localStorage.getItem("candidatures")) || {};
    document.querySelectorAll("tbody tr").forEach(function (row) {
      const key = row.dataset.id;
      const statusCell = row.querySelector("td.status");
      if (savedStatuses[key] && statusLabels[savedStatuses[key]]) {
        statusCell.textContent = statusLabels[savedStatuses[key]];
        statusCell.className = "status " + statusClasses[savedStatuses[key]];
      }
      // Sinon, on conserve le statut rendu par Twig
    });
  }

  // Sauvegarde le statut d'une candidature dans le localStorage
  function saveStatus(key, status) {
    let savedStatuses = JSON.parse(localStorage.getItem("candidatures")) || {};
    savedStatuses[key] = status;
    localStorage.setItem("candidatures", JSON.stringify(savedStatuses));
  }

  // Ajoute un écouteur sur chaque cellule de statut pour permettre la modification
  document.querySelectorAll("tbody tr").forEach(function (row) {
    const statusCell = row.querySelector("td.status");
    if (statusCell) {
      statusCell.addEventListener("click", function (e) {
        // Supprime les éventuels menus déjà ouverts
        document.querySelectorAll(".status-options").forEach(menu => menu.remove());
        const key = row.dataset.id;
        const optionsBox = document.createElement("div");
        optionsBox.classList.add("status-options");

        // Crée un bouton pour chaque option de statut
        Object.keys(statusLabels).forEach(function (statusKey) {
          const btn = document.createElement("button");
          btn.textContent = statusLabels[statusKey];
          btn.classList.add("status-btn", statusClasses[statusKey]);
          btn.addEventListener("click", function (e) {
            e.stopPropagation(); // Empêche la propagation pour fermer le menu immédiatement
            // Met à jour le statut affiché et sauvegarde la sélection
            statusCell.textContent = statusLabels[statusKey];
            statusCell.className = "status " + statusClasses[statusKey];
            saveStatus(key, statusKey);
            // Ferme le menu immédiatement
            optionsBox.remove();
          });
          optionsBox.appendChild(btn);
        });

        // Affiche le menu dans la cellule de statut
        statusCell.appendChild(optionsBox);
        e.stopPropagation();
      });
    }
  });

  // Ferme les menus d'options si l'utilisateur clique en dehors
  document.addEventListener("click", function (e) {
    if (!e.target.classList.contains("status-btn")) {
      document.querySelectorAll(".status-options").forEach(menu => menu.remove());
    }
  });

  loadStatuses();

});
