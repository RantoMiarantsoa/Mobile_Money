<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Situation des gains — Mobile Money</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

</head>
<body>

<div class="app-shell">

    <?= view('layout/sidebar') ?>

    <main class="app-main">

        <?php $eyebrow = 'Finance'; $title = 'Situation des gains'; ?>
        <?= view('layout/topbar') ?>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-icon-warning">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                    <div>
                        <div class="stat-label">Gains retrait</div>
                        <div class="stat-value"><?= number_format($gainRetrait, 0, ',', ' ') ?> Ar</div>
                        <div class="stat-sub">Total frais provenant des retraits</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon bg-icon-primary">
                        <i class="bi bi-send-check-fill"></i>
                    </div>
                    <div>
                        <div class="stat-label">Gains transfert</div>
                        <div class="stat-value"><?= number_format($gainTransfert, 0, ',', ' ') ?> Ar</div>
                        <div class="stat-sub">Total frais provenant des transferts</div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card stat-card--solid">
                    <div class="stat-icon">
                        <i class="bi bi-piggy-bank-fill"></i>
                    </div>
                    <div>
                        <div class="stat-label">Gains total</div>
                        <div class="stat-value"><?= number_format($gainTotal, 0, ',', ' ') ?> Ar</div>
                        <div class="stat-sub">Retrait + Transfert</div>
                    </div>
                </div>
            </div>

        </div>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/app.js') ?>"></script>

</body>
</html>
