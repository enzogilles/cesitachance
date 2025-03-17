<section class="content">
    <h3>Connexion</h3>
    <?php if (isset($error)): ?>
        <p style="color: red; text-align: center;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form id="login-form" action="<?= BASE_URL ?>index.php?controller=utilisateur&action=login" method="POST">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required pattern=".{8,}" title="Au moins 8 caractères">
        
        <button type="submit" class="btn">Se connecter</button>
        <!-- Lien pour le mot de passe oublié -->
        <p class="forgot-password">
            <a href="<?= BASE_URL ?>index.php?controller=utilisateur&action=resetPassword">Mot de passe oublié ?</a>
        </p>
    </form>
    <div class="account-link">
        <p>Pas encore de compte ?</p>
        <a href="<?= BASE_URL ?>index.php?controller=utilisateur&action=inscription" class="btn-add">Créer un compte</a>
    </div>
</section>
