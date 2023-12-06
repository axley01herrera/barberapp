<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\MainModel;
use App\Models\ControlPanelModel;

class ControlPanel extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objConfigModel;
    protected $objControlPanelModel;
    protected $objMainModel;
    protected $config;
    protected $profile;
    protected $objEmail;

    public function __construct()
    {
        # Session
        $this->objSession = session();

        # Models
        $this->objConfigModel = new ConfigModel;
        $this->objControlPanelModel = new ControlPanelModel;
        $this->objMainModel = new MainModel;

        # Config
        $this->config = $this->objConfigModel->getConfig(1);
        $this->profile = $this->objControlPanelModel->getProfile(1);

        # Email Settings
        $emailConfig = array();
        $emailConfig['protocol'] = EMAIL_PROTOCOL;
        $emailConfig['SMTPHost'] = EMAIL_SMTP_HOST;
        $emailConfig['SMTPUser'] = EMAIL_SMTP_USER;
        $emailConfig['SMTPPass'] = EMAIL_SMTP_PASSWORD;
        $emailConfig['SMTPPort'] = EMAIL_SMTP_PORT;
        $emailConfig['SMTPCrypto'] = EMAIL_SMTP_CRYPTO;
        $emailConfig['mailType'] = EMAIL_MAIL_TYPE;

        # Services
        $this->objRequest = \Config\Services::request();
        $this->objEmail = \Config\Services::email($emailConfig);

        # Set Lang
        $this->objRequest->setLocale($this->config[0]->lang);

        # Set TimeZone
        date_default_timezone_set($this->config[0]->timezone);

        # Load Helpers
        helper('Site');
    }

    ##############################
    # Section Dashboard
    ##############################

    public function dashboard()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $data = array();
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        $data['activeDashboard'] = "active";
        $data['page'] = 'controlPanel/dashboard/mainDashboard';

        return view('ControlPanel/mainCpanel', $data);
    }

    ##############################
    # Section TPV
    ##############################

    public function tpv()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $data = array();
        # data
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        $data['activeTPV'] = "active";
        $data['uniqid'] = uniqid();
        # page
        $data['page'] = 'controlPanel/tpv/mainTPV';

        return view('ControlPanel/mainCpanel', $data);
    }

    ##############################
    # Section Calendar
    ##############################

    public function calendar()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $data = array();
        # data
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        $data['activeCalendar'] = "active";
        $data['uniqid'] = uniqid();
        # page
        $data['page'] = 'controlPanel/calendar/mainCalendar';

        return view('ControlPanel/mainCpanel', $data);
    }

    ##############################
    # Section Services
    ##############################

    public function services()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $data = array();
        # data
        $data['uniqid'] = uniqid();
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        $data['services'] = $this->objMainModel->objData('service');
        # menu
        $data['activeServices'] = "active";
        # page
        $data['page'] = 'controlPanel/services/mainServices';

        return view('ControlPanel/mainCpanel', $data);
    } // ok

    public function showModalService()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $data = array();
        $data['config'] = $this->config;
        $data['action'] = $this->objRequest->getPost('action');
        $data['uniqid'] = uniqid();

        if ($data['action'] == "create")
            $data['modalTitle'] = lang("Text.serv_new");
        else {
            $data['modalTitle'] = lang("Text.serv_update");
            $data['service'] = $this->objMainModel->objData('service', 'id', $this->objRequest->getPost('id'))[0];
        }

        return view('ControlPanel/services/modalService', $data);
    } // ok

    public function createService()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "session expired";
            return json_encode($result);
        }

        $data = array();
        $data['title'] = htmlspecialchars(trim($this->objRequest->getPost('title')));
        $data['price'] = htmlspecialchars(trim($this->objRequest->getPost('price')));
        $data['description'] = htmlspecialchars(trim($this->objRequest->getPost('description')));

        $checkDuplicate = $this->objMainModel->objCheckDuplicate('service', 'title', $data['title']);

        if (empty($checkDuplicate)) {
            $result = $this->objMainModel->objCreate('service', $data);
            return json_encode($result);
        } else {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "duplicate";
            return json_encode($result);
        }
    } // ok

    public function updateService()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "session expired";
            return json_encode($result);
        }

        $data = array();
        $data['title'] = htmlspecialchars(trim($this->objRequest->getPost('title')));
        $data['price'] = htmlspecialchars(trim($this->objRequest->getPost('price')));
        $data['description'] = htmlspecialchars(trim($this->objRequest->getPost('description')));

        $checkDuplicate = $this->objMainModel->objCheckDuplicate('service', 'title', $data['title'], $this->objRequest->getPost('id'));

        if (empty($checkDuplicate)) {
            $result = $this->objMainModel->objUpdate('service', $data, $this->objRequest->getPost('id'));
            return json_encode($result);
        } else {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "duplicate";
            return json_encode($result);
        }
    } // ok

    ##############################
    ## Section Customer
    ##############################

    public function customers()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $data = array();
        # data
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        $data['activeCustomers'] = "active";
        $data['uniqid'] = uniqid();
        # page
        $data['page'] = 'controlPanel/customers/mainCustomers';

        return view('ControlPanel/mainCpanel', $data);
    } // ok

    public function processingCustomer()
    {
        $dataTableRequest = $_REQUEST;

        $params = array();
        $params['draw'] = $dataTableRequest['draw'];
        $params['start'] = $dataTableRequest['start'];
        $params['length'] = $dataTableRequest['length'];
        $params['search'] = $dataTableRequest['search']['value'];
        $params['sortColumn'] = $dataTableRequest['order'][0]['column'];
        $params['sortDir'] = $dataTableRequest['order'][0]['dir'];

        $row = array();
        $totalRecords = 0;

        $result = $this->objControlPanelModel->getCustomersProcessingData($params);
        $totalRows = sizeof($result);

        for ($i = 0; $i < $totalRows; $i++) {

            $emailStatus = '<span class="badge small badge-danger"><i class="bi bi-envelope-dash text-dark me-1" title="' . lang('Text.not_verified') . '"></i></span>';
            if ($result[$i]->emailVerified == 1)
                $emailStatus = '<span class="badge small badge-success"><i class="bi bi-envelope-check text-dark me-1" title="' . lang('Text.verified') . '"></i></span>';

            $status = '<span class="badge small badge-danger">' . lang('Text.inactive') . '</span>';
            $btnChangeStatus = '<button class="btn btn-sm btn-light btn-active-color-success m-1 change-status" data-customer-id="' . $result[$i]->id . '" data-status="1" title="' . lang('Text.change_status') . '"><span class="bi bi-arrow-clockwise"></span></button>';

            if ($result[$i]->status == 1) {
                $status = '<span class="badge small badge-success">' . lang('Text.active') . '</span>';
                $btnChangeStatus = '<button class="btn btn-sm btn-light btn-active-color-danger m-1 change-status" data-customer-id="' . $result[$i]->id . '" data-status="0" title="' . lang('Text.change_status') . '"><span class="bi bi-arrow-clockwise"></span></button>';
            }

            $btnEdit = '<button class="btn btn-sm btn-light btn-active-color-warning m-1 edit-customer" data-customer-id="' . $result[$i]->id . '" title="' . lang('Text.btn_edit') . '"><span class="bi bi-pencil-square"></span></button>';
            $btnDelete = '<button class="btn btn-sm btn-light btn-active-color-danger m-1 delete-customer" data-customer-id="' . $result[$i]->id . '" title="' . lang('Text.btn_delete') . '"><span class="bi bi-trash-fill"></span></button>';

            $col = array();
            $col['name'] = '<a href="' . base_url('ControlPanel/customerProfile?id=') . $result[$i]->id . '">' . $result[$i]->name . '</a>';
            $col['lastName'] = $result[$i]->lastName;
            $col['email'] = $result[$i]->email;
            $col['status'] = $status;
            $col['emailVerified'] = $emailStatus;
            $col['action'] = $btnChangeStatus . $btnEdit . $btnDelete;

            $row[$i] =  $col;
        }

        if ($totalRows > 0) {
            if (empty($params['search']))
                $totalRecords = $this->objControlPanelModel->getTotalCustomers();
            else
                $totalRecords = $totalRows;
        }

        $data = array();
        $data['draw'] = $dataTableRequest['draw'];
        $data['recordsTotal'] = intval($totalRecords);
        $data['recordsFiltered'] = intval($totalRecords);
        $data['data'] = $row;

        return json_encode($data);
    } // ok

    public function customerProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $data = array();
        # data
        $data['profile'] = $this->profile;
        $data['config'] = $this->config;
        $data['activeCustomers'] = "active";
        $data['customer'] = $this->objMainModel->objData('customer', 'id', $this->objRequest->getPostGet('id'));
        # page
        $data['page'] = 'controlPanel/customers/principalCustomerProfile';

        return view('ControlPanel/mainCpanel', $data);
    }

    public function showModalCustomer()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        # params
        $action = $this->objRequest->getPost('action');
        $customerID = $this->objRequest->getPost('customerID');

        $data = array();
        $data['config'] = $this->config;
        $data['action'] = $action;
        $data['uniqid'] = uniqid();

        if ($action == "create")
            $data['modalTitle'] = lang("Text.cust_modal_title_new");
        else if ($action == "update") {
            $data['modalTitle'] = lang("Text.cust_modal_title_update");
            $data['customer'] = $this->objMainModel->objData('customer', 'id', $customerID)[0];
            $data['customerID'] = $customerID;
        }

        return view('ControlPanel/customers/modalCustomer', $data);
    } // ok

    public function createCustomer()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $name = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $lastName = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $email = strtolower(htmlspecialchars(trim($this->objRequest->getPost('email'))));

        $checkDuplicate = $this->objMainModel->objCheckDuplicate('customer', 'email', $email);

        if (empty($checkDuplicate)) {
            $data = array();
            $data['name'] = $name;
            $data['lastName'] = $lastName;
            $data['email'] = $email;
            $data['token'] = md5(uniqid());

            $result = $this->objMainModel->objCreate('customer', $data);
            $profile = $this->objControlPanelModel->getProfile(1);

            $dataEmail = array();
            $dataEmail['pageTitle'] = $profile[0]->company_name;
            $dataEmail['person'] = $name . ' ' . $lastName;
            $dataEmail['url'] = base_url('Home/customerCreatePassword?token=') . $data['token'];
            $dataEmail['companyPhone'] = $profile[0]->phone1;
            $dataEmail['companyEmail'] = $profile[0]->email;

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $profile[0]->company_name);
            $this->objEmail->setTo($email);
            $this->objEmail->setSubject('Complete Your Account');
            $this->objEmail->setMessage(view('email/createCustomerByAdmin', $dataEmail), []);

            if ($this->objEmail->send(false))
                $response['error'] = 0;
            else {
                $response['error'] = 1;
                $response['msg'] = 'ERROR_SEND_EMAIL';
            }

            return json_encode($response);
        } else {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "ERROR_DUPLICATE_EMAIL";

            return json_encode($result);
        }
    } // ok

    public function updateCustomer()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $name = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $lastName = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $email = strtolower(htmlspecialchars(trim($this->objRequest->getPost('email'))));
        $customerID = htmlspecialchars(trim($this->objRequest->getPost('customerID')));

        $checkDuplicate = $this->objMainModel->objCheckDuplicate('customer', 'email', $email, $customerID);

        if (empty($checkDuplicate)) {
            $data = array();
            $data['name'] = $name;
            $data['lastName'] = $lastName;
            $data['email'] = $email;
            $data['token'] = md5(uniqid());

            $result = $this->objMainModel->objUpdate('customer', $data, $customerID);

            return json_encode($result);
        } else {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "ERROR_DUPLICATE_EMAIL";

            return json_encode($result);
        }
    } // ok

    public function deleteCustomer()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $customerID = htmlspecialchars(trim($this->objRequest->getPost('customerID')));

        $data = array();
        $data['status'] = 0;
        $data['deleted'] = 1;

        $result = $this->objMainModel->objUpdate('customer', $data, $customerID);

        return json_encode($result);
    } // ok

    public function changeCustomerStatus()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $customerID = htmlspecialchars(trim($this->objRequest->getPost('customerID')));
        $status = htmlspecialchars(trim($this->objRequest->getPost('status')));

        $data = array();
        $data['status'] = $status;

        $result = $this->objMainModel->objUpdate('customer', $data, $customerID);

        return json_encode($result);
    } // ok

    ##############################
    # Section Employees
    ##############################

    public function employees()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $data = array();
        # data
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        # menu
        $data['activeEmployees'] = "active";
        $data['uniqid'] = uniqid();
        # page
        $data['page'] = 'controlPanel/employees/mainEmployees';

        return view('ControlPanel/mainCpanel', $data);
    } // ok

    public function processingEmployee()
    {
        $dataTableRequest = $_REQUEST;

        $params = array();
        $params['draw'] = $dataTableRequest['draw'];
        $params['start'] = $dataTableRequest['start'];
        $params['length'] = $dataTableRequest['length'];
        $params['search'] = $dataTableRequest['search']['value'];
        $params['sortColumn'] = $dataTableRequest['order'][0]['column'];
        $params['sortDir'] = $dataTableRequest['order'][0]['dir'];

        $row = array();
        $totalRecords = 0;

        $result = $this->objControlPanelModel->getEmployeesProcessingData($params);
        $totalRows = sizeof($result);

        for ($i = 0; $i < $totalRows; $i++) {

            $emailStatus = '<span class="badge small badge-danger"><i class="bi bi-envelope-dash text-dark me-1" title="' . lang('Text.not_verified') . '"></i></span>';
            if ($result[$i]->emailVerified == 1)
                $emailStatus = '<span class="badge small badge-success"><i class="bi bi-envelope-check text-dark me-1" title="' . lang('Text.verified') . '"></i></span>';


            $status = '<span class="badge small badge-danger">' . lang('Text.inactive') . '</span>';
            $btnChangeStatus = '<button class="btn btn-sm btn-light btn-active-color-success m-1 change-status" data-employee-id="' . $result[$i]->id . '" data-status="1" title="' . lang('Text.change_status') . '"><span class="bi bi-arrow-clockwise"></span></button>';

            if ($result[$i]->status == 1) {
                $status = '<span class="badge small badge-success">' . lang('Text.active') . '</span>';
                $btnChangeStatus = '<button class="btn btn-sm btn-light btn-active-color-danger m-1 change-status" data-employee-id="' . $result[$i]->id . '" data-status="0" title="' . lang('Text.change_status') . '"><span class="bi bi-arrow-clockwise"></span></button>';
            }

            $btnEdit = '<button class="btn btn-sm btn-light btn-active-color-warning m-1 edit-employee" data-employee-id="' . $result[$i]->id . '" title="' . lang('Text.btn_edit') . '"><span class="bi bi-pencil-square"></span></button>';
            $btnDelete = '<button class="btn btn-sm btn-light btn-active-color-danger m-1 delete-employee" data-employee-id="' . $result[$i]->id . '" title="' . lang('Text.btn_delete') . '"><span class="bi bi-trash-fill"></span></button>';

            $col = array();
            $col['name'] = '<a href="' . base_url('ControlPanel/employeeProfile?id=') . $result[$i]->id . '">' . $result[$i]->name . '</a>';
            $col['lastName'] = $result[$i]->lastName;
            $col['email'] = $result[$i]->email;
            $col['status'] = $status;
            $col['emailVerified'] = $emailStatus;
            $col['action'] = $btnChangeStatus . $btnEdit . $btnDelete;

            $row[$i] =  $col;
        }

        if ($totalRows > 0) {
            if (empty($params['search']))
                $totalRecords = $this->objControlPanelModel->getTotalEmployees();
            else
                $totalRecords = $totalRows;
        }

        $data = array();
        $data['draw'] = $dataTableRequest['draw'];
        $data['recordsTotal'] = intval($totalRecords);
        $data['recordsFiltered'] = intval($totalRecords);
        $data['data'] = $row;

        return json_encode($data);
    } // ok

    public function showModalEmployee()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        # params
        $action = $this->objRequest->getPost('action');
        $employeeID = $this->objRequest->getPost('employeeID');

        $data = array();
        $data['config'] = $this->config;
        $data['action'] = $action;
        $data['uniqid'] = uniqid();

        if ($action == "create")
            $data['modalTitle'] = lang("Text.emp_modal_title_new");
        else if ($action == "update") {
            $data['modalTitle'] = lang("Text.emp_modal_title_update");
            $data['employee'] = $this->objMainModel->objData('employee', 'id', $employeeID)[0];
            $data['employeeID'] = $employeeID;
        }

        return view('ControlPanel/employees/modalEmployee', $data);
    } // ok

    public function createEmployee()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $name = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $lastName = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $email = strtolower(htmlspecialchars(trim($this->objRequest->getPost('email'))));

        $checkDuplicate = $this->objMainModel->objCheckDuplicate('employee', 'email', $email);

        if (empty($checkDuplicate)) {
            $data = array();
            $data['name'] = $name;
            $data['lastName'] = $lastName;
            $data['email'] = $email;
            $data['token'] = md5(uniqid());

            $result = $this->objMainModel->objCreate('employee', $data);

            $dataEmail = array();
            $dataEmail['pageTitle'] = $this->profile[0]->company_name;
            $dataEmail['person'] = $name . ' ' . $lastName;
            $dataEmail['url'] = base_url('Home/employeeCreatePassword?token=') . $data['token'];
            $dataEmail['companyPhone'] = $this->profile[0]->phone1;
            $dataEmail['companyEmail'] = $this->profile[0]->email;

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $this->profile[0]->company_name);
            $this->objEmail->setTo($email);
            $this->objEmail->setSubject('Complete Your Account');
            $this->objEmail->setMessage(view('email/createEmployeeByAdmin', $dataEmail), []);

            if ($this->objEmail->send(false))
                $response['error'] = 0;
            else {
                $response['error'] = 1;
                $response['msg'] = 'ERROR_SEND_EMAIL';
            }

            return json_encode($result);
        } else {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "ERROR_DUPLICATE_EMAIL";

            return json_encode($result);
        }
    } // ok

    public function updateEmployee()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $name = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $lastName = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $email = strtolower(htmlspecialchars(trim($this->objRequest->getPost('email'))));
        $employeeID = htmlspecialchars(trim($this->objRequest->getPost('employeeID')));

        $checkDuplicate = $this->objMainModel->objCheckDuplicate('employee', 'email', $email, $employeeID);

        if (empty($checkDuplicate)) {
            $data = array();
            $data['name'] = $name;
            $data['lastName'] = $lastName;
            $data['email'] = $email;
            $data['token'] = md5(uniqid());

            $result = $this->objMainModel->objUpdate('employee', $data, $employeeID);

            return json_encode($result);
        } else {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "ERROR_DUPLICATE_EMAIL";

            return json_encode($result);
        }
    } // ok

    public function deleteEmployee()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $employeeID = htmlspecialchars(trim($this->objRequest->getPost('employeeID')));

        $data = array();
        $data['status'] = 0;
        $data['deleted'] = 1;

        $result = $this->objMainModel->objUpdate('employee', $data, $employeeID);

        return json_encode($result);
    } // ok

    public function changeEmployeeStatus()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $employeeID = htmlspecialchars(trim($this->objRequest->getPost('employeeID')));

        $data = array();
        $data['status'] = htmlspecialchars(trim($this->objRequest->getPost('status')));

        $result = $this->objMainModel->objUpdate('employee', $data, $employeeID);

        return json_encode($result);
    } // ok

    public function employeeProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $data = array();
        # data
        $data['profile'] = $this->profile;
        $data['config'] = $this->config;
        $data['activeEmployees'] = "active";
        $data['employee'] = $this->objMainModel->objData('employee', 'id', $this->objRequest->getPostGet('id'));
        # page
        $data['page'] = 'controlPanel/employees/employeeProfile/main';

        return view('ControlPanel/mainCpanel', $data);
    } // ok

    public function employeeProfileTabContent()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        # params
        $employeeID = $this->objRequest->getPost('employeeID');
        $tab = $this->objRequest->getPost('tab');

        $view = "";

        $data = array();
        # data
        $data['employeeID'] = $employeeID;
        $data['config'] = $this->config;

        switch ($tab) {
            case 'tab-overview':
                # page
                $view = "controlPanel/employees/employeeProfile/tabContent/tabOverview";
                break;
            case 'tab-services':
                # page
                $data['services'] = $this->objMainModel->objData('service');
                $data['employeeServices'] = $this->objMainModel->objData('employee_service', 'employeeID', $employeeID);
                $view = "controlPanel/employees/employeeProfile/tabContent/tabService";
                break;
            case 'tab-schedule':
                $view = "controlPanel/employees/employeeProfile/tabContent/tabSchedule";
                break;
        }

        return view($view, $data);
    }

    public function employeeService()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $checked = $this->objRequest->getPost('checked');
        $serviceID = $this->objRequest->getPost('serviceID');
        $employeeID = $this->objRequest->getPost('employeeID');

        if ($checked == 0) { // Add Service To Employee
            $data = array();
            $data['serviceID'] = $serviceID;
            $data['employeeID'] = $employeeID;
            $result = $this->objMainModel->objCreate('employee_service', $data);
            return json_encode($result);
        } else if ($checked == 1) { // Remove Service To Employee
            $result = $this->objControlPanelModel->removeEmployeeService($employeeID, $serviceID);
            return json_encode($result);
        }
    } // ok

    ##############################
    # Section Reports
    ##############################

    public function reports()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $data = array();
        # data
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        $data['activeReports'] = "active";
        $data['uniqid'] = uniqid();
        # page
        $data['page'] = 'controlPanel/reports/mainReports';

        return view('ControlPanel/mainCpanel', $data);
    }

    ##############################
    # Section Schedules
    ##############################

    public function schedules()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $data = array();
        # data
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        $data['activeSchedules'] = "active";
        $data['uniqid'] = uniqid();
        # page
        $data['page'] = 'controlPanel/schedules/mainSchedules';

        return view('ControlPanel/mainCpanel', $data);
    }

    ##############################
    # Section Profile
    ##############################

    public function profile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        # params
        $tab = $this->objRequest->getPostGet('tab');

        if (empty($tab))
            $tab = "profile";

        $data = array();
        # menu
        $data['activeProfile'] = "active";
        # tab
        $data['tab'] = $tab;
        # config
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        # page
        $data['page'] = 'controlPanel/profile/mainProfile';

        return view('ControlPanel/mainCpanel', $data);
    } // ok

    public function profileTab()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $tab = $this->objRequest->getPost('tab');

        switch ($tab) {
            case 'profile':
                $view = "ControlPanel/profile/tabs/profileInfo";
                $data = array();
                $data['profile'] = $this->profile;
                break;
            case 'key':
                $view = "ControlPanel/profile/tabs/key";
                break;
            case 'config':
                $view = "ControlPanel/profile/tabs/config";
                $data = array();
                $data['config'] = $this->config;
                break;
        }

        $data['uniqid'] = uniqid();

        return view($view, $data);
    } // ok

    public function uploadAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        return json_encode($this->objMainModel->uploadFile('profile', 1, 'avatar', $_FILES['file']));
    } // ok

    public function removeAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        $data = array();
        $data['avatar'] = '';

        return json_encode($this->objMainModel->objUpdate('profile', $data, 1));
    } // ok

    public function updateProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        $data = array();
        $data['company_name'] = htmlspecialchars(trim($this->objRequest->getPost('company')));
        $data['company_type'] = htmlspecialchars(trim($this->objRequest->getPost('type')));
        $data['email'] = htmlspecialchars(trim($this->objRequest->getPost('email')));
        $data['phone1'] = htmlspecialchars(trim($this->objRequest->getPost('phone1')));
        $data['phone2'] = htmlspecialchars(trim($this->objRequest->getPost('phone2')));
        $data['address1'] = htmlspecialchars(trim($this->objRequest->getPost('address1')));
        $data['address2'] = htmlspecialchars(trim($this->objRequest->getPost('address2')));
        $data['city'] = htmlspecialchars(trim($this->objRequest->getPost('city')));
        $data['state'] = htmlspecialchars(trim($this->objRequest->getPost('state')));
        $data['zip'] = htmlspecialchars(trim($this->objRequest->getPost('zip')));
        $data['country'] = htmlspecialchars(trim($this->objRequest->getPost('country')));
        $data['facebook'] = htmlspecialchars(trim($this->objRequest->getPost('facebook')));
        $data['instagram'] = htmlspecialchars(trim($this->objRequest->getPost('instagram')));

        return json_encode($this->objMainModel->objUpdate('profile', $data, 1));
    } // ok

    public function changeAccessKey()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "session expired";
            return json_encode($result);
        }

        $key = htmlspecialchars(trim($this->objRequest->getPost('current')));

        if ($this->objConfigModel->login($key)['error'] === 1) {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "invalid current key";
            return json_encode($result);
        }

        $data = array();
        $data['access_key'] = password_hash(htmlspecialchars(trim($this->objRequest->getPost('newp'))), PASSWORD_DEFAULT);

        return json_encode($this->objMainModel->objUpdate('config', $data, 1));
    } // ok

    public function updateConfig()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        $data = array();
        $data['lang'] = htmlspecialchars(trim($this->objRequest->getPost('lang')));
        $data['theme'] = htmlspecialchars(trim($this->objRequest->getPost('theme')));
        $data['currency'] = htmlspecialchars(trim($this->objRequest->getPost('currency')));

        return json_encode($this->objMainModel->objUpdate('config', $data, 1));
    } // ok
}
