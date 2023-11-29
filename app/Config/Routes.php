<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

# Home 
$routes->get('/', 'Home::index');
$routes->get('Home/loginAdmin', 'Home::loginAdmin');
$routes->post('Home/loginAdminProcess', 'Home::loginAdminProcess');
$routes->get('Home/customerCreatePassword', 'Home::customerCreatePassword');
$routes->post('Home/createPassword', 'Home::createPassword');

#### 
## Admin Routes
####
$routes->get('Admin/dashboard', 'Admin::dashboard');

# Admin -> Profile
$routes->get('Admin/profile', 'Admin::profile');
$routes->post('Admin/profileTab', 'Admin::profileTab');
$routes->post('Admin/uploadAvatarProfile', 'Admin::uploadAvatarProfile');
$routes->post('Admin/removeAvatarProfile', 'Admin::removeAvatarProfile');
$routes->post('Admin/updateProfile', 'Admin::updateProfile');
$routes->post('Admin/changeAccessKey', 'Admin::changeAccessKey');
$routes->post('Admin/updateConfig', 'Admin::updateConfig');

# Admin -> Services
$routes->get('Admin/services', 'Admin::services');
$routes->post('Admin/showModalService', 'Admin::showModalService');
$routes->post('Admin/createService', 'Admin::createService');
$routes->post('Admin/updateService', 'Admin::updateService');

# Admin -> Customers
$routes->get('Admin/customers', 'Admin::customers');
$routes->post('Admin/showModalCustomer', 'Admin::showModalCustomer');
$routes->post('Admin/createCustomer', 'Admin::createCustomer');
$routes->post('Admin/updateCustomer', 'Admin::updateCustomer');
$routes->post('Admin/processingCustomer', 'Admin::processingCustomer');
$routes->post('Admin/deleteCustomer', 'Admin::deleteCustomer');
$routes->post('Admin/changeCustomerStatus', 'Admin::changeCustomerStatus');

# Test
$routes->get('Admin/emailView', 'Admin::emailView');

#### 
## End Admin Routes
####
