document.addEventListener("DOMContentLoaded", function() {
    const burgerMenu = document.querySelector(".burger-menu");
    const nav = document.querySelector("nav");
    const userIcon = document.getElementById("user-icon");
    const dropdownMenu = document.querySelector(".dropdown-menu");
    
    // Fonction pour basculer le menu burger
    function toggleMenu() {
        if (!burgerMenu || !nav) return;
        burgerMenu.classList.toggle("active");
        nav.classList.toggle("active");
    }
    
    // Fonction pour fermer le menu utilisateur
    function closeUserDropdown() {
        if (dropdownMenu && dropdownMenu.classList.contains("show")) {
            dropdownMenu.classList.remove("show");
        }
    }
    
    // Écouteur d'événement pour le menu burger
    if (burgerMenu) {
        burgerMenu.addEventListener("click", function(event) {
            event.preventDefault();
            event.stopPropagation();
            toggleMenu();
        });
    }
    
    // Fermer le menu lorsque l'utilisateur clique sur un lien
    const navLinks = document.querySelectorAll("nav a");
    navLinks.forEach(link => {
        link.addEventListener("click", function() {
            // Vérifie si on est en vue mobile (le burger est visible)
            if (burgerMenu && window.getComputedStyle(burgerMenu).display !== 'none' && nav.classList.contains("active")) {
                toggleMenu();
            }
        });
    });
    
    // Gestion du menu utilisateur
    if (userIcon && dropdownMenu) {
        userIcon.addEventListener("click", function(event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle("show");
        });
    }
    
    // Gestionnaire de clic global pour fermer les menus
    document.addEventListener("click", function(event) {
        // Fermer le menu burger si actif et clic en dehors
        if (nav && nav.classList.contains("active")) {
            const isClickInsideNav = nav && nav.contains(event.target);
            const isClickOnBurger = burgerMenu && burgerMenu.contains(event.target);
            
            if (!isClickInsideNav && !isClickOnBurger) {
                toggleMenu();
            }
        }
        
        // Fermer le menu utilisateur si clic en dehors
        if (dropdownMenu && !event.target.closest("#user-icon")) {
            closeUserDropdown();
        }
    });
});