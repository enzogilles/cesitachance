<section class="content">
    <h3>Modifier une Entreprise</h3>
    <form action="<?= BASE_URL ?>index.php?controller=entreprise&action=modifier&id=<?= $entreprise['id'] ?>" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($entreprise['nom']) ?>" required>

        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville" value="<?= htmlspecialchars($entreprise['ville']) ?>" required>

        <label for="secteur">Secteur :</label>
        <input type="text" id="secteur" name="secteur" value="<?= htmlspecialchars($entreprise['secteur']) ?>" required>

        <label for="taille">Taille :</label>
        <input type="text" id="taille" name="taille" value="<?= htmlspecialchars($entreprise['taille']) ?>" required>

        <!-- Nouveaux champs -->
        <label for="description">Description :</label>
        <textarea id="description" name="description"><?= htmlspecialchars($entreprise['description'] ?? '') ?></textarea>

        <label for="email">Email de contact :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($entreprise['email'] ?? '') ?>">

        <label for="telephone">Téléphone de contact :</label>
        <input type="text" id="telephone" name="telephone" value="<?= htmlspecialchars($entreprise['telephone'] ?? '') ?>">

        <button type="submit" class="btn">Modifier</button>
    </form>
</section>
