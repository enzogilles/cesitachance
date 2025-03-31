document.addEventListener("DOMContentLoaded", function () {
  // Sélectionne le formulaire et le bouton reset
  const searchForm = document.querySelector(".search-form");
  const resetButton = document.querySelector(".search-form .bouton-reset");

  // Fonction utilitaire pour afficher une notification
  function showNotification(message, type = "info", duration = 3000) {
    // On supprime d’abord d’éventuelles notifications existantes
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
      window.location.href = BASE_URL + "index.php?controller=gestionutilisateurs&action=index";
    });
  }

  // Afficher la notification si l'URL contient ?notif=1
  const currentUrl = new URL(window.location.href);
  const notif = currentUrl.searchParams.get("notif");

  if (notif === "1") {
    showNotification("🔍 Résultat de la recherche affiché", "info", 5000);

    currentUrl.searchParams.delete("notif")
    window.history.replaceState({}, "", currentUrl.toString());
  }
});
