<section class="content">
    <h3>Réinitialiser votre mot de passe</h3>
    <?php if (isset($error)): ?>
        <p style="color: red; text-align: center;"><?= htmlspecialchars($error) ?></p>
    <?php elseif (isset($message)): ?>
        <p style="color: green; text-align: center;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form id="reset-password-form" action="<?= BASE_URL ?>index.php?controller=utilisateur&action=sendResetLink" method="POST">
        <label for="email">Entrez votre email :</label>
        <input type="email" id="email" name="email" required>
        <button type="submit" class="btn">Envoyer le lien</button>
    </form>
</section>
