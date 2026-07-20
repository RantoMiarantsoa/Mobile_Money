<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Connexion — Mobile Money</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

</head>
<body>

<div class="auth-shell">

    <div class="auth-card">

        <div class="auth-visual">
            <div>
                <div class="logo-badge">
                    <i class="bi bi-wallet2"></i>
                </div>
                <h3>Mobile Money</h3>
                <p>
                    Gérez vos dépôts, retraits et transferts en toute simplicité,
                    où que vous soyez à Madagascar.
                </p>
            </div>

            <div>
                <div class="auth-feature">
                    <i class="bi bi-shield-check"></i>
                    Transactions sécurisées
                </div>
                <div class="auth-feature">
                    <i class="bi bi-lightning-charge-fill"></i>
                    Transferts instantanés
                </div>
                <div class="auth-feature">
                    <i class="bi bi-phone-fill"></i>
                    Compatible MVola, Orange, Airtel
                </div>
            </div>
        </div>

        <div class="auth-form-side">

            <h2 class="mb-1">Connexion</h2>
            <p class="text-muted mb-4">Entrez votre numéro pour accéder à votre compte.</p>

            <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?= esc($error) ?>
            </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('login') ?>">

                <?= csrf_field() ?>

                <div class="mb-4">
                    <label class="form-label">Numéro téléphone</label>
                    <input
                        type="text"
                        name="telephone"
                        class="form-control form-control-lg"
                        placeholder="0341234567"
                        required
                    >
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        Se connecter
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
