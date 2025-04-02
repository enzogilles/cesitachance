document.addEventListener("DOMContentLoaded", function () {
  const wishlistList = document.querySelector(".wishlist-list");

  // === SUPPRESSION D'UNE OFFRE ===
  if (wishlistList) {
    wishlistList.addEventListener("click", function (e) {
      if (
        e.target.tagName === "BUTTON" &&
        e.target.classList.contains("btn-delete")
      ) {
        e.preventDefault();
    
        const wishlistId = e.target.getAttribute("data-id");
    
        if (!wishlistId) {
          showNotification("Aucun ID trouvé pour la suppression.", "error");
          return;
        }
    
        fetch(BASE_URL + "wishlist/remove", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ wishlist_id: wishlistId }),
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              e.target.closest("li")?.remove();
              showNotification("🗑️ Offre retirée de la wishlist.", "info");
            } else {
              showNotification("Erreur : " + data.message, "error");
            }
          })
          .catch(error => {
            console.error("Erreur lors de la suppression :", error);
            showNotification("Erreur lors de la suppression", "error");
          });
      }
    });
    
  }

  // === AJOUT D'UNE OFFRE ===
  function addToWishlist(offreId, offerTitle) {
    fetch(BASE_URL + "wishlist/add", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ offre_id: offreId }),
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showNotification("Ajouté à la wishlist !", "success");

          if (wishlistList) {
            const li = document.createElement("li");
            li.classList.add("wishlist-item");
            li.dataset.title = offerTitle;

            const span = document.createElement("span");
            span.textContent = offerTitle;

            const form = document.createElement("form");
            form.method = "POST";
            form.action = BASE_URL + "wishlist/remove";

            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "wishlist_id";
            input.value = data.wishlist_id || offerTitle;

            const button = document.createElement("button");
            button.type = "submit";
            button.classList.add("btn-delete");
            button.textContent = "Supprimer";

            form.appendChild(input);
            form.appendChild(button);

            li.appendChild(span);
            li.appendChild(form);
            wishlistList.appendChild(li);
          }

          setTimeout(() => {
            window.location.href = BASE_URL + "wishlist";
          }, 2000);
        } else {
          showNotification("⚠️ " + data.message, "error");
        }
      })
      .catch(error => {
        console.error("Erreur lors de l'ajout :", error);
        showNotification("Erreur lors de l'ajout à la wishlist.", "error");
      });
  }

  // Ajout via boutons (liste des offres)
  document.querySelectorAll(".btn-add-wishlist").forEach(button => {
    button.addEventListener("click", function () {
      const offreId = this.getAttribute("data-offre-id");
      const offerTitle = this.getAttribute("data-offre-title");
      addToWishlist(offreId, offerTitle);
    });
  });

  // Ajout depuis page de détail
  const detailWishlistButton = document.querySelector(".btn.btn-wishlist");
  if (detailWishlistButton) {
    detailWishlistButton.addEventListener("click", function (e) {
      e.preventDefault();
      const offreId = document.querySelector('input[name="offre_id"]').value;
      const offerTitle = document.querySelector("h3").textContent.trim();
      addToWishlist(offreId, offerTitle);
    });
  }

  // === NOTIFICATION ===
  function showNotification(message, type = "info", duration = 3000) {
    document.querySelectorAll(".notification").forEach(n => n.remove());

    const notification = document.createElement("div");
    notification.className = `notification ${type}`;
    notification.style.position = "fixed";
    notification.style.top = "100px";
    notification.style.left = "37%";
    notification.style.transform = "translateX(-50%)";
    notification.style.zIndex = "9999";
    notification.style.padding = "15px 25px";
    notification.style.borderRadius = "8px";
    notification.style.fontWeight = "bold";
    notification.style.boxShadow = "0 4px 12px rgba(0,0,0,0.1)";
    notification.style.maxWidth = "400px";
    notification.style.textAlign = "center";
    notification.style.transition = "opacity 0.4s ease";
    notification.style.opacity = "1";

    switch (type) {
      case "success":
        notification.style.backgroundColor = "#d1fae5";
        notification.style.color = "#065f46";
        break;
      case "error":
        notification.style.backgroundColor = "#fee2e2";
        notification.style.color = "#991b1b";
        break;
      case "info":
      default:
        notification.style.backgroundColor = "#dbeafe";
        notification.style.color = "#1e3a8a";
        break;
    }

    notification.innerHTML = message;
    document.body.appendChild(notification);

    setTimeout(() => {
      notification.style.opacity = "0";
      setTimeout(() => {
        notification.remove();
      }, 500);
    }, duration);
  }

  // === RESET FORM ===
  const searchForm = document.querySelector(".search-form");
  const resetButton = document.querySelector(".search-form .bouton-reset");

  if (resetButton && window.location.pathname.includes("/wishlist")) {
    resetButton.addEventListener("click", function (e) {
      e.preventDefault();
      window.location.href = BASE_URL + "wishlist";
    });
  }

  const urlParams = new URLSearchParams(window.location.search);
  const notif = urlParams.get("notif");

  const currentPath = window.location.pathname;

  if (notif === "1" && (currentPath.includes("/wishlist") || currentPath.includes("wishlist"))) {
    showNotification("🔍 Wishlist affichée", "info", 5000);
    urlParams.delete("notif");
    const newUrl = window.location.pathname + '?' + urlParams.toString();
    window.history.replaceState({}, "", newUrl);
  }

});
