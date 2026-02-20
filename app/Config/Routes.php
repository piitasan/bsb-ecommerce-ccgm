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