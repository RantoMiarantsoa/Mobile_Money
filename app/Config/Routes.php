
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'OperateurController::dashboard');

$routes->group('operateur', function($routes) {

    $routes->get('dashboard','OperateurController::dashboard');
    $routes->get('gains','OperateurController::gains');
    $routes->get('clients','OperateurController::clients');
    $routes->get('operateurs','OperateurController::operateurs');
    $routes->get('baremes','OperateurController::baremes');
    $routes->get('prefixes','OperateurController::prefixes');
    $routes->get('comptes-clients','OperateurController::comptesClients');
    $routes->get('gain_autre_operateur','OperateurController::gainAutreOperateur'
);
});



  

// Authentification
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::authentifier');
$routes->get('logout', 'AuthController::logout');


// Espace client
$routes->get(
    'client',
    'ClientController::accueil'
);

$routes->get('client/historique','ClientController::historique');
// Affichage des formulaires
$routes->get('client/depot','ClientController::depot'
);

$routes->get(
    'client/retrait',
    'ClientController::retrait'
);

$routes->get(
    'client/transfert',
    'ClientController::transfert'
);


// Traitement des opérations
$routes->post(
    'client/depot',
    'MvmntController::depot'
);

$routes->post(
    'client/retrait',
    'MvmntController::retrait'
);

$routes->post(
    'client/transfert',
    'MvmntController::transfert'
);
