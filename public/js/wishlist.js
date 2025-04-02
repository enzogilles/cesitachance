document.addEventListener("DOMContentLoaded", function () {
  // --- SECTION SUPPRESSION (V7) ---
  // On part du principe que la liste affichée se trouve dans un conteneur avec la classe ".wishlist-list"
  const wishlistList = document.querySelector(".wishlist-list");
<<<<<<< Updated upstream
  if (wishlistList) {
    wishlistList.addEventListener("click", function (e) {
      if (e.target.classList.contains("btn-remove")) {
        const wishlistId = e.target.getAttribute("data-wishlist-id");

        fetch("../api/remove_wishlist.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ wishlist_id: wishlistId }),
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              // Retire l’élément du DOM
              e.target.parentElement.remove();
              // Affichage de la notification de suppression (style V6)
              showNotification("ℹ️ Offre retirée de la wishlist.", "info");
            } else {
              showNotification("Erreur : " + data.message, "error");
            }
          })
          .catch(error => {
            console.error("Erreur lors de la suppression :", error);
            showNotification("Erreur lors de la suppression", "error");
          });
=======

  // === SUPPRESSION D'UNE OFFRE ===
  document.addEventListener("click", function (e) {
    if (
      e.target.tagName === "BUTTON" &&
      e.target.classList.contains("btn-supprimer")
    ) {
      e.preventDefault();

      const form = e.target.closest("form");
      const wishlistIdInput = form.querySelector('input[name="wishlist_id"]');
      const wishlistId = wishlistIdInput?.value;

      if (!wishlistId) {
        showNotification("Aucun ID trouvé pour la suppression.", "error");
        return;
>>>>>>> Stashed changes
      }

      fetch(BASE_URL + "wishlist/remove", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ wishlist_id: wishlistId }),
      })
      
        .then(response => response.json())
        .then(data => {
          console.log("Réponse de l'API suppression :", data);
          if (data.success) {
            const offerCard = form.closest(".offer-card");
            if (offerCard) {
              offerCard.remove();
              showNotification("ℹ️ Offre retirée de la wishlist.", "info");
            }
          } else {
            showNotification("Erreur : " + (data.message || "Échec de la suppression"), "error");
          }
        })
        .catch(error => {
          console.error("Erreur lors de la suppression :", error);
          showNotification("Erreur lors de la suppression", "error");
        });
    }
  });

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
          // Modifier le style du bouton pour indiquer que l'offre est ajoutée
          const button = document.querySelector(`.btn-add-wishlist[data-offre-id="${offreId}"]`);
          if (button) {
            button.innerHTML = "✓ Ajouté";
            button.classList.add("added-to-wishlist");
            button.disabled = true;
          }
          
          // Afficher une notification de succès
          showNotification("✓ Offre ajoutée à votre wishlist !", "success");
          
          // Supprimer la redirection automatique
          // Ajouter un lien vers la wishlist dans la notification
          const wishlistLink = document.createElement("a");
          wishlistLink.href = BASE_URL + "wishlist/index";
          wishlistLink.innerText = "Voir ma wishlist";
          wishlistLink.className = "notification-link";
          wishlistLink.style.display = "block";
          wishlistLink.style.marginTop = "8px";
          wishlistLink.style.textDecoration = "underline";
          wishlistLink.style.fontSize = "0.9em";
          
          const currentNotification = document.querySelector(".notification");
          if (currentNotification) {
            currentNotification.appendChild(wishlistLink);
          }
        } else {
          showNotification("⚠️ " + (data.message || "Erreur lors de l'ajout"), "error");
        }
      })
      .catch(error => {
        console.error("Erreur lors de l'ajout :", error);
        showNotification("Erreur lors de l'ajout à la wishlist.", "error");
      });
  }

