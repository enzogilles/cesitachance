document.addEventListener('DOMContentLoaded', function() {
  // Sélection de tous les types de boutons
  const buttons = document.querySelectorAll(`
    button.btn, 
    a.btn-voir, 
    a.btn-add,
    .btn-login, 
    .btn-back, 
    .btn-wishlist, 
    .btn-postuler, 
    .bouton-reset,
    .btn-modifier,
    .btn-supprimer,
    .btn-register,
    .status-btn,
    .btn-view,
    .contact-button,
    input[type="submit"],
    form button[type="submit"],
    form button[type="reset"]
  `);

  // Application des styles standardisés à tous les boutons
  buttons.forEach(button => {
    // Styles de base pour tous les boutons
    button.style.padding = '8px 15px';
    button.style.fontSize = '14px';
    button.style.fontWeight = 'bold';
    button.style.borderRadius = '5px';
    button.style.display = 'inline-flex';
    button.style.justifyContent = 'center';
    button.style.alignItems = 'center';
    button.style.textDecoration = 'none';
    button.style.transition = 'all 0.3s ease';
    button.style.cursor = 'pointer';
    button.style.flex = '0 1 auto';

    // Gestion des largeurs selon le type de bouton
    if (button.classList.contains('btn-modifier') || 
        button.classList.contains('btn-supprimer') ||
        button.classList.contains('btn-voir')) {
      button.style.minWidth = '100px';
    } else if (button.classList.contains('btn-wishlist')) {
      // Les boutons wishlist gardent leur style arrondi
      button.style.borderRadius = '25px';
    } else if (button.classList.contains('btn-back')) {
      // Les boutons retour sont un peu plus grands
      button.style.padding = '10px 20px';
    }

    // Correction des marges
    button.style.margin = '5px';
  });

  // Correction spécifique pour les conteneurs de boutons
  const buttonContainers = document.querySelectorAll(
    '.offer-buttons, .action-buttons, .form-actions, .back-button-container'
  );
  
  buttonContainers.forEach(container => {
    container.style.display = 'flex';
    container.style.flexDirection = 'row';
    container.style.flexWrap = 'wrap';
    container.style.justifyContent = 'center';
    container.style.gap = '8px';
    container.style.margin = '10px 0';
    container.style.width = '100%';
  });

  // Standardisation des boutons dans les tableaux
  const tableButtons = document.querySelectorAll('.styled-table .btn-modifier, .styled-table .btn-supprimer, .styled-table .btn-voir');
  tableButtons.forEach(button => {
    button.style.display = 'inline-flex';
    button.style.padding = '6px 12px';
    button.style.fontSize = '13px';
    button.style.minWidth = '90px';
    button.style.margin = '2px';
    button.style.flexDirection = 'row';
  });
});