<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/', function() {
//     return redirect()->to('users');
// });
$routes->resource('users');

$routes->resource('posts');

// $routes->get('/', 'Home::index');

// $routes->get('/', 'Home::index');
// $routes->get(
// 	'/posts',
// 	'Posts::index',
// 	// ["filter" => "login"]
// );
// $routes->get(
// 	'/posts/index',
// 	'Posts::index',
// 	// ["filter" => "login"]
// );