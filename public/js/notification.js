class NotificationManager {
    constructor() {
        this.container = document.getElementById('notifications-container');
    }

    show(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        
        // Ajouter la notification au conteneur
        this.container.appendChild(notification);

        // Supprimer la notification après 3 secondes
        setTimeout(() => {
            notification.classList.add('fade-out');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }
}

// Créer une instance globale
window.notifications = new NotificationManager();