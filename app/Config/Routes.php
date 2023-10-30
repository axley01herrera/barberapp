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

# Admin Profile
$routes->get('Admin/profile', 'Admin::profile');
$routes->post('Admin/profileTab', 'Admin::profileTab');
$routes->post('Admin/uploadAvatarProfile', 'Admin::uploadAvatarProfile');
$routes->post('Admin/removeAvatarProfile', 'Admin::removeAvatarProfile'); 
$routes->post('Admin/updateProfile', 'Admin::updateProfile');
$routes->post('Admin/changeAccessKey', 'Admin::changeAccessKey');
$routes->post('Admin/updateConfig', 'Admin::updateConfig');

# Admin Services
$routes->get('Admin/services', 'Admin::services');
$routes->post('Admin/showModalNewService', 'Admin::showModalNewService');
$routes->post('Admin/createService', 'Admin::createService');
$routes->post('Admin/updateService', 'Admin::updateService');