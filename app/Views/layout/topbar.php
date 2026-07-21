<div class="app-topbar">

    <div class="d-flex align-items-center">
        <button class="mobile-toggle" data-sidebar-toggle type="button" aria-label="Menu">
            <i class="bi bi-list"></i>
        </button>
        <div>
            <span class="eyebrow"><?= esc($eyebrow ?? 'Vue d\'ensemble') ?></span>
            <h2><?= esc($title ?? '') ?></h2>
        </div>
    </div>

    <div class="topbar-search d-none d-md-block">
        <i class="bi bi-search"></i>
        <input type="text" placeholder="Rechercher...">
    </div>

</div>