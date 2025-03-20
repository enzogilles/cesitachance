<section class="content">
    <h2>Liste des Offres</h2>

    <!-- Formulaire de recherche -->
    <form class="search-form" method="GET" action="<?= BASE_URL ?>index.php">
        <input type="hidden" name="controller" value="offre">
        <input type="hidden" name="action" value="search">

        <label for="motcle">Mot-clé :</label>
        <input type="text" id="motcle" name="motcle" 
               value="<?= isset($motcle) ? htmlspecialchars($motcle) : '' ?>" required>

        <button type="submit" class="btn">Rechercher</button>
    </form>

    <div class="offers-container">
        <?php if (!empty($offres)): ?>
            <?php foreach ($offres as $offre): ?>
                <div class="offer-card">
                    <h4><?= htmlspecialchars($offre['titre']) ?> - <?= htmlspecialchars($offre['entreprise']) ?></h4>
                    <p><strong>Rémunération :</strong> <?= htmlspecialchars($offre['remuneration']) ?>€</p>
                    <p><?= htmlspecialchars($offre['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
                    
                    <div class="offer-buttons">
                        <a href="<?= BASE_URL ?>index.php?controller=offre&action=detail&id=<?= $offre['id'] ?>" class="btn-voir">Voir</a>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'Étudiant'): ?>
                            <form action="<?= BASE_URL ?>index.php?controller=wishlist&action=add" method="POST" style="display:inline;">
                                <input type="hidden" name="offre_id" value="<?= $offre['id'] ?>">
                                <button type="submit" class="btn">Ajouter à la Wishlist</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Aucune offre trouvée.</p>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if (isset($totalPages) && $totalPages > 0): ?>
        <div class="pagination">
            <?php
            // Bouton Précédent
            if ($page > 1):
            ?>
                <a href="?controller=offre&action=<?= (!empty($motcle) ? 'search' : 'index') ?>&page=<?= $page - 1 ?>&motcle=<?= urlencode($motcle) ?>&competences=<?= urlencode($competences) ?>">Précédent</a>
            <?php endif; ?>

            <?php
            // Calcul d'une fenêtre de 3 numéros
            $window = 3;
            if ($totalPages <= $window) {
                $start = 1;
                $end = $totalPages;
            } else {
                // On essaie de centrer la fenêtre sur la page courante
                $start = max(1, $page - 1);
                $end = $start + $window - 1;
                if ($end > $totalPages) {
                    $end = $totalPages;
                    $start = max(1, $end - $window + 1);
                }
            }
            for ($i = $start; $i <= $end; $i++):
            ?>
                <a href="?controller=offre&action=<?= (!empty($motcle) ? 'search' : 'index') ?>&page=<?= $i ?>&motcle=<?= urlencode($motcle) ?>&competences=<?= urlencode($competences) ?>"
                   class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>

            <?php
            // Bouton Suivant
            if ($page < $totalPages):
            ?>
                <a href="?controller=offre&action=<?= (!empty($motcle) ? 'search' : 'index') ?>&page=<?= $page + 1 ?>&motcle=<?= urlencode($motcle) ?>&competences=<?= urlencode($competences) ?>">Suivant</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
