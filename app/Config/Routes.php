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
$routes->post('Home/privacyPoliceModal', 'Home::privacyPoliceModal');
$routes->post('Home/signUpCustomerProcess', 'Home::signUpCustomerProcess');
$routes->get('Home/verifiedEmail', 'Home::verifiedEmail');
$routes->get('Home/forgotPassword', 'Home::forgotPassword');
$routes->post('Home/sendForgotPasswordEmail', 'Home::sendForgotPasswordEmail');
$routes->get('Home/emailView', 'Home::emailView');

############################## 
## ControlPanel Routes
##############################

# ControlPanel -> Dashboard
$routes->get('ControlPanel/dashboard', 'ControlPanel::dashboard');

# ControlPanel -> Services
$routes->get('ControlPanel/services', 'ControlPanel::services');
$routes->post('ControlPanel/updateServicesOrder', 'ControlPanel::updateServicesOrder');
$routes->post('ControlPanel/showModalService', 'ControlPanel::showModalService');
$routes->post('ControlPanel/createService', 'ControlPanel::createService');
$routes->post('ControlPanel/updateService', 'ControlPanel::updateService');
$routes->post('ControlPanel/changeServiceStatus', 'ControlPanel::changeServiceStatus');
$routes->post('ControlPanel/changeServiceVisibility', 'ControlPanel::changeServiceVisibility');

# ControlPanel -> Customers
$routes->get('ControlPanel/customers', 'ControlPanel::customers');
$routes->post('ControlPanel/showModalCustomer', 'ControlPanel::showModalCustomer');
$routes->post('ControlPanel/createCustomer', 'ControlPanel::createCustomer');
$routes->post('ControlPanel/updateCustomer', 'ControlPanel::updateCustomer');
$routes->post('ControlPanel/processingCustomer', 'ControlPanel::processingCustomer');
$routes->post('ControlPanel/deleteCustomer', 'ControlPanel::deleteCustomer');
$routes->post('ControlPanel/changeCustomerStatus', 'ControlPanel::changeCustomerStatus');
$routes->get('ControlPanel/customerProfile', 'ControlPanel::customerProfile');
$routes->post('ControlPanel/customerTabContent', 'ControlPanel::customerTabContent');
$routes->post('ControlPanel/reloadCustomerInfo', 'ControlPanel::reloadCustomerInfo');
$routes->post('ControlPanel/updateCustomerAccount', 'ControlPanel::updateCustomerAccount');
$routes->post('ControlPanel/updateCustomerProfile', 'ControlPanel::updateCustomerProfile');
$routes->post('ControlPanel/uploadCustomerAvatarProfile', 'ControlPanel::uploadCustomerAvatarProfile');
$routes->post('ControlPanel/removeCustomerAvatarProfile', 'ControlPanel::removeCustomerAvatarProfile');

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
$routes->post('ControlPanel/resendVerifyEmail', 'ControlPanel::resendVerifyEmail');
$routes->post('ControlPanel/resendCompleteAccount', 'ControlPanel::resendCompleteAccount');
$routes->post('ControlPanel/employeeService', 'ControlPanel::employeeService');
$routes->post('ControlPanel/updateEmployeeAccount', 'ControlPanel::updateEmployeeAccount');
$routes->post('ControlPanel/updateEmployeeProfile', 'ControlPanel::updateEmployeeProfile');
$routes->post('ControlPanel/reloadEmployeeInfo', 'ControlPanel::reloadEmployeeInfo');
$routes->post('ControlPanel/removeEmployeeAvatarProfile', 'ControlPanel::removeEmployeeAvatarProfile');
$routes->post('ControlPanel/uploadEmployeeAvatarProfile', 'ControlPanel::uploadEmployeeAvatarProfile');
$routes->post('ControlPanel/updateBussinessDay', 'ControlPanel::updateBussinessDay');
$routes->post('ControlPanel/modalTime', 'ControlPanel::modalTime');
$routes->post('ControlPanel/chartEmployeeTime', 'ControlPanel::chartEmployeeTime');
$routes->post('ControlPanel/createTime', 'ControlPanel::createTime');
$routes->post('ControlPanel/updateTime', 'ControlPanel::updateTime');
$routes->post('ControlPanel/deleteTime', 'ControlPanel::deleteTime');

