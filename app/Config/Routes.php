<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

# Home 
$routes->get('/', 'Home::index');
$routes->get('Home/loginAdmin', 'Home::loginAdmin');
$routes->post('Home/loginAdminProcess', 'Home::loginAdminProcess');

# Admin 
$routes->get('Admin/dashboard', 'Admin::dashboard');
$routes->get('Admin/profile', 'Admin::profile');