<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link rel="stylesheet" href="<?= site_url('assets/style.css') ?>">

    <title>Saisie Achat</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<!-- Barre du haut -->
<div class="topbar">
    <span class="caisse-nom">Caisse n° <?= esc($caisse['numero']) ?></span>
    <div class="topbar-right">
        <span><?= esc(session()->get('username')) ?></span>
        <a href="<?= site_url('caisse') ?>">← Changer de caisse</a>
        <a href="<?= site_url('logout') ?>">Déconnexion</a>
    </div>
</div>

<div class="container">

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- Formulaire ajout -->
    <div class="card">
        <h2>Ajouter un article</h2>
        <form action="<?= site_url('achat/create') ?>" method="POST">
            <?= csrf_field() ?>
            <div class="form-row">
                <select name="produit" required>
                    <option value="">-- Choisir un produit --</option>
                    <?php foreach ($produits as $produit): ?>
                        <option value="<?= esc($produit['id']) ?>">
                            <?= esc($produit['designation']) ?> — <?= number_format($produit['prix'], 0, ',', ' ') ?> Ar
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="number" name="quantite" min="1" value="1" required>
                <button type="submit" class="btn btn-success">Ajouter</button>
            </div>
        </form>
    </div>

    <!-- Liste des achats -->
    <div class="card">
        <h2>Articles du client en cours</h2>

        <?php if (empty($achats)): ?>
            <p class="empty">Aucun article pour l'instant.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalGeneral = 0;
                    foreach ($achats as $achat):
                        $ligne = $achat['quantite'] * $achat['prix_unitaire'];
                        $totalGeneral += $ligne;
                    ?>
                    <tr>
                        <td><?= esc($achat['designation']) ?></td>
                        <td><?= number_format($achat['prix_unitaire'], 0, ',', ' ') ?> Ar</td>
                        <td><?= esc($achat['quantite']) ?></td>
                        <td><?= number_format($ligne, 0, ',', ' ') ?> Ar</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total général</td>
                        <td><?= number_format($totalGeneral, 0, ',', ' ') ?> Ar</td>
                    </tr>
                </tfoot>
            </table>

            <div class="actions">
                <form action="<?= site_url('achat/cloturer') ?>" method="POST"
                      onsubmit="return confirm('Clôturer cet achat ? La liste sera vidée pour le prochain client.')">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">✔ Clôturer l'achat</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

</div>
</body>
</html>