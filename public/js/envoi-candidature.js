
document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const success = urlParams.get("success");

  if (success === "1") {
    const notif = document.createElement("div");
    notif.className = "notification success";
    notif.textContent = "✅ Candidature envoyée avec succès !";
    notif.style.position = "fixed";
    notif.style.top = "100px";
    notif.style.left = "37%";
    notif.style.transform = "translateX(-50%)";
    notif.style.backgroundColor = "#d1fae5";
    notif.style.color = "#065f46";
    notif.style.padding = "15px 25px";
    notif.style.borderRadius = "8px";
    notif.style.fontWeight = "bold";
    notif.style.boxShadow = "0 4px 12px rgba(0,0,0,0.1)";
    notif.style.zIndex = "9999";
    notif.style.transition = "opacity 0.3s ease";

    document.body.appendChild(notif);

    setTimeout(() => {
      notif.style.opacity = "0";
      setTimeout(() => notif.remove(), 500);
    }, 4000);

    // Nettoyer l'URL
    urlParams.delete("success");
    const newUrl = window.location.pathname + "?" + urlParams.toString();
    window.history.replaceState({}, "", newUrl);
  }
});
