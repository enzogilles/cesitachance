document.addEventListener("DOMContentLoaded", function() {
    const burgerMenu = document.querySelector(".burger-menu");
    const nav = document.querySelector("nav");
    
    // Fonction pour basculer le menu
    function toggleMenu() {
        if (!burgerMenu || !nav) return;
        burgerMenu.classList.toggle("active");
        nav.classList.toggle("active");
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
            if (burgerMenu && window.getComputedStyle(burgerMenu).display !== 'none') {
                toggleMenu();
            }
        });
    });
    
    // Fermer le menu lorsque l'utilisateur clique en dehors
    document.addEventListener("click", function(event) {
        if (!nav || !burgerMenu) return;
        const isClickInsideNav = nav.contains(event.target);
        const isClickOnBurger = burgerMenu.contains(event.target);
        
        if (nav.classList.contains("active") && !isClickInsideNav && !isClickOnBurger) {
            toggleMenu();
        }
    });
    
    // Gestion du menu utilisateur
    let userIcon = document.getElementById("user-icon");
    let dropdownMenu = document.querySelector(".dropdown-menu");
    if (userIcon && dropdownMenu) {
        userIcon.addEventListener("click", function(event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle("show");
        });
    }
    
    // Fermer le menu déroulant utilisateur si on clique ailleurs
    document.addEventListener("click", function(event) {
        if (dropdownMenu && !event.target.closest("#user-icon")) {
            dropdownMenu.classList.remove("show");
        }
    });
});