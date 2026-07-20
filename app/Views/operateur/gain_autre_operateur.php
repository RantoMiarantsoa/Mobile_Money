<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Gain autres opérateurs — Mobile Money</title>

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

        <?php $eyebrow = 'Finance'; $title = 'Gain autres opérateurs'; ?>
        <?= view('layout/topbar') ?>

        <div class="card table-card">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-currency-exchange me-2"></i> Commissions par opérateur
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle text-center mb-0">

                        <thead>
                            <tr>
                                <th>Opérateur</th>
                                <th>Gain commission</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php if (! empty($gains)) : ?>
                            <?php foreach ($gains as $gain) : ?>
                                <tr>
                                    <td class="fw-semibold"><?= esc($gain['operateur']) ?></td>
                                    <td class="fw-bold text-success">
                                        <?= number_format($gain['gain'], 0, ',', ' ') ?> Ar
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                    Aucune commission enregistrée
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
