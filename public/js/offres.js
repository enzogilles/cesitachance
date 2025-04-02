document.addEventListener("DOMContentLoaded", function () {
  const searchForm = document.querySelector(".search-form");
  const resetButton = document.querySelector(".search-form .bouton-reset");

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
    document.body.appendChild(notification);
    setTimeout(() => {
      notification.remove();
    }, duration);
  }

  if (resetButton) {
    resetButton.addEventListener("click", function (e) {
      e.preventDefault();
      window.location.href = BASE_URL + "offre/index";
    });
  }

  const urlParams = new URLSearchParams(window.location.search);
  const notif = urlParams.get("notif");

  if (notif === "1") {
    showNotification("🔍 Résultat(s) de la recherche affiché(s)", "info", 5000);
  }
});

document.getElementById('cv').addEventListener('change', function() {
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

document.getElementById('remove-cv').addEventListener('click', function() {
  const cvInput = document.getElementById('cv');
  const fileNameLabel = document.getElementById('cv-label');
  cvInput.value = '';
  fileNameLabel.textContent = '';
  this.style.display = 'none';
});

document.querySelector('.reset-btn').addEventListener('click', function() {
  const cvInput = document.getElementById('cv');
  const fileNameLabel = document.getElementById('cv-label');
  const removeButton = document.getElementById('remove-cv');
  cvInput.value = '';
  fileNameLabel.textContent = '';
  removeButton.style.display = 'none';
});
