<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Gestion des Préfixes — Mobile Money</title>

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

        <?php $eyebrow = 'Configuration'; $title = 'Préfixes'; ?>
        <?= view('layout/topbar') ?>

        <div class="page-header">
            <div>
                <h3>Gestion des préfixes</h3>
                <p>Associez chaque préfixe téléphonique à son opérateur.</p>
            </div>
            <button class="btn btn-primary">
                <i class="bi bi-plus-circle"></i>
                Ajouter un préfixe
            </button>
        </div>

        <!-- FILTRE OPERATEUR -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Opérateur</label>

                        <select class="form-select">
                            <option value="">Tous les opérateurs</option>

                            <?php if (isset($operateurs)): ?>
                                <?php foreach ($operateurs as $operateur): ?>
                                <option value="<?= esc($operateur['id']) ?>">
                                    <?= esc($operateur['nom']) ?>
                                </option>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLE PREFIXES -->
        <div class="card table-card">

            <div class="card-header bg-dark text-white">
                <i class="bi bi-hash me-2"></i> Liste des préfixes
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Opérateur</th>
                                <th>Préfixe</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php if (!empty($prefixes)): ?>

                            <?php foreach ($prefixes as $prefixe): ?>

                            <tr>
                                <td>#<?= esc($prefixe['id']) ?></td>
                                <td class="fw-semibold"><?= esc($prefixe['operateur']) ?></td>
                                <td><span class="badge bg-primary"><?= esc($prefixe['code']) ?></span></td>
                                <td>
                                    <button class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                        Modifier
                                    </button>
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                        Supprimer
                                    </button>
                                </td>
                            </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                    Aucun préfixe trouvé
                                </td>
                            </tr>

                        <?php endif; ?>

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