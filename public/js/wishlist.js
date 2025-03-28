document.addEventListener("DOMContentLoaded", function () {
  const wishlistList = document.querySelector(".wishlist-list");

  // === SUPPRESSION D'UNE OFFRE ===
  if (wishlistList) {
    wishlistList.addEventListener("click", function (e) {
      if (
        e.target.tagName === "BUTTON" &&
        e.target.closest("form") &&
        e.target.textContent.trim().toLowerCase().includes("supprimer")
      ) {
        e.preventDefault();

        const form = e.target.closest("form");
        const wishlistIdInput = form.querySelector('input[name="wishlist_id"]');
        const wishlistId = wishlistIdInput?.value;

        if (!wishlistId) {
          showNotification("Aucun ID trouvé pour la suppression.", "error");
          return;
        }

        fetch("../api/remove_wishlist.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ wishlist_id: wishlistId }),
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              form.closest("li")?.remove();
              showNotification("ℹ️ Offre retirée de la wishlist.", "info");
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
  function addToWishlist(offerTitle) {
    fetch("../api/add_wishlist.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ offer_title: offerTitle }),
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showNotification("Ajouté à la wishlist !", "success", true);

          if (wishlistList) {
            const li = document.createElement("li");
            li.textContent = offerTitle;
            li.classList.add("wishlist-item");
            li.dataset.title = offerTitle;

            const removeBtn = document.createElement("button");
            removeBtn.textContent = "Retirer";
            removeBtn.classList.add("btn-remove");
            removeBtn.setAttribute("data-wishlist-id", data.wishlist_id || offerTitle);

            li.appendChild(removeBtn);
            wishlistList.appendChild(li);
          }

          setTimeout(() => {
            window.location.href = `wishlist.html?highlight=${encodeURIComponent(offerTitle)}`;
          }, 1000);
        } else {
          showNotification("⚠️ " + data.message, "error");
        }
      })
      .catch(error => {
        console.error("Erreur lors de l'ajout :", error);
        showNotification("Erreur lors de l'ajout à la wishlist.", "error");
      });
  }

  // Ajout via boutons
  document.querySelectorAll(".add-to-wishlist").forEach(button => {
    button.addEventListener("click", function () {
      const offerTitle = this.getAttribute("data-title").trim();
      addToWishlist(offerTitle);
    });
  });

  // Ajout depuis page de détail
  const detailWishlistButton = document.querySelector(".btn");
  if (detailWishlistButton && detailWishlistButton.textContent.includes("Ajouter à la wishlist")) {
    detailWishlistButton.addEventListener("click", function () {
      const offerTitle = document.querySelector("h3").textContent.trim();
      addToWishlist(offerTitle);
    });
  }

  // Mise en surbrillance d'une offre ajoutée
  const urlParams = new URLSearchParams(window.location.search);
  const highlightedOffer = urlParams.get("highlight");
  if (highlightedOffer) {
    setTimeout(() => {
      const offerElements = document.querySelectorAll(".wishlist-item");
      let found = false;
      offerElements.forEach(offer => {
        if (offer.dataset.title.trim() === highlightedOffer.trim()) {
          offer.classList.add("highlight-offer");
          found = true;
          setTimeout(() => {
            offer.classList.remove("highlight-offer");
            if (found) {
              window.history.replaceState({}, document.title, window.location.pathname);
            }
          }, 3000);
        }
      });
      if (!found) {
        window.history.replaceState({}, document.title, window.location.pathname);
      }
    }, 500);
  }

  // === NOTIFICATION ===
  function showNotification(message, type = "info", withButton = false) {
    document.querySelectorAll(".notification").forEach(n => n.remove());

    const notification = document.createElement("div");
    notification.className = `notification ${type}`;
    notification.style.position = "fixed";
    notification.style.top = "100px";
    notification.style.left = "50%";
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

    // Couleurs par type
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

    if (withButton) {
      const button = document.createElement("button");
      button.classList.add("btn-view-wishlist");
      button.textContent = "Voir la wishlist";
      button.style.marginTop = "10px";
      button.style.padding = "8px 16px";
      button.style.border = "none";
      button.style.background = "#2C3E60";
      button.style.color = "#fff";
      button.style.borderRadius = "5px";
      button.style.cursor = "pointer";

      button.addEventListener("click", function () {
        window.location.href = "wishlist.html";
      });

      notification.appendChild(document.createElement("br"));
      notification.appendChild(button);
    }

    document.body.appendChild(notification);

    // Fade out
    setTimeout(() => {
      notification.style.opacity = "0";
      setTimeout(() => {
        notification.remove();
      }, 500);
    }, 3000);
  }
});