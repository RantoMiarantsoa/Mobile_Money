<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Transfert d'argent — Mobile Money</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

</head>
<body>

<div class="app-shell">

    <!-- SIDEBAR -->
    <?= view('layout/sidebar_client') ?>

    <!-- CONTENU -->
    <main class="app-main">

        <?php $eyebrow = 'Envoyer de l\'argent'; $title = 'Transfert'; ?>
        <?= view('layout/topbar') ?>

        <div class="page-header">
            <div>
                <h3>Choisissez un opérateur</h3>
                <p>Sélectionnez la destination de votre transfert pour continuer.</p>
            </div>
        </div>

        <div class="transfer-grid">

            <a href="<?= base_url('client/transfert?operateur=MVOLA') ?>" class="transfer-card transfer-card--mvola">
                <span class="transfer-icon"><i class="bi bi-phone"></i></span>
                <strong>Vers MVola</strong>
                <span>Rapide &amp; sécurisé</span>
            </a>

            <a href="<?= base_url('client/transfert?operateur=ORANGE') ?>" class="transfer-card transfer-card--orange">
                <span class="transfer-icon"><i class="bi bi-arrow-left-right"></i></span>
                <strong>Vers Orange Money</strong>
                <span>Direct Orange</span>
            </a>

            <a href="<?= base_url('client/transfert?operateur=AIRTEL') ?>" class="transfer-card transfer-card--airtel">
                <span class="transfer-icon"><i class="bi bi-phone-fill"></i></span>
                <strong>Vers Airtel Money</strong>
                <span>Transfert Airtel</span>
            </a>

        </div>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/app.js') ?>"></script>

</body>
</html>