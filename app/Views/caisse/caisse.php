<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Choix de la Caisse</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
=======
       <link rel="stylesheet" href="<?= site_url('assets/style.css') ?>">

    <title>Caisse</title>
>>>>>>> dc9b89993e45d0baf6cc10d2eb9a075991b976fb
</head>
<body>

<div class="page-center">
    <div class="card-center">

        <h1>Sélectionner une caisse</h1>
        <p class="subtitle">Connecté : <strong><?= esc(session()->get('username')) ?></strong></p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= site_url('achat') ?>" method="GET">
            <div class="form-group">
                <label for="caisse">Numéro de caisse</label>
                <select name="caisse" id="caisse" required>
                    <option value="">-- Sélectionner --</option>
                    <?php foreach ($caisses as $caisse): ?>
                        <option value="<?= esc($caisse['id']) ?>"><?= esc($caisse['numero']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Valider</button>
        </form>

        <span class="link-muted">
            <a href="<?= site_url('logout') ?>">Se déconnecter</a>
        </span>

    </div>
</div>

</body>
</html>