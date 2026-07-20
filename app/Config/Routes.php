
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
});


