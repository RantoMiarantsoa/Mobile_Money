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
            <span>Espace opérateur</span>
        </div>
    </div>

    <div class="sidebar-section-label">Général</div>

    <ul class="sidebar-nav">

        <li>
            <a href="<?= base_url('operateur/dashboard') ?>"
               class="nav-link <?= $isActive('operateur/dashboard') ?>">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="<?= base_url('operateur/clients') ?>"
               class="nav-link <?= $isActive('operateur/clients') ?>">
                <i class="bi bi-people"></i>
                Clients
            </a>
        </li>

        <li>
            <a href="<?= base_url('operateur/comptes-clients') ?>"
               class="nav-link <?= $isActive('operateur/comptes-clients') ?>">
                <i class="bi bi-wallet2"></i>
                Comptes clients
            </a>
        </li>

        <li>
            <a href="<?= base_url('operateur/gains') ?>"
               class="nav-link <?= $isActive('operateur/gains') ?>">
                <i class="bi bi-graph-up-arrow"></i>
                Gains
            </a>
        </li>

        <li>
            <a href="<?= base_url('operateur/gain_autre_operateur') ?>"
               class="nav-link <?= $isActive('operateur/gain_autre_operateur') ?>">
                <i class="bi bi-currency-exchange"></i>
                Gains opérateurs
            </a>
        </li>

    </ul>

    <div class="sidebar-section-label">Configuration</div>

    <ul class="sidebar-nav" style="flex:none;">

        <li>
            <a href="<?= base_url('operateur/operateurs') ?>"
               class="nav-link <?= $isActive('operateur/operateurs') ?>">
                <i class="bi bi-phone"></i>
                Opérateurs
            </a>
        </li>

        <li>
            <a href="<?= base_url('operateur/baremes') ?>"
               class="nav-link <?= $isActive('operateur/baremes') ?>">
                <i class="bi bi-sliders"></i>
                Barèmes
            </a>
        </li>

        <li>
            <a href="<?= base_url('operateur/prefixes') ?>"
               class="nav-link <?= $isActive('operateur/prefixes') ?>">
                <i class="bi bi-hash"></i>
                Préfixes
            </a>
        </li>

    </ul>

    <div class="sidebar-footer">

        <a href="<?= base_url('/') ?>" class="btn-logout">
            <i class="bi bi-box-arrow-right"></i>
            Déconnexion
        </a>

    </div>

</div>

<div class="sidebar-backdrop"></div>