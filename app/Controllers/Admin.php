<?php

namespace App\Controllers;

use App\Models\Config_Model;
use App\Models\Main_Model;
use App\Models\Admin_Model;

class Admin extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objConfigModel;
    protected $objAdminModel;
    protected $objMainModel;
    protected $config;
    protected $objEmail;

    public function __construct()
    {
        $this->objSession = session();
        $this->objRequest = \Config\Services::request();
        $this->objConfigModel = new Config_Model;
        $this->objAdminModel = new Admin_Model;
        $this->objMainModel = new Main_Model;
        $this->config = $this->objConfigModel->getConfig(1);
        $this->objRequest->setLocale($this->config[0]->lang);

        $emailConfig = array();
        $emailConfig['protocol'] = EMAIL_PROTOCOL;
        $emailConfig['SMTPHost'] = EMAIL_SMTP_HOST;
        $emailConfig['SMTPUser'] = EMAIL_SMTP_USER;
        $emailConfig['SMTPPass'] = EMAIL_SMTP_PASSWORD;
        $emailConfig['SMTPPort'] = EMAIL_SMTP_PORT;
        $emailConfig['SMTPCrypto'] = EMAIL_SMTP_CRYPTO;
        $emailConfig['mailType'] = EMAIL_MAIL_TYPE;

        $this->objEmail = \Config\Services::email($emailConfig);

        helper('Site');
    }

    public function dashboard()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('adminLogout');

        $data = array();
        $data['config'] = $this->config;
        $data['profile'] = $this->objAdminModel->getProfile(1);
        $data['activeDashboard'] = "active";
        $data['page'] = 'Admin/dashboard/mainDashboard';

        return view('Admin/mainAdmin', $data);
    }

    # Section Dashboard
    # End Section Dashboard

    # Section TPV
    # End Section TPV

    # Section Calendar
    # End Section Calendar

    # Section Services

    public function services()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('adminLogout');

        $data = array();
        $data['config'] = $this->config;
        $data['profile'] = $this->objAdminModel->getProfile(1);
        $data['activeServices'] = "active";
        $data['uniqid'] = uniqid();
        $data['services'] = $this->objMainModel->objData('service');
        $data['page'] = 'Admin/services/mainServices';

        return view('Admin/mainAdmin', $data);
    }

    public function showModalService()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('adminLogout');

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

        return view('Admin/services/modalService', $data);
    }

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
    }

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
    }

    # End Section Services

    # Section Customer

    public function customers()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('adminLogout');

        $data = array();
        # data
        $data['config'] = $this->config;
        $data['profile'] = $this->objAdminModel->getProfile(1);
        $data['activeCustomers'] = "active";
        $data['uniqid'] = uniqid();
        # page
        $data['page'] = 'Admin/customers/mainCustomers';

        return view('Admin/mainAdmin', $data);
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

        $result = $this->objAdminModel->getCustomersProcessingData($params);
        $totalRows = sizeof($result);

        for ($i = 0; $i < $totalRows; $i++) {

            $emailStatus = '<span class="badge small badge-danger"><i class="bi bi-envelope-dash text-dark me-1"></i>' . lang('Text.not_verified') . '</span>';
            if ($result[$i]->emailVerified == 1)
                $emailStatus = '<span class="badge small badge-success"><i class="bi bi-envelope-check text-dark me-1"></i>' . lang('Text.verified') . '</span>';

            $status = '<span class="badge small badge-danger">' . lang('Text.inactive') . '</span>';
            if ($result[$i]->status == 1)
                $status = '<span class="badge small badge-success">' . lang('Text.active') . '</span>';

            $btn_edit = '<button class="btn btn-sm btn-light btn-active-color-warning m-1 edit-customer" data-customer-id="' . $result[$i]->id . '"><span class="bi bi-pencil-square"></span></button>';
            $btn_delete = '<button class="btn btn-sm btn-light btn-active-color-danger m-1" data-customer-id="' . $result[$i]->id . '"><span class="bi bi-trash-fill"></span></button>';

            $col = array();
            $col['name'] = $result[$i]->name;
            $col['lastName'] = $result[$i]->lastName;
            $col['email'] = $result[$i]->email;
            $col['phone'] = $result[$i]->phone;
            $col['status'] = $status;
            $col['emailVerified'] = $emailStatus;
            $col['action'] = $btn_edit . $btn_delete;

            $row[$i] =  $col;
        }

        if ($totalRows > 0) {
            if (empty($params['search']))
                $totalRecords = $this->objAdminModel->getTotalCustomers();
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

    public function showModalCustomer()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('adminLogout');

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

        return view('Admin/customers/modalCustomer', $data);
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
            $profile = $this->objAdminModel->getProfile(1);

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

    # End Section Customer


    # Section Profile

    public function profile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('adminLogout');

        $tab = $this->objRequest->getPostGet('tab');

        if (empty($tab))
            $tab = "profile";

        $data = array();
        $data['config'] = $this->config;
        $data['profile'] = $this->objAdminModel->getProfile(1);
        $data['activeProfile'] = "active";
        $data['tab'] = $tab;
        $data['page'] = 'Admin/profile/mainProfile';

        return view('Admin/mainAdmin', $data);
    }

    public function profileTab()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('adminLogout');

        $tab = $this->objRequest->getPost('tab');

        switch ($tab) {
            case 'profile':
                $view = "Admin/profile/tabs/profileInfo";
                $data = array();
                $data['profile'] = $this->objAdminModel->getProfile(1);
                break;
            case 'key':
                $view = "Admin/profile/tabs/key";
                break;
            case 'config':
                $view = "Admin/profile/tabs/config";
                $data = array();
                $data['config'] = $this->config;
                break;
        }

        $data['uniqid'] = uniqid();

        return view($view, $data);
    }

    public function uploadAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "session expired";
            return json_encode($result);
        }

        return json_encode($this->objMainModel->uploadFile('profile', 1, 'avatar', $_FILES['file']));
    }

    public function removeAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "session expired";
            return json_encode($result);
        }

        $data = array();
        $data['avatar'] = '';

        return json_encode($this->objMainModel->objUpdate('profile', $data, 1));
    }

    public function updateProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "session expired";
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

        return json_encode($this->objMainModel->objUpdate('profile', $data, 1));
    }

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
    }

    public function updateConfig()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "session expired";
            return json_encode($result);
        }

        $data = array();
        $data['lang'] = htmlspecialchars(trim($this->objRequest->getPost('lang')));
        $data['theme'] = htmlspecialchars(trim($this->objRequest->getPost('theme')));
        $data['currency'] = htmlspecialchars(trim($this->objRequest->getPost('currency')));

        return json_encode($this->objMainModel->objUpdate('config', $data, 1));
    }

    # End Section Profile

    public function emailView()
    {
        $profile = $this->objAdminModel->getProfile(1);
        $dataEmail = array();
        $dataEmail['pageTitle'] = $profile[0]->company_name;
        $dataEmail['person'] = "Axley Herrera";
        $dataEmail['url'] = base_url('Home');
        $dataEmail['companyPhone'] = $profile[0]->phone1;
        $dataEmail['companyEmail'] = $profile[0]->email;

        return view('email/createCustomerByAdmin', $dataEmail);
    }
}
