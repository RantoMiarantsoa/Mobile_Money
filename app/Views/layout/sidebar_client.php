<?php
    // Détermine l'URI courante pour surligner le lien actif du menu
    $currentUri = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    $isActive = function (string $path) use ($currentUri): string {
        return $currentUri === trim($path, '/') ? 'active' : '';
    };
?>

<div class="sidebar">

    <div class="sidebar-brand">
        <div class="logo-badge">
            <i class="bi bi-wallet2"></i>
        </div>
        <div class="brand-text">
            <strong>Mobile Money</strong>
            <span>Espace client</span>
        </div>
    </div>

    <div class="sidebar-section-label">Général</div>

    <ul class="sidebar-nav">

        <li>
            <a href="<?= base_url('client') ?>"
               class="nav-link <?= $isActive('client') ?>">
                <i class="bi bi-house-door"></i>
                Accueil
            </a>
        </li>

        <li>
            <a href="<?= base_url('client/transfert') ?>"
               class="nav-link <?= $isActive('client/transfert') ?>">
                <i class="bi bi-send"></i>
                Transfert
            </a>
        </li>

        <li>
            <a href="<?= base_url('client/historique') ?>"
               class="nav-link <?= $isActive('client/historique') ?>">
                <i class="bi bi-clock-history"></i>
                Historique
            </a>
        </li>

    </ul>

    <div class="sidebar-footer">

        <a href="<?= base_url('logout') ?>" class="btn-logout">
            <i class="bi bi-box-arrow-right"></i>
            Déconnexion
        </a>

    </div>

</div>

<div class="sidebar-backdrop"></div>