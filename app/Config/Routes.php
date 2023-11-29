<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

#### 
## Home Routes
####

$routes->get('/', 'Home::index');
$routes->get('Home/loginAdmin', 'Home::loginAdmin');
$routes->post('Home/loginAdminProcess', 'Home::loginAdminProcess');
$routes->get('Home/customerCreatePassword', 'Home::customerCreatePassword');
$routes->post('Home/createPassword', 'Home::createPassword');

#### 
## ControlPanel Routes
####
$routes->get('ControlPanel/dashboard', 'ControlPanel::dashboard');

# Admin -> Profile
$routes->get('ControlPanel/profile', 'ControlPanel::profile');
$routes->post('ControlPanel/profileTab', 'ControlPanel::profileTab');
$routes->post('ControlPanel/uploadAvatarProfile', 'ControlPanel::uploadAvatarProfile');
$routes->post('ControlPanel/removeAvatarProfile', 'ControlPanel::removeAvatarProfile');
$routes->post('ControlPanel/updateProfile', 'ControlPanel::updateProfile');
$routes->post('ControlPanel/changeAccessKey', 'ControlPanel::changeAccessKey');
$routes->post('ControlPanel/updateConfig', 'ControlPanel::updateConfig');

# Admin -> Services
$routes->get('ControlPanel/services', 'ControlPanel::services');
$routes->post('ControlPanel/showModalService', 'ControlPanel::showModalService');
$routes->post('ControlPanel/createService', 'ControlPanel::createService');
$routes->post('ControlPanel/updateService', 'ControlPanel::updateService');

# Admin -> Customers
$routes->get('ControlPanel/customers', 'ControlPanel::customers');
$routes->post('ControlPanel/showModalCustomer', 'ControlPanel::showModalCustomer');
$routes->post('ControlPanel/createCustomer', 'ControlPanel::createCustomer');
$routes->post('ControlPanel/updateCustomer', 'ControlPanel::updateCustomer');
$routes->post('ControlPanel/processingCustomer', 'ControlPanel::processingCustomer');
$routes->post('ControlPanel/deleteCustomer', 'ControlPanel::deleteCustomer');
$routes->post('ControlPanel/changeCustomerStatus', 'ControlPanel::changeCustomerStatus');

# Test
$routes->get('ControlPanel/emailView', 'ControlPanel::emailView');

#### 
## End Admin Routes
####
