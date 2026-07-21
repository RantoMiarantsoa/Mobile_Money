<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Historique — Mobile Money</title>

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

        <?php $eyebrow = 'Mes opérations'; $title = 'Historique'; ?>
        <?= view('layout/topbar') ?>

        <!-- RESUME -->
        <div class="row g-3">

            <div class="col-6 col-xl-4">
                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon bg-icon-primary">
                            <i class="bi bi-arrow-left-right"></i>
                        </div>
                        <span class="trend-badge trend-neutral">Total</span>
                    </div>
                    <div class="stat-label">Opérations</div>
                    <div class="stat-value"><?= esc($nombreTotal) ?></div>
                    <div class="stat-sub">Depuis la création du compte</div>
                </div>
            </div>

            <div class="col-6 col-xl-4">
                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon bg-icon-success">
                            <i class="bi bi-arrow-down-left"></i>
                        </div>
                        <span class="trend-badge trend-up">Entrées</span>
                    </div>
                    <div class="stat-label">Total reçu</div>
                    <div class="stat-value"><?= number_format($totalEntrees, 0, ',', ' ') ?> Ar</div>
                    <div class="stat-sub">Dépôts &amp; transferts reçus</div>
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon bg-icon-danger">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                        <span class="trend-badge trend-warn">Sorties</span>
                    </div>
                    <div class="stat-label">Total envoyé</div>
                    <div class="stat-value"><?= number_format($totalSorties, 0, ',', ' ') ?> Ar</div>
                    <div class="stat-sub">Retraits &amp; transferts envoyés</div>
                </div>
            </div>

        </div>

        <!-- TABLEAU -->
        <div class="section-title-row">
            <h3>Toutes les opérations</h3>
        </div>

        <?php if (empty($historique)) : ?>

        <div class="card">
            <div class="card-body text-center text-muted py-5">
                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                Aucune opération pour le moment.
            </div>
        </div>

        <?php else : ?>

        <div class="card table-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Opération</th>
                                <th>Date &amp; heure</th>
                                <th>Frais</th>
                                <th>Statut</th>
                                <th class="text-end">Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($historique as $op) : ?>
                            <?php
                                $sens   = $op['sens'] === 'in' ? 'in' : 'out';
                                $type   = $op['type_operation'];
                                $icone  = $sens === 'in' ? 'bi-arrow-down-left' : 'bi-arrow-up-right';
                                $classe = strtolower($type);
                            ?>
                            <tr>
                                <td class="d-flex align-items-center">
                                    <span class="avatar-chip" style="background:<?= $sens === 'in' ? 'var(--mm-success)' : 'var(--mm-primary)' ?>">
                                        <i class="bi <?= $icone ?>"></i>
                                    </span>
                                    <div>
                                        <div class="fw-semibold">
                                            <span class="type-pill type-<?= esc($classe) ?>"><?= esc($type) ?></span>
                                        </div>
                                        <div class="text-muted" style="font-size:.78rem;">
                                            <?= esc($op['libelle']) ?>
                                        </div>
                                    </div>
                                </td>
                                <td><?= esc($op['date_operation']) ?></td>
                                <td><?= number_format($op['frais'], 0, ',', ' ') ?> Ar</td>
                                <td><span class="status-pill status-complete">Succès</span></td>
                                <td class="text-end fw-bold <?= $sens === 'in' ? 'text-success' : 'text-danger' ?>">
                                    <?= $sens === 'in' ? '+' : '-' ?><?= number_format($op['montant'], 0, ',', ' ') ?> Ar
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php endif; ?>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/app.js') ?>"></script>

</body>
</html>