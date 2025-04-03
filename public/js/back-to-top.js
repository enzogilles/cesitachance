document.addEventListener('DOMContentLoaded', function() {
  // Créer le bouton dynamiquement
  const backToTopButton = document.createElement('button');
  backToTopButton.className = 'back-to-top';
  backToTopButton.innerHTML = '&#8679;'; // Flèche vers le haut
  backToTopButton.setAttribute('aria-label', 'Retour en haut');
  backToTopButton.setAttribute('title', 'Retour en haut');
  document.body.appendChild(backToTopButton);

  // Référence au header/menu pour calculer quand il n'est plus visible
  const header = document.querySelector('header');
  
  // Fonction pour vérifier si on doit afficher le bouton
  function toggleBackToTopButton() {
    if (header) {
      // Si le bas du header est au-dessus de la fenêtre (plus visible)
      const headerIsHidden = header.getBoundingClientRect().bottom < 0;
      backToTopButton.classList.toggle('visible', headerIsHidden);
    } else {
      // Fallback si le header n'est pas trouvé (utilise le scroll standard)
      backToTopButton.classList.toggle('visible', window.scrollY > 150);
    }
  }

  // Écouter l'événement de scroll
  window.addEventListener('scroll', toggleBackToTopButton);
  
  // Vérifier immédiatement si le bouton doit être affiché
  // (au cas où la page est déjà scrollée au chargement)
  toggleBackToTopButton();

  // Action de clic sur le bouton
  backToTopButton.addEventListener('click', function() {
    // Animation douce pour remonter en haut
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
});