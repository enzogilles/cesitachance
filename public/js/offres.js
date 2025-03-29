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
      window.location.href = BASE_URL + "index.php?controller=offre&action=index";
    });
  }

  const urlParams = new URLSearchParams(window.location.search);
  const notif = urlParams.get("notif");

  if (notif === "1") {
    showNotification("🔍 Résultat(s) de la recherche affiché(s)", "info", 5000);
  }
});
