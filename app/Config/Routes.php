<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public Routes (Anyone can view task list)
$routes->get('/', 'Tasks::index');
$routes->get('tasks', 'Tasks::index');

// Auth Routes
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');

// Protected Routes (Login required for CRUD & archiving)
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('tasks/new', 'Tasks::new');
    $routes->post('tasks/create', 'Tasks::create');
    $routes->get('tasks/edit/(:num)', 'Tasks::edit/$1');
    $routes->post('tasks/update/(:num)', 'Tasks::update/$1');
    $routes->get('tasks/archive/(:num)', 'Tasks::archive/$1');
});