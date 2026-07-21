<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Opérateurs — Mobile Money</title>

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

        <?php $eyebrow = 'Configuration'; $title = 'Opérateurs'; ?>
        <?= view('layout/topbar') ?>

        <div class="page-header">
            <div>
                <h3>Gestion des opérateurs</h3>
                <p>Ajoutez, modifiez ou retirez les opérateurs mobile money pris en charge.</p>
            </div>
            <button class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                Ajouter opérateur
            </button>
        </div>

        <div class="card table-card">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-phone me-2"></i> Liste des opérateurs
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php foreach ($operateurs as $operateur) : ?>
                            <tr>
                                <td>#<?= esc($operateur['id']) ?></td>
                                <td class="fw-semibold"><?= esc($operateur['nom']) ?></td>
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

                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/js/app.js') ?>"></script>

</body>
</html>
