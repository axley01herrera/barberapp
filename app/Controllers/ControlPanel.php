<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\MainModel;
use App\Models\ControlPanelModel;
use App\Models\CustomerModel;

class ControlPanel extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objConfigModel;
    protected $objControlPanelModel;
    protected $objCustomerModel;
    protected $objMainModel;
    protected $config;
    protected $companyProfile;
    protected $objEmail;

    public function __construct()
    {
        # Session
        $this->objSession = session();

        # Models
        $this->objConfigModel = new ConfigModel;
        $this->objControlPanelModel = new ControlPanelModel;
        $this->objCustomerModel = new CustomerModel;
        $this->objMainModel = new MainModel;

        # Config
        $this->config = $this->objConfigModel->getConfig(1);
        $this->companyProfile = $this->objControlPanelModel->getCompanyProfile(1);

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
        # config
        $data['config'] = $this->config;
        $data['companyProfile'] = $this->companyProfile;
        # menu
        $data['activeDashboard'] = "active";
        # page
        $data['page'] = 'controlPanel/dashboard/mainDashboard';

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
        # config
        $data['config'] = $this->config;
        $data['companyProfile'] = $this->companyProfile;
        # menu
        $data['activeServices'] = "active";
        # data
        $data['uniqid'] = uniqid();
        $data['services'] = $this->objControlPanelModel->getServices();
        # page
        $data['page'] = 'controlPanel/services/mainServices';

        return view('ControlPanel/mainCpanel', $data);
    } // ok

    public function updateServicesOrder()
    {
        # params
        $ids = $this->objRequest->getPost('servicesIds');

        $i = 1;
        foreach ($ids as $id) {
            $data = array();
            $data['ordering'] = $i;
            $this->objMainModel->objUpdate('service', $data, $id);
            $i++;
        }

        $result['error'] = 0;

        return json_encode($result);
    } // ok

    public function showModalService()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $data = array();
        # config
        $data['config'] = $this->config;
        # data
        $data['action'] = $this->objRequest->getPost('action');
        $data['uniqid'] = uniqid();

        if ($data['action'] == "create")
            $data['modalTitle'] = lang("Text.serv_new");
        else {
            $data['modalTitle'] = lang("Text.serv_update");
            $data['service'] = $this->objMainModel->objData('service', 'id', $this->objRequest->getPost('id'))[0];
        }

        # page
        $view = 'ControlPanel/services/modalService';

        return view($view, $data);
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

        # params
        $title = htmlspecialchars(trim($this->objRequest->getPost('title')));
        $price = htmlspecialchars(trim($this->objRequest->getPost('price')));
        $time = htmlspecialchars(trim($this->objRequest->getPost('time')));
        $description = htmlspecialchars(trim($this->objRequest->getPost('description')));
        $checkDuplicate = $this->objMainModel->objCheckDuplicate('service', 'title', $title);

        if (empty($checkDuplicate)) {
            $data = array();
            $data['title'] = $title;
            $data['price'] = $price;
            $data['time'] = $time;
            $data['description'] = $description;

            $result = $this->objMainModel->objCreate('service', $data);
            $this->objMainModel->objUpdate('service', array('ordering' => $result['id']), $result['id']);

            return json_encode($result);
        } else {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "ERROR_DUPLICATE";

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

        # params
        $serviceID = $this->objRequest->getPost('id');
        $title = htmlspecialchars(trim($this->objRequest->getPost('title')));
        $price = htmlspecialchars(trim($this->objRequest->getPost('price')));
        $time = htmlspecialchars(trim($this->objRequest->getPost('time')));
        $description = htmlspecialchars(trim($this->objRequest->getPost('description')));

        $checkDuplicate = $this->objMainModel->objCheckDuplicate('service', 'title', $title, $serviceID);

        if (empty($checkDuplicate)) {
            $data = array();
            $data['title'] = $title;
            $data['price'] = $price;
            $data['time'] = $time;
            $data['description'] = $description;

            $result = $this->objMainModel->objUpdate('service', $data, $serviceID);
            return json_encode($result);
        } else {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "duplicate";

            return json_encode($result);
        }
    } // ok

    public function changeServiceStatus()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $serviceID = htmlspecialchars(trim($this->objRequest->getPost('serviceID')));
        $status = htmlspecialchars(trim($this->objRequest->getPost('status')));

        $data = array();
        $data['status'] = $status;

        $result = $this->objMainModel->objUpdate('service', $data, $serviceID);

        return json_encode($result);
    } // ok

    public function changeServiceVisibility()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $serviceID = htmlspecialchars(trim($this->objRequest->getPost('serviceID')));
        $visibility = htmlspecialchars(trim($this->objRequest->getPost('visibility')));

        $data = array();
        $data['visibility'] = $visibility;

        $result = $this->objMainModel->objUpdate('service', $data, $serviceID);

        return json_encode($result);
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
        # config
        $data['config'] = $this->config;
        $data['companyProfile'] = $this->companyProfile;
        # menu
        $data['activeCustomers'] = "active";
        # data
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
            $status = '<div class="form-check form-switch form-check-solid" style="margin-left: 30%;"><input type="checkbox" class="form-check-input form-control h-10px w-30px change-status" title="' . lang('Text.change_status') . '" data-customer-id="' . $result[$i]->id . '" data-status="' . $result[$i]->status . '"></div>';

            if ($result[$i]->status == 1)
                $status = '<div class="form-check form-switch form-check-solid" style="margin-left: 30%;"><input type="checkbox" class="form-check-input form-control h-10px w-30px change-status" title="' . lang('Text.change_status') . '"checked="" data-customer-id="' . $result[$i]->id . '" data-status="' . $result[$i]->status . '"></div>';


            $btnProfile = '<a href="' . base_url('ControlPanel/customerProfile?customerID=') . $result[$i]->id . '" title="' . lang('Text.btn_profile') . '"" class="btn btn-sm btn-light btn-active-color-primary m-1">' . '<i class="bi bi-person-gear"></i>' . '</a>';
            $btnEdit = '<button class="btn btn-sm btn-light btn-active-color-warning m-1 edit-customer" data-customer-id="' . $result[$i]->id . '" title="' . lang('Text.btn_edit') . '"><span class="bi bi-pencil-square"></span></button>';
            $btnDelete = '<button class="btn btn-sm btn-light btn-active-color-danger m-1 delete-customer" data-customer-id="' . $result[$i]->id . '" title="' . lang('Text.btn_delete') . '"><span class="bi bi-trash-fill"></span></button>';

            $col = array();
            if (empty($result[$i]->avatar))
                $col['avatar'] =  '<div class="symbol symbol-30px symbol-circle me-3"><img src="' . base_url("public/assets/media/avatars/blank.png") . '" class="border border-1 border-secondary"alt="Avatar"> </div>';
            else
                $col['avatar'] = '<div class="symbol symbol-30px symbol-circle me-3"><img src="data:image/png;base64,' . base64_encode($result[$i]->avatar) . '" class="border border-1 border-secondary"alt="Avatar"> </div>';
            $col['name'] = $result[$i]->name;
            $col['lastName'] = $result[$i]->lastName;
            $col['email'] = $result[$i]->email;
            $col['status'] = $status;
            $col['action'] = $btnProfile . $btnDelete;

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
        # config
        $data['config'] = $this->config;
        $data['companyProfile'] = $this->companyProfile;
        # menu
        $data['activeCustomers'] = "active";
        # data
        $data['customer'] = $this->objMainModel->objData('customer', 'id', $this->objRequest->getGet('customerID'));
        # page
        $data['page'] = 'controlPanel/customers/index';

        return view('ControlPanel/mainCpanel', $data);
    }

    public function reloadCustomerInfo()
    {
        # data
        $data = array();
        $data['customer'] = $this->objMainModel->objData('customer', 'id', $this->objRequest->getPost('customerID'));

        return view('controlPanel/customers/customerInfo', $data);
    }

    public function customerTabContent()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        # params
        $tab = $this->objRequest->getPost('tab');
        $customerID = $this->objRequest->getPost('customerID');

        $data = array();
        # data
        $data['config'] = $this->config;
        $data['companyProfile'] = $this->companyProfile;
        $data['uniqid'] = uniqid();

        if ($this->config[0]->lang == 'es')
            $data['dateLabel'] = "d-m-Y";
        else if ($this->config[0]->lang == 'en')
            $data['dateLabel'] = "m-d-Y";

        $view = "";

        switch ($tab) {
            case 'tab-overview':
                $data['customer'] = $this->objMainModel->objData('customer', 'id', $customerID);
                $data['appointments'] = $this->objCustomerModel->upcomingAppointments($customerID);
                # page
                $view = "controlPanel/customers/tabContent/tabOverview";
                break;
            case 'tab-account':
                $data['customer'] = $this->objMainModel->objData('customer', 'id', $customerID);
                # page
                $view = "controlPanel/customers/tabContent/tabAccount";
                break;
            case 'tab-profile':
                $data['customer'] = $this->objMainModel->objData('customer', 'id', $customerID);
                # page
                $view = "controlPanel/customers/tabContent/tabProfile";
                break;
        }

        return view($view, $data);
    }

    public function updateCustomerAccount()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $email = strtolower(htmlspecialchars(trim($this->objRequest->getPost('email'))));
        $currentPassword = htmlspecialchars(trim($this->objRequest->getPost('currentPassword')));
        $newPassword = password_hash(htmlspecialchars(trim($this->objRequest->getPost('password'))), PASSWORD_DEFAULT);
        $customerID = $this->objRequest->getPost('customerID');

        if (!empty($currentPassword)) {
            if ($this->objConfigModel->loginCustomer($currentPassword, $customerID)['error'] == 1) {
                $result = array();
                $result['error'] = 1;
                $result['msg'] = "INVALID_CURRENT_KEY";
                return json_encode($result);
            }
        }

        $dataAccount = array();
        if (!empty($this->objRequest->getPost('password')))
            $dataAccount['password'] = $newPassword;

        if ($this->objMainModel->objData('customer', 'id', $customerID)[0]->email !== $email) {
            $dataAccount['email'] = $email;
            $dataAccount['token'] = md5(uniqid());
            $dataAccount['emailVerified'] = 0;
        }

        if (empty($dataAccount)) {
            $response = array();
            $response['error'] = 0;
            return json_encode($response);
        }

        $this->objMainModel->objUpdate('customer', $dataAccount, $customerID);
        $customer = $this->objMainModel->objData('customer', 'id', $customerID);

        if (!empty($dataAccount['email'])) {
            $dataEmail = array();
            $dataEmail['pageTitle'] = $this->companyProfile[0]->companyName;
            $dataEmail['person'] = $customer[0]->name . ' ' . $customer[0]->lastName;
            $dataEmail['url'] = base_url('Home/verifiedEmail') . '?token=' . $dataAccount['token'] . '&type=customer';
            $dataEmail['companyPhone'] = $this->companyProfile[0]->phone1;
            $dataEmail['companyEmail'] = $this->companyProfile[0]->email;

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $this->companyProfile[0]->companyName);
            $this->objEmail->setTo($dataAccount['email']);
            $this->objEmail->setSubject($this->companyProfile[0]->companyName);
            $this->objEmail->setMessage(view('email/verifyNewEmail', $dataEmail), []);

            $this->objEmail->send(false);
        }
        $response = array();
        $response['error'] = 0;

        return json_encode($response);
    }

    public function updateCustomerProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $customerID = $this->objRequest->getPost('customerID');

        $data = array();
        $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $data['lastName'] = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $data['phone'] = htmlspecialchars(trim($this->objRequest->getPost('phone')));
        $data['gender'] = htmlspecialchars(trim($this->objRequest->getPost('gender')));
        $data['dob'] = date('Y-m-d', strtotime($this->objRequest->getPost('dob')));
        $data['emailNotification'] = htmlspecialchars(trim($this->objRequest->getPost('status')));
        $data['address1'] = htmlspecialchars(trim($this->objRequest->getPost('address1')));
        $data['address2'] = htmlspecialchars(trim($this->objRequest->getPost('address2')));
        $data['city'] = htmlspecialchars(trim($this->objRequest->getPost('city')));
        $data['state'] = htmlspecialchars(trim($this->objRequest->getPost('state')));
        $data['zip'] = htmlspecialchars(trim($this->objRequest->getPost('zip')));
        $data['country'] = htmlspecialchars(trim($this->objRequest->getPost('country')));

        $result = $this->objMainModel->objUpdate('customer', $data, $customerID);

        return json_encode($result);
    }

    public function uploadCustomerAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $customerID = $this->objRequest->getPost('customerID');

        return json_encode($this->objMainModel->uploadFile('customer', $customerID, 'avatar', $_FILES['file']));
    }

    public function removeCustomerAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $customerID = $this->objRequest->getPost('customerID');

        $data = array();
        $data['avatar'] = '';

        return json_encode($this->objMainModel->objUpdate('customer', $data, $customerID));
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

            $dataEmail = array();
            $dataEmail['pageTitle'] = $this->companyProfile[0]->companyName;
            $dataEmail['person'] = $name . ' ' . $lastName;
            $dataEmail['url'] = base_url('Home/customerCreatePassword?token=') . $data['token'];
            $dataEmail['companyPhone'] = $this->companyProfile[0]->phone1;
            $dataEmail['companyEmail'] = $this->companyProfile[0]->email;

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $this->companyProfile[0]->companyName);
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
        # config
        $data['config'] = $this->config;
        $data['companyProfile'] = $this->companyProfile;
        # menu
        $data['activeEmployees'] = "active";
        # data
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

            $btnResendCompleteAccountEmail = "";
            $btnResendVerifyEmail = "";

            $avatar = '<div class="symbol symbol-30px symbol-circle me-3"><img src="' . base_url("public/assets/media/avatars/blank.png") . '"class="border border-1 border-secondary" alt="Avatar"> </div>';
            $status = '<div class="form-check form-switch" style="margin-left: 30%;"><input type="checkbox" class="form-check-input form-control h-10px w-30px change-status" title="' . lang('Text.change_status') . '" data-employee-id="' . $result[$i]->id . '" data-status="' . $result[$i]->status . '"></div>';

            if (!empty($result[$i]->avatar))
                $avatar = '<div class="symbol symbol-30px symbol-circle me-3"><img src="data:image/png;base64,' . base64_encode($result[$i]->avatar) . '"class="border border-1 border-secondary" alt="Avatar"> </div>';

            if ($result[$i]->status == 1)
                $status = '<div class="form-check form-switch" style="margin-left: 30%;"><input type="checkbox" class="form-check-input form-control h-10px w-30px change-status" title="' . lang('Text.change_status') . '"checked="" data-employee-id="' . $result[$i]->id . '" data-status="' . $result[$i]->status . '"></div>';

            if (empty($result[$i]->password))
                $btnResendCompleteAccountEmail = '<button type="button" data-employee-id=' . $result[$i]->id . ' " title="' . lang('Text.emp_resend_complete_account') . '" class="btn btn-sm btn-light btn-active-color-primary m-1 resend-complete-account-email">' . '<i class="bi bi-envelope-check"></i>' . '</button>';

            if (!empty($result[$i]->password) && $result[$i]->emailVerified == 0)
                $btnResendVerifyEmail = '<button type="button" data-employee-id=' . $result[$i]->id . ' " title="' . lang('Text.emp_resend_verify_email') . '" class="btn btn-sm btn-light btn-active-color-primary m-1 resend-verify-email">' . '<i class="bi bi-envelope-check"></i>' . '</button>';

            $btnProfile = '<a href="' . base_url('ControlPanel/employeeProfile?id=') . $result[$i]->id . '" title="' . lang('Text.emp_profile_title') . '"" class="btn btn-sm btn-light btn-active-color-primary m-1">' . '<i class="bi bi-person-gear"></i>' . '</a>';
            $btnDelete = '<button class="btn btn-sm btn-light btn-active-color-danger m-1 delete-employee" data-employee-id="' . $result[$i]->id . '" title="' . lang('Text.btn_delete') . '"><span class="bi bi-trash-fill"></span></button>';

            $col = array();
            $col['avatar'] = $avatar;
            $col['name'] = $result[$i]->name;
            $col['lastName'] = $result[$i]->lastName;
            $col['email'] = $result[$i]->email;
            $col['status'] = $status;
            $col['action'] = @$btnResendCompleteAccountEmail . @$btnResendVerifyEmail . $btnProfile . $btnDelete;
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
        # config
        $data['config'] = $this->config;
        # data
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
            $this->objMainModel->objCreate('employee_bussines_day', ['employeeID' => $result['id']]);

            $dataEmail = array();
            $dataEmail['pageTitle'] = $this->companyProfile[0]->companyName;
            $dataEmail['person'] = $name . ' ' . $lastName;
            $dataEmail['url'] = base_url('Home/employeeCreatePassword?token=') . $data['token'];
            $dataEmail['companyPhone'] = $this->companyProfile[0]->phone1;
            $dataEmail['companyEmail'] = $this->companyProfile[0]->email;

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $this->companyProfile[0]->companyName);
            $this->objEmail->setTo($email);
            $this->objEmail->setSubject(lang('Text.emp_complete_your_account'));
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

    public function resendVerifyEmail()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $employeeID = $this->objRequest->getPost('employeeID');
        $token = md5(uniqid());

        # Get Employee
        $employee = $this->objMainModel->objData('employee', 'id', $employeeID);

        # Set Employee Token
        $result = $this->objMainModel->objUpdate('employee', array('token' => $token), $employee[0]->id);

        $dataEmail = array();
        $dataEmail['pageTitle'] = $this->companyProfile[0]->companyName;
        $dataEmail['person'] = $employee[0]->name . ' ' . $employee[0]->lastName;
        $dataEmail['url'] = base_url('Home/verifiedEmail') . '?token=' . $token . '&type=employee';
        $dataEmail['companyPhone'] = $this->companyProfile[0]->phone1;
        $dataEmail['companyEmail'] = $this->companyProfile[0]->email;

        $this->objEmail->setFrom(EMAIL_SMTP_USER, $this->companyProfile[0]->companyName);
        $this->objEmail->setTo($employee[0]->email);
        $this->objEmail->setSubject($this->companyProfile[0]->companyName);
        $this->objEmail->setMessage(view('email/verifyNewEmail', $dataEmail), []);

        if ($this->objEmail->send(false)) {
            $response['error'] = 0;
            $response['msg'] = lang('Text.emp_success_resend_verify_email');
        } else {
            $response['error'] = 1;
            $response['msg'] = 'ERROR_SEND_EMAIL';
        }

        return json_encode($response);
    } // ok

    public function resendCompleteAccount()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $employeeID = $this->objRequest->getPost('employeeID');
        $token = md5(uniqid());

        # Get Employee
        $employee = $this->objMainModel->objData('employee', 'id', $employeeID);

        # Set Employee Token
        $result = $this->objMainModel->objUpdate('employee', array('token' => $token), $employeeID);

        $dataEmail = array();
        $dataEmail['pageTitle'] = $this->companyProfile[0]->companyName;
        $dataEmail['person'] = $employee[0]->name . ' ' . $employee[0]->lastName;
        $dataEmail['url'] = base_url('Home/employeeCreatePassword?token=') . $token;
        $dataEmail['companyPhone'] = $this->companyProfile[0]->phone1;
        $dataEmail['companyEmail'] = $this->companyProfile[0]->email;

        $this->objEmail->setFrom(EMAIL_SMTP_USER, $this->companyProfile[0]->companyName);
        $this->objEmail->setTo($employee[0]->email);
        $this->objEmail->setSubject(lang('Text.emp_complete_your_account'));
        $this->objEmail->setMessage(view('email/createEmployeeByAdmin', $dataEmail), []);

        if ($this->objEmail->send(false)) {
            $response['error'] = 0;
            $response['msg'] = lang('Text.emp_success_resend_complete_account');
        } else {
            $response['error'] = 1;
            $response['msg'] = 'ERROR_SEND_EMAIL';
        }

        return json_encode($response);
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
        # config
        $data['companyProfile'] = $this->companyProfile;
        $data['config'] = $this->config;
        # menu
        $data['activeEmployees'] = "active";
        # data
        $data['employee'] = $this->objMainModel->objData('employee', 'id', $this->objRequest->getPostGet('id'));
        # page
        $data['page'] = 'controlPanel/employees/employeeProfile/mainEmployeeProfile';

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
        # config
        $data['config'] = $this->config;
        # data
        $data['employeeID'] = $employeeID;
        $data['uniqid'] = uniqid();

        if ($this->config[0]->lang == 'es')
            $data['dateLabel'] = "d-m-Y";
        else if ($this->config[0]->lang == 'en')
            $data['dateLabel'] = "m-d-Y";

        switch ($tab) {
            case 'tab-overview':
                $data['employee'] = $this->objMainModel->objData('employee', 'id', $employeeID);
                $data['employeeServices'] = $this->objMainModel->objData('employee_service', 'employeeID', $employeeID);
                $data['employeeBussinesDay'] = $this->objMainModel->objData('employee_bussines_day', 'employeeID', $employeeID);
                $data['employeeTimes'] = $this->objMainModel->objData('employee_shift_day', 'employeeID', $employeeID);
                # page
                $view = "controlPanel/employees/employeeProfile/tabContent/tabOverview";
                break;
            case 'tab-services':
                $data['services'] = $this->objControlPanelModel->getActiveServices();
                $data['employeeServices'] = $this->objMainModel->objData('employee_service', 'employeeID', $employeeID);
                # page
                $view = "controlPanel/employees/employeeProfile/tabContent/tabService";
                break;
            case 'tab-schedule':
                $data['employeeBussinesDay'] = $this->objMainModel->objData('employee_bussines_day', 'employeeID', $employeeID);
                $data['employeeTimes'] = $this->objMainModel->objData('employee_shift_day', 'employeeID', $employeeID);
                $view = "controlPanel/employees/employeeProfile/tabContent/tabSchedule";
                break;
            case 'tab-account':
                $data['employee'] = $this->objMainModel->objData('employee', 'id', $employeeID);
                $view = "controlPanel/employees/employeeProfile/tabContent/tabAccount";
                break;
            case 'tab-profile':
                $data['employee'] = $this->objMainModel->objData('employee', 'id', $employeeID);
                $view = "controlPanel/employees/employeeProfile/tabContent/tabProfile";
                break;
        }

        return view($view, $data);
    }

    // public function uploadCompanyImages()
    // {
    //     # params
    //     $files = $_FILES['files'];
    //     $position = $this->objRequest->getPost('');

    //     foreach ($files['name'] as $index => $fileName) {
    //         $file = array(
    //             'name' => $fileName,
    //             'type' => $files['type'][$index],
    //             'tmp_name' => $files['tmp_name'][$index],
    //             'error' => $files['error'][$index],
    //             'size' => $files['size'][$index]
    //         );

    //         $result = $this->objMainModel->uploadBusinessImages($file, $position);
    //     }

    //     return json_encode($result);
    // }


    public function uploadCompanyImages()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        return json_encode($this->objMainModel->uploadBusinessImages($_FILES['file'], $this->objRequest->getPost('position')));
    }

    public function deleteCompanyImages()
    {
        # params
        $imageID = $this->objRequest->getPost('imageID');
        $result = $this->objMainModel->objDelete('company_img', $imageID);
        return json_encode($result);
    }

    public function modalTime()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        # params
        $action = $this->objRequest->getPost('action');
        $employeeID = $this->objRequest->getPost('employeeID');
        $timeID = $this->objRequest->getPost('timeID');

        $data = array();
        # config
        $data['action'] = $action;
        # data
        $data['employeeID'] = $employeeID;
        $data['timeID'] = $timeID;
        $data['uniqid'] = uniqid();
        $data['employeeBussinesDay'] = $this->objMainModel->objData('employee_bussines_day', 'employeeID', $data['employeeID']);

        if ($action == 'create')
            $data['modalTitle'] = lang('Text.emp_modal_title_create_time');
        else if ($action == 'update') {
            $data['modalTitle'] = lang('Text.emp_modal_title_edit_time');
            $data['time'] = $this->objMainModel->objData('employee_shift_day', 'id', $timeID);
        }
        # page
        $page = 'controlPanel/employees/employeeProfile/modalTime';

        return view($page, $data);
    } // ok

    public function createTime()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $employeeID = $this->objRequest->getPost('employeeID');
        $day = $this->objRequest->getPost('day');
        $startPost = $this->objRequest->getPost('startTime');
        $endPost = $this->objRequest->getPost('endTime');

        # Set time sql format
        $tiempoUnixS = strtotime($startPost);
        $tiempoUnixE = strtotime($endPost);
        $timeSqlS = date('H:i:s', $tiempoUnixS);
        $timeSqlE = date('H:i:s', $tiempoUnixE);

        $data = array();
        $data['employeeID'] = $employeeID;
        $data['day'] = $day;
        $data['start'] = $timeSqlS;
        $data['end'] = $timeSqlE;

        $result = $this->objMainModel->objCreate('employee_shift_day', $data);

        return json_encode($result);
    } // ok

    public function updateTime()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $day = $this->objRequest->getPost('day');
        $startPost = $this->objRequest->getPost('startTime');
        $endPost = $this->objRequest->getPost('endTime');
        $timeID = $this->objRequest->getPost('timeID');

        # Set time sql format
        $tiempoUnixS = strtotime($startPost);
        $tiempoUnixE = strtotime($endPost);
        $timeSqlS = date('H:i:s', $tiempoUnixS);
        $timeSqlE = date('H:i:s', $tiempoUnixE);

        $data = array();
        $data['day'] = $day;
        $data['start'] = $timeSqlS;
        $data['end'] = $timeSqlE;

        $result = $this->objMainModel->objUpdate('employee_shift_day', $data, $timeID);

        return json_encode($result);
    } // ok

    public function deleteTime()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        return json_encode($this->objMainModel->objDelete('employee_shift_day', array('id' => $this->objRequest->getPost('timeID'))));
    } // ok

    public function reloadEmployeeInfo()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        # params
        $employeeID = $this->objRequest->getPost('employeeID');
        # data
        $data = array();
        $data['employee'] = $this->objMainModel->objData('employee', 'id', $employeeID);
        # page
        $page = 'controlPanel/employees/employeeProfile/sectionEmployeeInfo';

        return view($page, $data);
    } // ok

    public function updateEmployeeAccount()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $email = strtolower(htmlspecialchars(trim($this->objRequest->getPost('email'))));
        $currentPassword = htmlspecialchars(trim($this->objRequest->getPost('currentPassword')));
        $newPassword = password_hash(htmlspecialchars(trim($this->objRequest->getPost('password'))), PASSWORD_DEFAULT);
        $employeeID = $this->objRequest->getPost('employeeID');

        $employee = $this->objMainModel->objData('employee', 'id', $employeeID);

        if (!empty($currentPassword)) {
            if ($this->objConfigModel->login($currentPassword)['error'] == 1) {
                $result = array();
                $result['error'] = 1;
                $result['msg'] = "INVALID_CURRENT_KEY";
                return json_encode($result);
            }
        }

        $dataAccount = array();
        if (!empty($this->objRequest->getPost('password')))
            $dataAccount['password'] = $newPassword;

        if ($employee[0]->email !== $email) {
            $dataAccount['email'] = $email;
            $dataAccount['token'] = md5(uniqid());
            $dataAccount['emailVerified'] = 0;
        }

        if (empty($dataAccount)) {
            $response = array();
            $response['error'] = 0;
            return json_encode($response);
        }

        $this->objMainModel->objUpdate('employee', $dataAccount, $employeeID);

        if (!empty($dataAccount['email'])) {
            $dataEmail = array();
            $dataEmail['pageTitle'] = $this->companyProfile[0]->companyName;
            $dataEmail['person'] = $employee[0]->name . ' ' . $employee[0]->lastName;
            $dataEmail['url'] = base_url('Home/verifiedEmail') . '?token=' . $dataAccount['token'] . '&type=employee';
            $dataEmail['companyPhone'] = $this->companyProfile[0]->phone1;
            $dataEmail['companyEmail'] = $this->companyProfile[0]->email;

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $this->companyProfile[0]->companyName);
            $this->objEmail->setTo($dataAccount['email']);
            $this->objEmail->setSubject($this->companyProfile[0]->companyName);
            $this->objEmail->setMessage(view('email/verifyNewEmail', $dataEmail), []);

            $this->objEmail->send(false);
        }

        $response = array();
        $response['error'] = 0;

        return json_encode($response);
    } // ok

    public function updateEmployeeProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $employeeID = $this->objRequest->getPost('employeeID');
        $data = array();
        $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $data['lastName'] = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $data['gender'] = htmlspecialchars(trim($this->objRequest->getPost('gender')));
        $data['phone'] = htmlspecialchars(trim($this->objRequest->getPost('phone')));
        $data['dob'] = date('Y-m-d', strtotime($this->objRequest->getPost('dob')));
        $data['address1'] = htmlspecialchars(trim($this->objRequest->getPost('address1')));
        $data['address2'] = htmlspecialchars(trim($this->objRequest->getPost('address2')));
        $data['city'] = htmlspecialchars(trim($this->objRequest->getPost('city')));
        $data['state'] = htmlspecialchars(trim($this->objRequest->getPost('state')));
        $data['zip'] = htmlspecialchars(trim($this->objRequest->getPost('zip')));
        $data['country'] = htmlspecialchars(trim($this->objRequest->getPost('country')));

        $result = $this->objMainModel->objUpdate('employee', $data, $employeeID);

        return json_encode($result);
    } // ok

    public function uploadEmployeeAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        return json_encode($this->objMainModel->uploadFile('employee', $this->objRequest->getPost('employeeID'), 'avatar', $_FILES['file']));
    } // ok

    public function removeEmployeeAvatarProfile()
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

        return json_encode($this->objMainModel->objUpdate('employee', $data, $this->objRequest->getPost('employeeID')));
    } // ok

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

    public function updateBussinessDay()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }
        # params
        $field = $this->objRequest->getPost('field');
        $value = $this->objRequest->getPost('value');
        $employeeBussinesDayID = $this->objRequest->getPost('employeeBussinesDayID');

        $data = array();
        $data[$field] = $value;

        $result = $this->objMainModel->objUpdate('employee_bussines_day', $data, $employeeBussinesDayID);

        return json_encode($result);
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
        $data['socialNetworks'] = $this->objMainModel->objData('company_social_network');
        # config
        $data['config'] = $this->config;
        $data['companyProfile'] = $this->companyProfile;
        # page
        $data['page'] = 'controlPanel/companyProfile/mainCompanyProfile';

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
                $view = "controlPanel/companyProfile/tabs/profileInfo";
                $data = array();
                $data['profile'] = $this->companyProfile;
                $data['config'] = $this->config;
                break;
            case 'key':
                $view = "controlPanel/companyProfile/tabs/key";
                break;
            case 'config':
                $view = "controlPanel/companyProfile/tabs/config";
                $data = array();
                $data['config'] = $this->config;
                break;
            case 'privacyPolice':
                $view = "controlPanel/companyProfile/tabs/privacyPolice";
                $data = array();
                $data['config'] = $this->config;
                $data['privacyPolice'] = $this->objMainModel->objData('company_profile')[0]->privacyPolice;
                break;
            case 'images':
                $view = "controlPanel/companyProfile/tabs/images";
                $data = array();
                $data['config'] = $this->config;
                $data['images'] = $this->objMainModel->getCompanyImages();
                $data['image1'] = $this->objMainModel->getCompanyImagesByPosition('1');
                $data['image2'] = $this->objMainModel->getCompanyImagesByPosition('2');
                $data['image3'] = $this->objMainModel->getCompanyImagesByPosition('3');
                $data['image4'] = $this->objMainModel->getCompanyImagesByPosition('4');
                break;
        }

        $data['uniqid'] = uniqid();

        return view($view, $data);
    } // ok

    public function savePrivacyPolice()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }
        #params
        $privacyPolice = $this->objRequest->getPost('privacyPolice');

        $data = array();
        $data['privacyPolice'] = $privacyPolice;

        return json_encode($this->objMainModel->objUpdate('company_profile', $data, 1));
    }

    public function uploadAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        return json_encode($this->objMainModel->uploadFile('company_profile', 1, 'avatar', $_FILES['file']));
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

        return json_encode($this->objMainModel->objUpdate('company_profile', $data, 1));
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
        # params
        $data['companyName'] = htmlspecialchars(trim($this->objRequest->getPost('company')));
        $data['companyType'] = htmlspecialchars(trim($this->objRequest->getPost('type')));
        $data['companyID'] = htmlspecialchars(trim($this->objRequest->getPost('companyID')));
        $data['email'] = htmlspecialchars(trim($this->objRequest->getPost('email')));
        $data['phone1'] = htmlspecialchars(trim($this->objRequest->getPost('phone1')));
        $data['phone2'] = htmlspecialchars(trim($this->objRequest->getPost('phone2')));
        $data['phoneExt'] = htmlspecialchars(trim($this->objRequest->getPost('ext')));
        $data['address1'] = htmlspecialchars(trim($this->objRequest->getPost('address1')));
        $data['address2'] = htmlspecialchars(trim($this->objRequest->getPost('address2')));
        $data['city'] = htmlspecialchars(trim($this->objRequest->getPost('city')));
        $data['state'] = htmlspecialchars(trim($this->objRequest->getPost('state')));
        $data['zip'] = htmlspecialchars(trim($this->objRequest->getPost('zip')));
        $data['country'] = htmlspecialchars(trim($this->objRequest->getPost('country')));
        $data['about'] = $this->objRequest->getPost('about');

        $result = $this->objMainModel->objUpdate('company_profile', $data, 1);

        return json_encode($result);
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

        if ($this->objConfigModel->login($key)['error'] == 1) {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "INVALID_CURRENT_KEY";
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
        $data['timezone'] = htmlspecialchars(trim($this->objRequest->getPost('timezone')));

        return json_encode($this->objMainModel->objUpdate('config', $data, 1));
    } // ok

    public function modalSocialNetwork()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        # params
        $action = $this->objRequest->getPost('action');

        $data = array();
        #data
        $data['action'] = $action;
        $data['uniqid'] = uniqid();

        if ($action == "create") {
            $data['modalTitle'] = lang('Text.add_social_network');
        } else if (!empty($action == 'update')) {
            $data['socialNetwork'] = $this->objMainModel->objData('company_social_network', 'id', $this->objRequest->getPost('id'));
            $data['modalTitle'] = lang('Text.edit_social_network');
        }

        # page
        $view = 'controlPanel/companyProfile/modalSocialNetwork';

        return view($view, $data);
    } // ok

    public function createSocialNetwork()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $socialNetwork = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $url = htmlspecialchars(trim($this->objRequest->getPost('url')));

        $data = array();
        $data['type'] = $socialNetwork;
        $data['url'] = $url;

        $result = $this->objMainModel->objCreate('company_social_network', $data);

        return json_encode($result);
    }

    public function updateSocialNetwork()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $id = $this->objRequest->getPost('id');
        $socialNetwork = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $url = htmlspecialchars(trim($this->objRequest->getPost('url')));

        $data = array();
        $data['type'] = $socialNetwork;
        $data['url'] = $url;

        $result = $this->objMainModel->objUpdate('company_social_network', $data, $id);

        return json_encode($result);
    } // ok

    public function deleteSocialNetwork()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $id = $this->objRequest->getPost('id');

        return json_encode($this->objMainModel->objDelete('company_social_network', $id));
    } // ok

    public function changeStatusSocialNetwork()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $socialNetworkID = $this->objRequest->getPost('socialNetworkID');
        $status = $this->objRequest->getPost('status');

        $data = array();
        $data['status'] = $status;

        $result = $this->objMainModel->objUpdate('company_social_network', $data, $socialNetworkID);

        return json_encode($result);
    } // ok

    public function getSocialNetworks()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        # data
        $data = array();
        $data['uniqid'] = uniqid();
        $data['socialNetworks'] = $this->objMainModel->objData('company_social_network');
        # page
        $view = 'controlPanel/companyProfile/mainSocialNetworks';

        return view($view, $data);
    } // ok

    ##############################
    # Template Copy To Create a New Section
    ##############################

    public function tempate()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('controlPanelLogout');

        $data = array();
        # config
        $data['config'] = $this->config;
        $data['companyProfile'] = $this->companyProfile;
        # menu
        $data['activeTemplate'] = "active";
        $data['uniqid'] = uniqid();
        # page
        $data['page'] = 'controlPanel/template/mainTemplate';

        return view('ControlPanel/mainCpanel', $data);
    }
}
