<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

############################## 
## Home Routes
##############################

$routes->get('/', 'Home::index');
$routes->get('Home/controlPanelAuth', 'Home::controlPanelAuth');
$routes->post('Home/controlPanelAuthProcess', 'Home::controlPanelAuthProcess');
$routes->get('Home/customerCreatePassword', 'Home::customerCreatePassword');
$routes->get('Home/employeeCreatePassword', 'Home::employeeCreatePassword');
$routes->post('Home/createPassword', 'Home::createPassword');
$routes->get('Home/signInCustomer', 'Home::signInCustomer');
$routes->get('Home/signInEmployee', 'Home::signInEmployee');
$routes->post('Home/signInCustomerProcess', 'Home::signInCustomerProcess');
$routes->post('Home/signInEmployeeProcess', 'Home::signInEmployeeProcess');
$routes->get('Home/signUpCustomer', 'Home::signUpCustomer');
$routes->post('Home/policyPrivacyModal', 'Home::policyPrivacyModal');
$routes->post('Home/signUpCustomerProcess', 'Home::signUpCustomerProcess');
$routes->get('Home/verifiedEmail', 'Home::verifiedEmail');
$routes->get('Home/forgotPassword', 'Home::forgotPassword');
$routes->post('Home/sendForgotPasswordEmail', 'Home::sendForgotPasswordEmail');
$routes->get('Home/emailView', 'Home::emailView');

############################## 
## ControlPanel Routes
##############################

$routes->get('ControlPanel/dashboard', 'ControlPanel::dashboard');

# ControlPanel -> TPV
$routes->get('ControlPanel/tpv', 'ControlPanel::tpv');

# ControlPanel -> Calendar
$routes->get('ControlPanel/calendar', 'ControlPanel::calendar');

# ControlPanel -> Services
$routes->get('ControlPanel/services', 'ControlPanel::services');
$routes->post('ControlPanel/processingService', 'ControlPanel::processingService');
$routes->post('ControlPanel/showModalService', 'ControlPanel::showModalService');
$routes->post('ControlPanel/createService', 'ControlPanel::createService');
$routes->post('ControlPanel/updateService', 'ControlPanel::updateService');
$routes->post('ControlPanel/changeServiceStatus', 'ControlPanel::changeServiceStatus');

# ControlPanel -> Customers
$routes->get('ControlPanel/customers', 'ControlPanel::customers');
$routes->post('ControlPanel/showModalCustomer', 'ControlPanel::showModalCustomer');
$routes->post('ControlPanel/createCustomer', 'ControlPanel::createCustomer');
$routes->post('ControlPanel/updateCustomer', 'ControlPanel::updateCustomer');
$routes->post('ControlPanel/processingCustomer', 'ControlPanel::processingCustomer');
$routes->post('ControlPanel/deleteCustomer', 'ControlPanel::deleteCustomer');
$routes->post('ControlPanel/changeCustomerStatus', 'ControlPanel::changeCustomerStatus');
$routes->get('ControlPanel/customerProfile', 'ControlPanel::customerProfile');

# ControlPanel -> Employees
$routes->get('ControlPanel/employees', 'ControlPanel::employees');
$routes->get('ControlPanel/employeeProfile', 'ControlPanel::employeeProfile');
$routes->post('ControlPanel/showModalEmployee', 'ControlPanel::showModalEmployee');
$routes->post('ControlPanel/createEmployee', 'ControlPanel::createEmployee');
$routes->post('ControlPanel/updateEmployee', 'ControlPanel::updateEmployee');
$routes->post('ControlPanel/processingEmployee', 'ControlPanel::processingEmployee');
$routes->post('ControlPanel/deleteEmployee', 'ControlPanel::deleteEmployee');
$routes->post('ControlPanel/changeEmployeeStatus', 'ControlPanel::changeEmployeeStatus');
$routes->post('ControlPanel/employeeProfileTabContent', 'ControlPanel::employeeProfileTabContent');
$routes->post('ControlPanel/employeeService', 'ControlPanel::employeeService');
$routes->post('ControlPanel/updateEmployeeAccount', 'ControlPanel::updateEmployeeAccount');
$routes->post('ControlPanel/updateEmployeeProfile', 'ControlPanel::updateEmployeeProfile');
$routes->post('ControlPanel/reloadEmployeeInfo', 'ControlPanel::reloadEmployeeInfo');
$routes->post('ControlPanel/removeEmployeeAvatarProfile', 'ControlPanel::removeEmployeeAvatarProfile');
$routes->post('ControlPanel/uploadEmployeeAvatarProfile', 'ControlPanel::uploadEmployeeAvatarProfile');
$routes->post('ControlPanel/updateBussinessDay', 'ControlPanel::updateBussinessDay');
$routes->post('ControlPanel/modalTime', 'ControlPanel::modalTime');
$routes->post('ControlPanel/createTime', 'ControlPanel::createTime');
$routes->post('ControlPanel/updateTime', 'ControlPanel::updateTime');
$routes->post('ControlPanel/deleteTime', 'ControlPanel::deleteTime');

# ControlPanel -> Reports
$routes->get('ControlPanel/reports', 'ControlPanel::reports');

# ControlPanel -> Schedules
$routes->get('ControlPanel/schedules', 'ControlPanel::schedules');

# ControlPanel -> Profile
$routes->get('ControlPanel/profile', 'ControlPanel::profile');
$routes->post('ControlPanel/profileTab', 'ControlPanel::profileTab');
$routes->post('ControlPanel/uploadAvatarProfile', 'ControlPanel::uploadAvatarProfile');
$routes->post('ControlPanel/removeAvatarProfile', 'ControlPanel::removeAvatarProfile');
$routes->post('ControlPanel/updateProfile', 'ControlPanel::updateProfile');
$routes->post('ControlPanel/changeAccessKey', 'ControlPanel::changeAccessKey');
$routes->post('ControlPanel/updateConfig', 'ControlPanel::updateConfig');

############################## 
## Customer Routes
##############################

$routes->get('Customer/index', 'Customer::index');
$routes->post('Customer/customerTabContent', 'Customer::customerTabContent');
$routes->post('Customer/updateAccount', 'Customer::updateAccount');
$routes->post('Customer/updateProfile', 'Customer::updateProfile');
$routes->post('Customer/uploadAvatarProfile', 'Customer::uploadAvatarProfile');
$routes->post('Customer/removeAvatarProfile', 'Customer::removeAvatarProfile');
$routes->post('Customer/reloadCustomerInfo', 'Customer::reloadCustomerInfo');


############################## 
## Employee Routes
##############################

$routes->get('Employee/index', 'Employee::index');
