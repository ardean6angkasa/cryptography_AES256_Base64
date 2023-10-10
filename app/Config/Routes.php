<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/encrypt', 'Home::encrypt');
$routes->get('/create_key_AES265', 'Home::create_key_AES265');