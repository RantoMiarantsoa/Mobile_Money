<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'UserController::login');
$routes->get('logout', 'UserController::logout');

$routes->get('/users/create', 'UserController::create');
$routes->post('/users/store', 'UserController::store');

$routes->get('/login', 'UserController::login');
$routes->post('/login', 'UserController::authenticate'); // pour le POST du formulaire

$routes->get('/achat', 'AchatController::index');
$routes->post('/achat/create', 'AchatController::create');
$routes->post('/achat/cloturer', 'AchatController::cloturer');
$routes->get('/achat/caisse/(:num)', 'AchatController::getAllAchatByCaisse/$1');

$routes->get('/caisse','CaisseController::index');

