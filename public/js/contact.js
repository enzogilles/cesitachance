document.addEventListener('DOMContentLoaded', function () {
    const url = new URL(window.location.href);
    const notif = url.searchParams.get("notif");

    // Si on revient de l'envoi du formulaire avec succès
    if (notif === "sent") {
        showNotification("✅ Message envoyé avec succès !", "success");
        url.searchParams.delete("notif");
        window.history.replaceState({}, "", url.toString());
    }

    const form = document.getElementById("contact-form");

    if (form) {
        form.addEventListener('submit', function (e) {
            const nom = document.getElementById("nom").value.trim();
            const email = document.getElementById("email").value.trim();
            const message = document.getElementById("message").value.trim();

            if (!nom || !email || !message) {
                e.preventDefault(); // Empêche l'envoi si champ vide
                showNotification("⚠️ Veuillez remplir tous les champs.", "error");
                return;
            }

            // Le formulaire sera soumis normalement (POST)
            // La notification sera affichée après redirection via l’URL ?notif=sent
        });
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
