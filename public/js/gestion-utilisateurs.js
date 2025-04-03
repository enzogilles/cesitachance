document.addEventListener('DOMContentLoaded', function () {
  const url = new URL(window.location.href);
  const notif = url.searchParams.get("notif");

  if (notif === "updated") {
    showNotification("✅ Utilisateur modifié avec succès", "success", 4000);
  } else if (notif === "created") {
    showNotification("✅ Utilisateur créé avec succès", "success", 4000);
  } else if (notif === "deleted") {
    showNotification("🗑️ Utilisateur supprimé", "success", 4000);
  } else if (notif === "password_updated") {
    showNotification("🔑 Mot de passe modifié avec succès", "success", 4000);
  } else if (notif === "1") {
    showNotification("🔍 Résultat(s) de la recherche affiché(s)", "info", 5000);
  } else if (notif === "error") {
    showNotification("❌ Une erreur est survenue", "error", 4000);
  }

  // Nettoyage de l'URL
  if (notif) {
    url.searchParams.delete("notif");
    window.history.replaceState({}, "", url.toString());
  }

  function showNotification(message, type = "info", duration = 3000) {
    document.querySelectorAll(".notification").forEach(n => n.remove());

    const notification = document.createElement("div");
    notification.className = `notification ${type}`;
    notification.textContent = message;
    notification.style.position = "fixed";
    notification.style.top = "120px";
    notification.style.left = "37%";
    notification.style.transform = "translateX(-50%)";
    notification.style.zIndex = "1000";
    notification.style.padding = "12px 24px";
    notification.style.borderRadius = "8px";
    notification.style.fontWeight = "600";

    switch (type) {
      case "success":
        notification.style.backgroundColor = "#d1fae5";
        notification.style.color = "#065f46";
        break;
      case "error":
        notification.style.backgroundColor = "#fee2e2";
        notification.style.color = "#991b1b";
        break;
      default:
        notification.style.backgroundColor = "#dbeafe";
        notification.style.color = "#1e3a8a";
        break;
    }

    document.body.appendChild(notification);
    setTimeout(() => {
      notification.remove();
    }, duration);
  }
});