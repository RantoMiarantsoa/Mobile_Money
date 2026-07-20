
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