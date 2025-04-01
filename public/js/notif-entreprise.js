document.addEventListener('DOMContentLoaded', function () {
    const url = new URL(window.location.href);
    const notif = url.searchParams.get("notif");

    if (notif === "updated") {
        showNotification("✅ Entreprise modifiée avec succès", "success", 4000);
    } else if (notif === "created") {
        showNotification("✅ Entreprise créée avec succès", "success", 4000);
    } else if (notif === "deleted") {
        showNotification("🗑️ Entreprise supprimée", "success", 4000);
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
        notification.style.top = "100px";
        notification.style.left = "50%";
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
