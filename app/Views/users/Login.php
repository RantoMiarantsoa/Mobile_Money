<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

<body>

<div class="page-center">
    <div class="card-center">

        <h1>Caisse</h1>
        <p class="subtitle">Connectez-vous pour continuer</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <form action="<?= site_url('login') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>

        <span class="link-muted">
            Pas encore de compte ? <a href="<?= site_url('users/create') ?>">Créer un compte</a>
        </span>

    </div>
</div>

</body>
</html>