document.addEventListener("DOMContentLoaded", function () {
  const statusMapping = {
    "0": {label: "En Attente", class: "pending"},
    "1": {label: "Acceptée", class: "accepted"},
    "2": {label: "Refusée", class: "refused"}
  };

  function updateStatusInDatabase(candidatureId, status) {
    // Debug - Afficher les valeurs envoyées
    console.log('Envoi de la requête:', {
      candidatureId: candidatureId,
      status: status,
      url: `${BASE_URL}index.php?controller=candidature&action=updateStatus`
    });

    fetch(`${BASE_URL}index.php?controller=candidature&action=updateStatus`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `candidature_id=${candidatureId}&statut=${status}`
    })
    .then(response => {
      // Debug - Afficher la réponse brute
      console.log('Réponse brute:', response);
      return response.json();
    })
    .then(data => {
      // Debug - Afficher les données de réponse
      console.log('Données reçues:', data);
      
      if (data.success) {
        showNotification('Statut mis à jour avec succès', 'success');
      } else {
        showNotification(data.message || 'Erreur lors de la mise à jour du statut', 'error');
      }
    })
    .catch(error => {
      console.error('Erreur:', error);
      showNotification('Erreur lors de la mise à jour du statut', 'error');
    });
  }

  function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
      notification.remove();
    }, 3000);
  }

  document.querySelectorAll("tbody tr").forEach(function (row) {
    const statusCell = row.querySelector("td.status");
    if (statusCell) {
      statusCell.addEventListener("click", function (e) {
        document.querySelectorAll(".status-options").forEach(menu => menu.remove());
        const key = row.dataset.id;
        const optionsBox = document.createElement("div");
        optionsBox.classList.add("status-options");

        // Créer les boutons de statut
        Object.entries(statusMapping).forEach(([value, {label, class: statusClass}]) => {
          const btn = document.createElement("button");
          btn.textContent = label;
          btn.classList.add("status-btn", statusClass);
          btn.addEventListener("click", function (e) {
            e.stopPropagation();
            statusCell.textContent = label;
            statusCell.className = `status ${statusClass}`;
            updateStatusInDatabase(key, value);
            optionsBox.remove();
          });
          optionsBox.appendChild(btn);
        });

        statusCell.appendChild(optionsBox);
        e.stopPropagation();
      });
    }
  });

  document.addEventListener("click", function (e) {
    if (!e.target.classList.contains("status-btn")) {
      document.querySelectorAll(".status-options").forEach(menu => menu.remove());
    }
  });
});