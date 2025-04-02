document.addEventListener("DOMContentLoaded", function () {
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

  const tbody = document.querySelector("tbody");
  if (tbody) {
    tbody.style.visibility = "hidden"; // Cache temporairement les lignes du tableau
  }

  // Charge les statuts sauvegardés dans le localStorage pour les candidatures
  function loadStatuses() {
    const savedStatuses = JSON.parse(localStorage.getItem("candidatures")) || {};
    document.querySelectorAll("tbody tr").forEach(function (row) {
      const key = row.dataset.id;
      const statusCell = row.querySelector("td.status");
      if (key && statusCell && savedStatuses[key] && statusLabels[savedStatuses[key]]) {
        statusCell.textContent = statusLabels[savedStatuses[key]];
        statusCell.className = "status " + statusClasses[savedStatuses[key]];
      }
    });

    if (tbody) {
      tbody.style.visibility = "visible"; // Affiche le tableau une fois prêt
    }
  }

  function saveStatus(key, status) {
    let savedStatuses = JSON.parse(localStorage.getItem("candidatures")) || {};
    savedStatuses[key] = status;
    localStorage.setItem("candidatures", JSON.stringify(savedStatuses));
  }

  document.querySelectorAll("tbody tr").forEach(function (row) {
    const statusCell = row.querySelector("td.status");
    if (statusCell) {
      statusCell.addEventListener("click", function (e) {
        document.querySelectorAll(".status-options").forEach(menu => menu.remove());
        const key = row.dataset.id;
        const optionsBox = document.createElement("div");
        optionsBox.classList.add("status-options");

        Object.keys(statusLabels).forEach(function (statusKey) {
          const btn = document.createElement("button");
          btn.textContent = statusLabels[statusKey];
          btn.classList.add("status-btn", statusClasses[statusKey]);
          btn.addEventListener("click", function (e) {
            e.stopPropagation();
            statusCell.textContent = statusLabels[statusKey];
            statusCell.className = "status " + statusClasses[statusKey];
            saveStatus(key, statusKey);
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

  loadStatuses();
});
