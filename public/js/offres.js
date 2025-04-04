document.addEventListener("DOMContentLoaded", function () {
  const searchForm = document.querySelector(".search-form");
  const resetButton = document.querySelector(".search-form .bouton-reset");
  const urlParams = new URLSearchParams(window.location.search);

  // === NOTIFICATION GLOBALE ===
  function showNotification(message, type = "info", duration = 3000) {
    document.querySelectorAll(".notification").forEach(n => n.remove());

    const notification = document.createElement("div");
    notification.className = "notification " + type;
    notification.textContent = message;
    notification.style.position = "fixed";
    notification.style.top = "130px";
    notification.style.left = "37%";
    notification.style.transform = "translateX(-50%)";
    notification.style.zIndex = "1000";
    notification.style.backgroundColor = type === "error" ? "#fee2e2" : "#dbeafe";
    notification.style.color = type === "error" ? "#991b1b" : "#1e3a8a";
    notification.style.padding = "15px 25px";
    notification.style.borderRadius = "8px";
    notification.style.fontWeight = "bold";
    notification.style.boxShadow = "0 4px 12px rgba(0,0,0,0.1)";
    notification.style.opacity = "1";
    document.body.appendChild(notification);

    setTimeout(() => {
      notification.style.opacity = "0";
      setTimeout(() => notification.remove(), 500);
    }, duration);
  }

  // === BOUTON RÉINITIALISER DE LA BARRE DE RECHERCHE ===
  if (resetButton && searchForm && searchForm.action.includes("/offre/search")) {
    resetButton.addEventListener("click", function (e) {
      e.preventDefault();
      window.location.href = BASE_URL + "offre/index";
    });
  }

  // === NOTIF DE RECHERCHE ===
  const notif = urlParams.get("notif");
  if (notif === "1") {
    showNotification("🔍 Résultat(s) de la recherche affiché(s)", "info", 5000);
  }

  // === GESTION DU CV ===
  const cvInput = document.getElementById('cv');
  const fileNameLabel = document.getElementById('cv-label');
  const removeButton = document.getElementById('remove-cv');

  if (cvInput && fileNameLabel && removeButton) {
    cvInput.addEventListener('change', function () {
      if (this.files.length > 0) {
        fileNameLabel.textContent = this.files[0].name;
        removeButton.style.display = 'inline-block';
      } else {
        fileNameLabel.textContent = '';
        removeButton.style.display = 'none';
      }
    });

    removeButton.addEventListener('click', function () {
      cvInput.value = '';
      fileNameLabel.textContent = '';
      this.style.display = 'none';
    });

    const resetBtn = document.querySelector('.reset-btn');
    if (resetBtn) {
      resetBtn.addEventListener('click', function () {
        cvInput.value = '';
        fileNameLabel.textContent = '';
        removeButton.style.display = 'none';
      });
    }
  }

  // === VALIDATION DU FORMULAIRE DE POSTULATION ===
  const postulerForm = document.getElementById("postuler-form");
  if (postulerForm && cvInput) {
    postulerForm.addEventListener("submit", function (e) {
    });
  }
});
