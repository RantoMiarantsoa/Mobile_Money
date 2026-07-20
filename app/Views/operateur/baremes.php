<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Gestion des Barèmes — Mobile Money</title>

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

        <?php $eyebrow = 'Configuration'; $title = 'Barèmes'; ?>
        <?= view('layout/topbar') ?>

        <div class="page-header">
            <div>
                <h3>Gestion des barèmes de frais</h3>
                <p>Définissez les frais appliqués selon le type et le montant des opérations.</p>
            </div>
            <button class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                Ajouter un barème
            </button>
        </div>

        <div class="card table-card">

            <div class="card-header bg-dark text-white">
                <i class="bi bi-sliders me-2"></i> Liste des barèmes
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">

                        <thead>
                            <tr>
                                <th>Type opération</th>
                                <th>Montant minimum</th>
                                <th>Montant maximum</th>
                                <th>Frais</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php if (!empty($baremes)): ?>

                            <?php foreach ($baremes as $bareme): ?>

                            <tr>
                                <td class="fw-semibold"><?= esc($bareme['type_operation']) ?></td>
                                <td><?= esc($bareme['montant_min']) ?> Ar</td>
                                <td><?= esc($bareme['montant_max']) ?> Ar</td>
                                <td><span class="badge bg-primary"><?= esc($bareme['frais']) ?> Ar</span></td>
                                <td>
                                    <button class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i>
                                        Modifier
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                        Supprimer
                                    </button>
                                </td>
                            </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                    Aucun barème trouvé
                                </td>
                            </tr>

                        <?php endif; ?>

                        </tbody>

                    </table>

                    <div class="d-flex justify-content-between align-items-center p-3">

                    <div class="text-muted">
                        Affichage de
                        <?= ($pager->getCurrentPage() - 1) * $pager->getPerPage() + 1; ?>
                        à
                        <?= min($pager->getCurrentPage() * $pager->getPerPage(), $pager->getTotal()); ?>
                        sur
                        <?= $pager->getTotal(); ?> barèmes
                    </div>

                    <?= $pager->links() ?>

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