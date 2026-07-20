
<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->group('operateur', function($routes) {

    $routes->get('dashboard','OperateurController::dashboard');
    $routes->get('gains','OperateurController::gains');
    $routes->get('clients','OperateurController::clients');


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


// Affichage des formulaires
$routes->get(
    'client/depot',
    'ClientController::depot'
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