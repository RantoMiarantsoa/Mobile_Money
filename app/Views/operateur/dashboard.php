<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Opérateur — Mobile Money</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

</head>

<body>

<div class="app-shell">

    <!-- SIDEBAR -->
    <?= view('layout/sidebar') ?>

    <!-- CONTENU -->
    <main class="app-main">

        <?php $eyebrow = "Vue d'ensemble"; $title = 'Dashboard Opérateur'; ?>
        <?= view('layout/topbar') ?>

        <div class="page-header">
            <div>
                <h3>Performances du jour</h3>
                <p>Données consolidées pour les opérations institutionnelles.</p>
            </div>
            <div class="date-chip">
                <i class="bi bi-calendar3"></i>
                <?= esc(date('d M Y')) ?>
            </div>
        </div>

        <div class="row g-3">

            <!-- CLIENTS -->
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon bg-icon-primary">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <span class="trend-badge trend-up">
                            <i class="bi bi-arrow-up-short"></i> Actifs
                        </span>
                    </div>
                    <div class="stat-label">Clients</div>
                    <div class="stat-value"><?= esc($nombreClients) ?></div>
                    <div class="stat-sub">Clients enregistrés</div>
                </div>
            </div>

            <!-- OPERATIONS -->
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon bg-icon-info">
                            <i class="bi bi-arrow-left-right"></i>
                        </div>
                        <span class="trend-badge trend-info">
                            <i class="bi bi-graph-up"></i> Volume
                        </span>
                    </div>
                    <div class="stat-label">Opérations</div>
                    <div class="stat-value"><?= esc($nombreOperations) ?></div>
                    <div class="stat-sub">Toutes les opérations</div>
                </div>
            </div>

            <!-- GAIN RETRAIT -->
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon bg-icon-warning">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <span class="trend-badge trend-warn">
                            <i class="bi bi-clock"></i> Retraits
                        </span>
                    </div>
                    <div class="stat-label">Gains retrait</div>
                    <div class="stat-value"><?= number_format($gainRetrait, 0, ',', ' ') ?> Ar</div>
                    <div class="stat-sub">Frais cumulés sur retraits</div>
                </div>
            </div>

            <!-- GAIN TRANSFERT -->
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-card-top">
                        <div class="stat-icon bg-icon-success">
                            <i class="bi bi-send-check-fill"></i>
                        </div>
                        <span class="trend-badge trend-up">
                            <i class="bi bi-check2"></i> Optimisé
                        </span>
                    </div>
                    <div class="stat-label">Gains transfert</div>
                    <div class="stat-value"><?= number_format($gainTransfert, 0, ',', ' ') ?> Ar</div>
                    <div class="stat-sub">Flux intra-plateforme</div>
                </div>
            </div>

        </div>

        <!-- BANNIÈRE PERFORMANCE GLOBALE -->
        <div class="hero-banner">

            <div>
                <div class="hero-tag">
                    <span class="tag-icon"><i class="bi bi-graph-up-arrow"></i></span>
                    Performance globale
                </div>
                <div class="hero-label">Gain total consolidé</div>
                <div class="hero-value"><?= number_format($gainTotal, 0, ',', ' ') ?> Ar</div>
                <div class="hero-caption">Retrait + Transfert</div>
            </div>

            <div class="hero-side">
                <div class="hero-goal-label">
                    <span>Objectif mensuel</span>
                </div>
                <div class="progress">
                    <div class="bar" style="width:75%"></div>
                </div>
                <button type="button" class="btn-hero">
                    <i class="bi bi-bar-chart-line"></i>
                    Analyser les rapports
                </button>
            </div>

        </div>

        <?php if (! empty($activitesRecentes)) : ?>
        <!-- ACTIVITÉS RÉCENTES -->
        <div class="card activity-card">

            <div class="card-header-flex">
                <h5><i class="bi bi-clock-history text-primary"></i> Activités récentes</h5>
                <a href="<?= base_url('operateur/clients') ?>">Tout voir <i class="bi bi-arrow-right"></i></a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Date &amp; heure</th>
                                <th>Client</th>
                                <th>Type</th>
                                <th>Montant</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($activitesRecentes as $activite) : ?>
                            <tr>
                                <td><?= esc($activite['date'] ?? '') ?></td>
                                <td class="d-flex align-items-center">
                                    <span class="avatar-chip" style="background:<?= esc($activite['couleur'] ?? '#4F46E5') ?>">
                                        <?= esc($activite['initiales'] ?? '') ?>
                                    </span>
                                    <span class="fw-semibold"><?= esc($activite['client'] ?? '') ?></span>
                                </td>
                                <td>
                                    <?php $type = $activite['type'] ?? ''; ?>
                                    <span class="type-pill type-<?= esc(strtolower($type)) ?>"><?= esc($type) ?></span>
                                </td>
                                <td class="fw-bold"><?= number_format($activite['montant'] ?? 0, 0, ',', ' ') ?> Ar</td>
                                <td>
                                    <?php $statut = $activite['statut'] ?? 'pending'; ?>
                                    <span class="status-pill status-<?= esc($statut) ?>">
                                        <?= esc($activite['statut_label'] ?? '') ?>
                                    </span>
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