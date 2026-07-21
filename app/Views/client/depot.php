<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dépôt — Mobile Money</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

</head>
<body>

<div class="simple-form-shell">
    <div class="simple-form-card">

        <div class="card">

            <div class="card-header bg-success text-white text-center py-3">
                <i class="bi bi-plus-circle-fill fs-4 d-block mb-1"></i>
                <h3 class="h5 mb-0">Faire un dépôt</h3>
            </div>

            <div class="card-body p-4">

                <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><?= esc($error) ?>
                </div>
                <?php endif; ?>

                <?php if (isset($success)): ?>
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill me-2"></i><?= esc($success) ?>
                </div>
                <?php endif; ?>

                <form method="post" action="<?= base_url('client/depot') ?>">

                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Montant</label>
                        <div class="input-group">
                            <input
                                type="number"
                                class="form-control"
                                name="montant"
                                min="1"
                                placeholder="0"
                                required
                            >
                            <span class="input-group-text">Ar</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-check2-circle me-1"></i>
                        Déposer
                    </button>

                </form>

                <div class="text-center mt-3">
                    <a href="<?= base_url('client') ?>" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-left me-1"></i>
                        Retour accueil
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
