<div class="d-flex flex-column p-3 bg-dark text-white"
     style="width:260px; min-height:100vh;">

    <h4 class="text-center mb-4">
        📱 Mobile Money
    </h4>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto">

        <li class="nav-item mb-2">
            <a href="<?= base_url('operateur/dashboard') ?>" 
               class="nav-link text-white">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>


        <li class="mb-2">
            <a href="<?= base_url('operateur/clients') ?>" 
               class="nav-link text-white">
                <i class="bi bi-people"></i>
                Clients
            </a>
        </li>


        <li class="mb-2">
            <a href="<?= base_url('operateur/gains') ?>" 
               class="nav-link text-white">
                <i class="bi bi-graph-up"></i>
                Gains
            </a>
        </li>

        <li class="mb-2">
            <a href="<?= base_url('operateur/operateurs') ?>" 
                class="nav-link text-white">
                <i class="bi bi-phone"></i>
                 Opérateurs

            </a>
        </li>

        <li class="mb-2">
            <a href="<?= base_url('operateur/baremes') ?>" 
                class="nav-link text-white">
                <i class="bi bi-phone"></i>
                 Baremes

            </a>
        </li>

        <li class="mb-2">
            <a href="<?= base_url('operateur/prefixes') ?>" 
                class="nav-link text-white">
                <i class="bi bi-phone"></i>
                 prefixes

            </a>
        </li>



    </ul>


    <hr>


    <a href="<?= base_url('/') ?>" class="btn btn-danger">
        <i class="bi bi-box-arrow-right"></i>
        Déconnexion
    </a>


</div>