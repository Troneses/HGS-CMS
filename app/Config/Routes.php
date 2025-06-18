<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('users', 'Admin::users');
    $routes->match(['GET', 'POST'], 'users/edit/(:num)', 'Admin::edit/$1');
    $routes->get('users/delete/(:num)', 'Admin::delete/$1');
    $routes->get('posts', 'Admin::posts');
    $routes->match(['GET', 'POST'], 'posts/create', 'Admin::createPost');
    $routes->match(['GET', 'POST'], 'posts/edit/(:num)', 'Admin::editPost/$1');
    $routes->get('posts/delete/(:num)', 'Admin::deletePost/$1');
    $routes->get('categories', 'Admin::categories');
    $routes->match(['GET', 'POST'], 'categories/create', 'Admin::createCategory');
    $routes->match(['GET', 'POST'], 'categories/edit/(:num)', 'Admin::editCategory/$1');
    $routes->get('categories/delete/(:num)', 'Admin::deleteCategory/$1');
});

$routes->get('/profile', 'Profile::index');
$routes->match(['GET', 'POST'], '/profile/edit', 'Profile::edit');

$routes->get('posts', 'Posts::index');
$routes->get('posts/(:segment)', 'Posts::view/$1');

$routes->match(['GET', 'POST'], 'login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->match(['GET', 'POST'], 'register', 'Auth::register');

// Удаляем экспериментальный маршрут
// $routes->match(['GET', 'POST'], 'account/update', 'AccountController::updateProfile');