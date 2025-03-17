<section class="content">
    <h3>Entreprises proposant des stages</h3>

    <?php if (isset($entreprises) && !empty($entreprises)): ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entreprises as $entreprise): ?>
                    <tr>
                        <td><?= htmlspecialchars($entreprise['nom']) ?></td>
                        <td><?= htmlspecialchars($entreprise['ville']) ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>index.php?controller=entreprise&action=details&id=<?= $entreprise['id'] ?>" class="btn-voir">Détails</a>
                            <!-- Autres actions si nécessaire -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php if ($totalPages > 0): ?>
            <div class="pagination">
                <!-- Bouton Précédent -->
                <?php if ($page > 1): ?>
                    <a href="?controller=entreprise&action=index&page=<?= $page - 1 ?>&nom=<?= urlencode($nom) ?>&ville=<?= urlencode($ville) ?>&secteur=<?= urlencode($secteur) ?>">Précédent</a>
                <?php endif; ?>

                <?php
                // Définir une fenêtre de 3 numéros
                $window = 3;
                if ($totalPages <= $window) {
                    $start = 1;
                    $end = $totalPages;
                } else {
                    $start = max(1, $page - 1);
                    $end = $start + $window - 1;
                    if ($end > $totalPages) {
                        $end = $totalPages;
                        $start = max(1, $end - $window + 1);
                    }
                }
                for ($i = $start; $i <= $end; $i++):
                ?>
                    <a href="?controller=entreprise&action=index&page=<?= $i ?>&nom=<?= urlencode($nom) ?>&ville=<?= urlencode($ville) ?>&secteur=<?= urlencode($secteur) ?>"
                       class="<?= ($i == $page) ? 'active' : '' ?>">
                       <?= $i ?>
                    </a>
                <?php endfor; ?>

                <!-- Bouton Suivant -->
                <?php if ($page < $totalPages): ?>
                    <a href="?controller=entreprise&action=index&page=<?= $page + 1 ?>&nom=<?= urlencode($nom) ?>&ville=<?= urlencode($ville) ?>&secteur=<?= urlencode($secteur) ?>">Suivant</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <p>Aucune entreprise trouvée.</p>
    <?php endif; ?>

    <!-- Formulaire de création de Nouvelle Entreprise (si applicable) -->
</section>
