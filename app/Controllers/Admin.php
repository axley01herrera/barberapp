<?php

namespace App\Controllers;

use App\Models\Config_Model;
use App\Models\Main_Model;
use App\Models\Profile_Model;

class Admin extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objConfigModel;
    protected $objProfileModel;
    protected $objMainModel;
    protected $config;
    protected $objEmail;

    public function __construct()
    {
        $this->objSession = session();
        $this->objRequest = \Config\Services::request();
        $this->objConfigModel = new Config_Model;
        $this->objProfileModel = new Profile_Model;
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
        $data['profile'] = $this->objProfileModel->getProfile(1);
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
        $data['profile'] = $this->objProfileModel->getProfile(1);
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
        $data['config'] = $this->config;
        $data['profile'] = $this->objProfileModel->getProfile(1);
        $data['activeCustomers'] = "active";
        $data['uniqid'] = uniqid();
        $data['page'] = 'Admin/customers/mainCustomers';

        return view('Admin/mainAdmin', $data);
    }

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

        $result = $this->objMainModel->getCustomersProcessingData($params);
        $totalRows = sizeof($result);

        for ($i = 0; $i < $totalRows; $i++) {
            $status = '';
            $switch = '';

            if ($result[$i]->status == 1) {
                $status = sprintf('<span class="badge badge-light-success">%s</span>', lang("Text.dt_customer_cell_status_active"));
                $switch = '<label class="form-check form-switch form-switch-sm form-check-solid flex-stack mb-5 form-check-success"> <input data-id="' . $result[$i]->id . '" data-status="' . $result[$i]->status . '"class="form-check-input switch_active_inactive" type="checkbox" id="flexSwitchCheckChecked" checked /></label>';
            } else {
                $status = sprintf('<span class="badge badge-light-danger">%s</span>', lang("Text.dt_customer_cell_status_inactive"));
                $switch = '<label class="form-check form-switch form-switch-sm form-check-solid flex-stack mb-5 form-check-danger"> <input data-id="' . $result[$i]->id . '" data-status="' . $result[$i]->status . '"class="form-check-input switch_active_inactive" type="checkbox" id="flexSwitchCheckChecked" /></label>';
            }

            $term = '';

            if ($result[$i]->term == 1) {
                $term = sprintf('<span class="badge badge-light-success">%s</span>', lang("Text.dt_customer_cell_term_accepted"));
            } else {
                $term = sprintf('<span class="badge badge-light-danger">%s</span>', lang("Text.dt_customer_cell_term_rejected"));
            }

            $emailSubscription = '';

            if ($result[$i]->emailSubscription == 1) {
                $emailSubscription = sprintf('<span class="badge badge-light-success">%s</span>', lang("Text.dt_customer_cell_emailSub_subscribed"));
            } else {
                $emailSubscription = sprintf('<span class="badge badge-light-danger">%s</span>', lang("Text.dt_customer_cell_emailSub_not_subscribed"));
            }

            $btn_edit = '<button class="btn btn-sm btn-light btn-active-color-warning btn-edit-employee m-1" data-id="' . $result[$i]->id . '"><span class="bi bi-pencil-fill" title="Editar Cliente"></span></button>';
            $btn_delete = '<button class="btn btn-sm btn-light btn-active-color-danger btn-delete-employee m-1" data-id="' . $result[$i]->id . '"><span class="bi bi-trash-fill" title="Eliminar Cliente"></span></button>';

            $col = array();
            $col['name'] = $result[$i]->name;
            $col['lastName'] = $result[$i]->lastName;
            $col['email'] = $result[$i]->email;
            $col['phone'] = $result[$i]->phone;
            $col['switch'] = $switch;
            //$col['status'] = $status;
            $col['term'] = $term;
            $col['emailSubscription'] = $emailSubscription;
            $col['action'] = $btn_edit . $btn_delete;

            $row[$i] =  $col;
        }

        if ($totalRows > 0)
            $totalRecords = $this->objMainModel->getTotalCustomers();

        $data = array();
        $data['draw'] = $dataTableRequest['draw'];
        $data['recordsTotal'] = intval($totalRecords);
        $data['recordsFiltered'] = intval($totalRecords);
        $data['data'] = $row;

        return json_encode($data);
    }

    public function changeCustomerStatus()
    {
        $response = array();
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "session expired";
            return json_encode($result);
        }

        $data = array();
        $data['status'] = $this->request->getPost('status');

        $result = $this->objMainModel->objUpdate('customer', $data, $this->request->getPost('userID'));

        if ($result['error'] == 0) {
            $response['error'] = 0;
            $response['msg'] = 'Success';
        } else {
            $response['error'] = 1;
            $response['msg'] = 'Error';
        }

        return json_encode($response);
    }

    public function showModalCustomer()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('adminLogout');

        $data = array();
        $data['config'] = $this->config;
        $data['action'] = $this->objRequest->getPost('action');
        $data['uniqid'] = uniqid();

        if ($data['action'] == "create")
            $data['modalTitle'] = lang("Text.cust_new");
        else {
            $data['modalTitle'] = lang("Text.serv_update");
            $data['service'] = $this->objMainModel->objData('service', 'id', $this->objRequest->getPost('id'))[0];
        }

        return view('Admin/customers/modalCustomer', $data);
    }

    public function createCustomer()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "session expired";
            return json_encode($result);
        }

        $data = array();
        $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $data['lastName'] = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $data['email'] = htmlspecialchars(trim($this->objRequest->getPost('email')));
        $data['status'] = 0;
        $data['token'] = md5(uniqid());

        $checkDuplicate = $this->objMainModel->objCheckDuplicate('customer', 'email', $data['email']);

        if (empty($checkDuplicate)) {
            $profile = $this->objProfileModel->getProfile(1);

            $emailData = array();
            $emailData['token'] = $data['token'];
            $emailData['companyName'] = $profile[0]->company_name;

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $profile[0]->company_name);
            $this->objEmail->setTo($data['email']);
            $this->objEmail->setSubject('Complete Your Account');
            $this->objEmail->setMessage(view('email/completeAccount', $emailData), []);
            if ($this->objEmail->send(false)) {
                $response['error'] = 0;
                $response['msg'] = 'SUCCESS_SEND_EMAIL';
                $result = $this->objMainModel->objCreate('customer', $data);
                if ($result['error'] == 0) {
                    $response['error'] = 0;
                    $response['msg'] = 'SUCCESS_CREATE_CUSTOMER';
                } else {
                    $response['error'] = 1;
                    $response['msg'] = 'ERROR_CREATE_CUSTOMER';
                }
            } else {
                $response['error'] = 1;
                $response['msg'] = 'ERROR_SEND_EMAIL';
            }

            return json_encode($response);
        } else {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "duplicate";
            return json_encode($result);
        }
    }

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
        $data['profile'] = $this->objProfileModel->getProfile(1);
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
                $data['profile'] = $this->objProfileModel->getProfile(1);
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
        $profile = $this->objProfileModel->getProfile(1);
        $dataEmail = array();
        $dataEmail['pageTitle'] = $profile[0]->company_name;
        $dataEmail['person'] = "Axley Herrera";
        $dataEmail['url'] = base_url('Home');
        $dataEmail['companyPhone'] = $profile[0]->phone1;
        $dataEmail['companyEmail'] = $profile[0]->email;

        return view('email/createCustomerByAdmin', $dataEmail);
    }
}
