document.addEventListener("DOMContentLoaded", function () {
  // Validation des fichiers
  const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB
  const ALLOWED_TYPES = ['application/pdf'];

  function validateFile(file) {
    if (!file) {
      showNotification("Veuillez sélectionner un CV", "error");
      return false;
    }

    if (file.size > MAX_FILE_SIZE) {
      showNotification("Le fichier est trop volumineux (maximum 5MB)", "error");
      return false;
    }

    if (!ALLOWED_TYPES.includes(file.type)) {
      showNotification("Seuls les fichiers PDF sont acceptés", "error");
      return false;
    }

    return true;
  }

  function showNotification(message, type) {
    const notif = document.createElement("div");
    notif.className = `notification ${type}`;
    notif.textContent = message;
    notif.style.position = "fixed";
    notif.style.top = "100px";
    notif.style.left = "37%";
    notif.style.transform = "translateX(-50%)";
    notif.style.padding = "15px 25px";
    notif.style.borderRadius = "8px";
    notif.style.fontWeight = "bold";
    notif.style.boxShadow = "0 4px 12px rgba(0,0,0,0.1)";
    notif.style.zIndex = "9999";
    notif.style.transition = "opacity 0.3s ease";

    if (type === 'success') {
      notif.style.backgroundColor = "#d1fae5";
      notif.style.color = "#065f46";
      notif.textContent = "✅ " + message;
    } else if (type === 'error') {
      notif.style.backgroundColor = "#fee2e2";
      notif.style.color = "#991b1b";
      notif.textContent = "❌ " + message;
    }

    document.body.appendChild(notif);
    setTimeout(() => {
      notif.style.opacity = "0";
      setTimeout(() => notif.remove(), 500);
    }, 4000);
  }

  function checkExistingApplication(offreId) {
    return fetch(`${BASE_URL}index.php?controller=candidature&action=checkExisting&offre_id=${offreId}`)
      .then(response => response.json())
      .then(data => {
        if (data.exists) {
          showNotification("Vous avez déjà postulé à cette offre!", "error");
          return true;
        }
        return false;
      })
      .catch(error => {
        console.error('Erreur:', error);
        return false;
      });
  }

  // Gestion des paramètres d'URL
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get("success") === "1") {
    showNotification("Candidature envoyée avec succès!", "success");
    urlParams.delete("success");
    const newUrl = window.location.pathname + (urlParams.toString() ? "?" + urlParams.toString() : "");
    window.history.replaceState({}, "", newUrl);
  }

  if (urlParams.get("error") === "1") {
    showNotification("Vous avez déjà postulé à cette offre!", "error");
    urlParams.delete("error");
    const newUrl = window.location.pathname + (urlParams.toString() ? "?" + urlParams.toString() : "");
    window.history.replaceState({}, "", newUrl);
  }

  // Gestion des formulaires de candidature
  document.querySelectorAll('form').forEach(form => {
    if (form.getAttribute('action')?.includes('postuler')) {
      form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const offreId = form.querySelector('input[name="offre_id"]')?.value;
        const cvFile = form.querySelector('input[type="file"]')?.files[0];
        
        if (!offreId) {
          showNotification("Erreur : offre invalide", "error");
          return;
        }

        if (!validateFile(cvFile)) return;
        
        const exists = await checkExistingApplication(offreId);
        if (!exists) {
          form.submit();
        }
      });
    }
  });
});