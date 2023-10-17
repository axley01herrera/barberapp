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
$routes->post('Admin/profileTab', 'Admin::profileTab');
$routes->post('Admin/uploadAvatarProfile', 'Admin::uploadAvatarProfile');
$routes->post('Admin/removeAvatarProfile', 'Admin::removeAvatarProfile'); 
$routes->post('Admin/updateProfile', 'Admin::updateProfile');
$routes->post('Admin/changeAccessKey', 'Admin::changeAccessKey');
$routes->post('Admin/updateConfig', 'Admin::updateConfig');