<<<<<<< Updated upstream
  // --- FONCTIONNALITÉS COMMUNES (V6) ---

  /**
   * Affiche une notification personnalisée.
   *
   * @param {string} message - Le message à afficher.
   * @param {string} [type="info"] - Le type de notification ("success", "error", "info", …).
   * @param {boolean} [withButton=false] - Si true, ajoute un bouton pour accéder à la wishlist.
   */
  function showNotification(message, type = "info", withButton = false) {
    // Supprime d'éventuelles notifications existantes
=======
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
      const offerTitle = document.querySelector("h3")?.textContent.trim() || "Offre";
      addToWishlist(offreId, offerTitle);
      
      // Modification visuelle du bouton sur la page détail
      this.innerHTML = "✓ Ajouté à votre wishlist";
      this.classList.add("added-to-wishlist");
      this.disabled = true;
    });
  }

  // === NOTIFICATION ===
  function showNotification(message, type = "info") {
>>>>>>> Stashed changes
    document.querySelectorAll(".notification").forEach(n => n.remove());

    const notification = document.createElement("div");
    notification.className = `notification ${type}`;
<<<<<<< Updated upstream

    // Ajout d'une icône pour les notifications de succès
    if (type === "success") {
      notification.innerHTML = `✅ ${message}`;
    } else {
      notification.textContent = message;
=======
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
>>>>>>> Stashed changes
    }

    if (withButton) {
      const button = document.createElement("button");
      button.classList.add("btn-view-wishlist");
      button.textContent = "Voir la wishlist";
      button.addEventListener("click", function () {
        window.location.href = "wishlist.html";
      });

      notification.appendChild(document.createElement("br"));
      notification.appendChild(button);
    }

    document.body.appendChild(notification);
<<<<<<< Updated upstream

    setTimeout(() => {
      notification.remove();
    }, 3000);
  }

  /**
   * Ajoute une offre à la wishlist via l'API.
   *
   * @param {string} offerTitle - Le titre de l'offre à ajouter.
   */
  function addToWishlist(offerTitle) {
    // On envoie la requête d'ajout à l'API (à adapter selon votre back-end)
    fetch("../api/add_wishlist.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ offer_title: offerTitle }),
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showNotification("Ajouté à la wishlist !", "success", true);

          // Optionnel : mise à jour de l'affichage de la wishlist si l'élément existe dans le DOM
          if (wishlistList) {
            const li = document.createElement("li");
            li.textContent = offerTitle;
            li.classList.add("wishlist-item");
            li.dataset.title = offerTitle;

            // Le bouton de suppression doit utiliser la même classe et l'attribut data pour déclencher le code de suppression
            const removeBtn = document.createElement("button");
            removeBtn.textContent = "Retirer";
            removeBtn.classList.add("btn-remove");
            // Utilisation d'un identifiant renvoyé par l'API (ou sinon on peut utiliser le titre)
            removeBtn.setAttribute("data-wishlist-id", data.wishlist_id || offerTitle);

            li.appendChild(removeBtn);
            wishlistList.appendChild(li);
          }

          // Redirection avec surlignage de l'offre ajoutée
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

  // --- Ajout via les boutons "Ajouter à la wishlist" ---
  document.querySelectorAll(".add-to-wishlist").forEach(button => {
    button.addEventListener("click", function () {
      const offerTitle = this.getAttribute("data-title").trim();
      addToWishlist(offerTitle);
    });
  });

  // --- Cas spécifique pour la page de détails d'offre ---
  const detailWishlistButton = document.querySelector(".btn");
  if (
    detailWishlistButton &&
    detailWishlistButton.textContent.includes("Ajouter à la wishlist")
  ) {
    detailWishlistButton.addEventListener("click", function () {
      const offerTitle = document.querySelector("h3").textContent.trim();
      addToWishlist(offerTitle);
    });
  }

  // --- SURBRILLANCE DE L'OFFRE AJOUTÉE ---
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
});
=======
  
    // Fade out (plus long pour les notifications de succès)
    setTimeout(() => {
      notification.style.opacity = "0";
      setTimeout(() => {
        notification.remove();
      }, 500);
    }, type === "success" ? 4000 : 3000);
  }
  
  // Ajouter des styles CSS pour le bouton ajouté à la wishlist
  const style = document.createElement('style');
  style.textContent = `
    .added-to-wishlist {
      background-color: #10b981 !important;
      color: white !important;
      cursor: default !important;
    }
    .notification-link {
      color: inherit;
      font-weight: normal;
    }
    .notification-link:hover {
      text-decoration: none;
    }
  `;
  document.head.appendChild(style);
});
>>>>>>> Stashed changes
