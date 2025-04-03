document.addEventListener("DOMContentLoaded", function () {
  // Ne pas initialiser si l'utilisateur n'est pas admin
  if (!document.querySelector('.candidatures-table')) return;

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

  function updateCandidatureStatus(candidatureId, newStatus) {
    return fetch(`${BASE_URL}index.php?controller=candidature&action=updateStatus`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `candidature_id=${candidatureId}&statut=${newStatus}`
    })
    .then(response => response.ok)
    .catch(error => {
      console.error('Erreur:', error);
      return false;
    });
  }

  function handleStatusClick(statusCell, row) {
    // Supprimer tous les menus ouverts
    document.querySelectorAll(".status-options").forEach(menu => menu.remove());

    const optionsBox = document.createElement("div");
    optionsBox.classList.add("status-options");

    Object.entries(statusLabels).forEach(([statusKey, label]) => {
      const btn = document.createElement("button");
      btn.textContent = label;
      btn.classList.add("status-btn", statusClasses[statusKey]);
      
      btn.addEventListener("click", async (e) => {
        e.stopPropagation();
        const success = await updateCandidatureStatus(row.dataset.id, statusKey);
        
        if (success) {
          statusCell.textContent = label;
          statusCell.className = `status ${statusClasses[statusKey]}`;
        }
        
        optionsBox.remove();
      });
      
      optionsBox.appendChild(btn);
    });

    statusCell.appendChild(optionsBox);
  }

  // Gestion des clics sur les statuts
  document.querySelectorAll("tbody tr").forEach(row => {
    const statusCell = row.querySelector("td.status");
    if (statusCell) {
      statusCell.addEventListener("click", (e) => {
        e.stopPropagation();
        handleStatusClick(statusCell, row);
      });
    }
  });

  // Fermer le menu au clic ailleurs
  document.addEventListener("click", function(e) {
    if (!e.target.closest('.status, .status-options')) {
      document.querySelectorAll(".status-options").forEach(menu => menu.remove());
    }
  });
});