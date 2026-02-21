<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('bsb_signin', 'Auth::signin');
$routes->get('bsb_signup', 'Auth::signup');
$routes->post('bsb_signin', 'Auth::processSignin');
$routes->post('bsb_signup', 'Auth::processSignup');
$routes->get('signout', 'Auth::signout');

$routes->get('profile', 'Profile::index');
$routes->get('history', 'History::index');

$routes->get('wishlist', 'Wishlist::index');
$routes->post('wishlist/add/(:num)', 'Wishlist::add/$1');
$routes->get('wishlist/remove/(:num)', 'Wishlist::remove/$1');
$routes->post('wishlist/toggle', 'Wishlist::toggle');

$routes->get('payment-method', 'PaymentMethod::index');
$routes->post('payment-method/add', 'PaymentMethod::add');
$routes->get('payment-method/delete/(:num)', 'PaymentMethod::delete/$1');
$routes->get('payment-method/set-default/(:num)', 'PaymentMethod::setDefault/$1');