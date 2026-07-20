<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Accueil — Mobile Money</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

</head>
<body>

<?php
    // Initiales pour l'avatar (2 lettres max)
    $initiales = '';
    foreach (explode(' ', trim($nom)) as $mot) {
        $initiales .= mb_strtoupper(mb_substr($mot, 0, 1));
        if (mb_strlen($initiales) >= 2) break;
    }
?>

<div class="app-shell">

    <!-- SIDEBAR -->
    <?= view('layout/sidebar_client') ?>

    <!-- CONTENU -->
    <main class="app-main">

        <?php $eyebrow = 'Content de vous revoir'; $title = 'Bonjour ' . esc($nom) . ' 👋'; ?>
        <?= view('layout/topbar') ?>

        <div class="row g-3">

            <!-- SOLDE -->
            <div class="col-12 col-lg-8">
                <div class="balance-card balance-card--wide">
                    <div class="balance-top">
                        <span class="balance-tag">
                            <span class="tag-icon"><i class="bi bi-wallet2"></i></span>
                            Compte Mobile Money
                        </span>
                        <span class="balance-badge">Actif</span>
                    </div>
                    <div class="balance-label">Solde actuel</div>
                    <div class="balance-value"><?= number_format($solde, 0, ',', ' ') ?> Ar</div>
                    <div class="balance-phone">
                        <i class="bi bi-telephone-fill"></i>
                        <?= esc($telephone) ?>
                    </div>
                </div>
            </div>

            <!-- DEPOT / RETRAIT -->
            <div class="col-12 col-lg-4 d-flex flex-column gap-3">

                <a href="<?= base_url('client/depot') ?>" class="side-action side-action--deposit">
                    <span class="side-action-icon"><i class="bi bi-plus-lg"></i></span>
                    <span class="side-action-text">
                        <strong>Dépôt</strong>
                        <small>Ajouter des fonds</small>
                    </span>
                    <i class="bi bi-chevron-right side-action-chevron"></i>
                </a>

                <a href="<?= base_url('client/retrait') ?>" class="side-action side-action--withdraw">
                    <span class="side-action-icon"><i class="bi bi-dash-lg"></i></span>
                    <span class="side-action-text">
                        <strong>Retrait</strong>
                        <small>Retirer de l'argent</small>
                    </span>
                    <i class="bi bi-chevron-right side-action-chevron"></i>
                </a>

            </div>

        </div>

        <!-- TRANSFERT D'ARGENT -->
        <div class="section-title-row">
            <h3>Transfert d'argent</h3>
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

            <a href="<?= base_url('client/historique') ?>" class="transfer-card transfer-card--history">
                <span class="transfer-icon"><i class="bi bi-clock-history"></i></span>
                <strong>Historique</strong>
                <span>Tous les transferts</span>
            </a>

        </div>

        <!-- DERNIERES OPERATIONS -->
        <div class="section-title-row">
            <h3>Dernières opérations</h3>
            <a href="<?= base_url('client/historique') ?>">Tout voir</a>
        </div>

        <?php if (! empty($operationsRecentes)) : ?>

        <div class="card table-card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Opération</th>
                                <th>Date &amp; heure</th>
                                <th>Statut</th>
                                <th class="text-end">Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($operationsRecentes as $op) : ?>
                            <?php
                                $sens  = ($op['sens'] ?? 'out') === 'in' ? 'in' : 'out';
                                $label = $op['type_operation'] ?? '';
                                $icone = $sens === 'in' ? 'bi-arrow-down-left' : 'bi-arrow-up-right';
                            ?>
                            <tr>
                                <td class="d-flex align-items-center">
                                    <span class="avatar-chip" style="background:<?= $sens === 'in' ? 'var(--mm-success)' : 'var(--mm-primary)' ?>">
                                        <i class="bi <?= $icone ?>"></i>
                                    </span>
                                    <div>
                                        <div class="fw-semibold"><?= esc($label) ?></div>
                                        <div class="text-muted" style="font-size:.78rem;">
                                            <?= $sens === 'in' ? 'Via Agence Mobile' : esc($op['destination'] ?? '') ?>
                                        </div>
                                    </div>
                                </td>
                                <td><?= esc($op['date_operation'] ?? '') ?></td>
                                <td><span class="status-pill status-complete">Succès</span></td>
                                <td class="text-end fw-bold <?= $sens === 'in' ? 'text-success' : 'text-danger' ?>">
                                    <?= $sens === 'in' ? '+' : '-' ?><?= number_format($op['montant'] ?? 0, 0, ',', ' ') ?> Ar
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php else : ?>

        <div class="card">
            <div class="card-body text-center text-muted py-5">
                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                Aucune opération pour le moment.
            </div>
        </div>

        <?php endif; ?>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/app.js') ?>"></script>

</body>
</html>