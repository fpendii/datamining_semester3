<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::dashboard');
$routes->post('/identifikasi-knn', 'Home::index');
$routes->get('/identifikasi-knn', 'Home::index');
$routes->get('/knn', 'Home::knn');
$routes->get('/tambah-data', 'TambahDataController::index');
$routes->post('/tambah-data', 'TambahDataController::index');
$routes->post('/insert-data', 'TambahDataController::TambahData');
$routes->post('/insert-data/(:segment)', 'TambahDataController::TambahData/$1');
$routes->post('/identifikasi', 'identifikasi::index');
