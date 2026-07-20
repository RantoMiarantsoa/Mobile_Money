<<<<<<< HEAD
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<div class="page-center">
    <div class="card-center">

        <h1>Créer un compte</h1>
        <p class="subtitle">Remplissez les champs ci-dessous</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= site_url('users/store') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Créer l'utilisateur</button>
        </form>

        <span class="link-muted">
            <a href="<?= site_url('login') ?>">← Retour à la connexion</a>
        </span>

    </div>
</div>

</body>
</html>
=======
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="<?= site_url('assets/style.css') ?>">

        <title>Création de compte</title>
    </head>
    <body>
        <form action="<?= site_url('users/store') ?>" method="POST">
        <?= csrf_field() ?>
        <input type="text"     name="username"  placeholder="Nom d'utilisateur" required>
        <input type="password" name="password"  placeholder="Mot de passe" required>
        <button type="submit">Créer l'utilisateur</button>
    </form>

    <p><a href="<?= site_url('login') ?>">Retour à la connexion</a></p>
    </body>
    </html>
>>>>>>> dc9b89993e45d0baf6cc10d2eb9a075991b976fb