# ControlPanel -> Company Profile
$routes->get('ControlPanel/profile', 'ControlPanel::profile');
$routes->post('ControlPanel/profileTab', 'ControlPanel::profileTab');
$routes->post('ControlPanel/uploadAvatarProfile', 'ControlPanel::uploadAvatarProfile');
$routes->post('ControlPanel/removeAvatarProfile', 'ControlPanel::removeAvatarProfile');
$routes->post('ControlPanel/updateProfile', 'ControlPanel::updateProfile');
$routes->post('ControlPanel/changeAccessKey', 'ControlPanel::changeAccessKey');
$routes->post('ControlPanel/updateConfig', 'ControlPanel::updateConfig');
$routes->post('ControlPanel/modalSocialNetwork', 'ControlPanel::modalSocialNetwork');
$routes->post('ControlPanel/createSocialNetwork', 'ControlPanel::createSocialNetwork');
$routes->post('ControlPanel/updateSocialNetwork', 'ControlPanel::updateSocialNetwork');
$routes->post('ControlPanel/deleteSocialNetwork', 'ControlPanel::deleteSocialNetwork');
$routes->post('ControlPanel/changeStatusSocialNetwork', 'ControlPanel::changeStatusSocialNetwork');
$routes->post('ControlPanel/getSocialNetworks', 'ControlPanel::getSocialNetworks');
$routes->post('ControlPanel/savePrivacyPolice', 'ControlPanel::savePrivacyPolice');
$routes->post('ControlPanel/uploadCompanyImages', 'ControlPanel::uploadCompanyImages');
$routes->post('ControlPanel/deleteCompanyImages', 'ControlPanel::deleteCompanyImages');

############################## 
## Customer Routes
##############################

$routes->get('Customer/index', 'Customer::index');
$routes->get('Customer/dashboard', 'Customer::dashboard');
$routes->get('Customer/appointment', 'Customer::appointment');
$routes->get('Customer/createAppointment', 'Customer::createAppointment');
$routes->get('Customer/profile', 'Customer::profile');
$routes->post('Customer/profileTab', 'Customer::profileTab');
$routes->post('Customer/employeeAvailability', 'Customer::employeeAvailability');
$routes->post('Customer/employeesByServices', 'Customer::employeesByServices');
$routes->post('Customer/saveAppointment', 'Customer::saveAppointment');
$routes->post('Customer/updateAccount', 'Customer::updateAccount');
$routes->post('Customer/updateProfile', 'Customer::updateProfile');
$routes->post('Customer/uploadAvatarProfile', 'Customer::uploadAvatarProfile');
$routes->post('Customer/removeAvatarProfile', 'Customer::removeAvatarProfile');
$routes->post('Customer/cancelAppointment', 'Customer::cancelAppointment');
$routes->post('Customer/resendVerifyEmail', 'Customer::resendVerifyEmail');
$routes->post('Customer/processingAppointment', 'Customer::processingAppointment');

############################## 
## Employee Routes
##############################

$routes->get('Employee/index', 'Employee::index');
$routes->get('Employee/employeeProfile', 'Employee::employeeProfile');
$routes->post('Employee/showModalEmployee', 'Employee::showModalEmployee');
$routes->post('Employee/changeEmployeeStatus', 'Employee::changeEmployeeStatus');
$routes->post('Employee/employeeProfileTabContent', 'Employee::employeeProfileTabContent');
$routes->post('Employee/employeeService', 'Employee::employeeService');
$routes->post('Employee/updateEmployeeAccount', 'Employee::updateEmployeeAccount');
$routes->post('Employee/updateEmployeeProfile', 'Employee::updateEmployeeProfile');
$routes->post('Employee/reloadEmployeeInfo', 'Employee::reloadEmployeeInfo');
$routes->post('Employee/removeEmployeeAvatarProfile', 'Employee::removeEmployeeAvatarProfile');
$routes->post('Employee/uploadEmployeeAvatarProfile', 'Employee::uploadEmployeeAvatarProfile');
$routes->post('Employee/updateBussinessDay', 'Employee::updateBussinessDay');
$routes->post('Employee/modalTime', 'Employee::modalTime');
$routes->post('Employee/createTime', 'Employee::createTime');
$routes->post('Employee/updateTime', 'Employee::updateTime');
$routes->post('Employee/deleteTime', 'Employee::deleteTime');
