<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\MainModel;
use App\Models\ControlPanelModel;


class Customer extends BaseController
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
    }

    public function index()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer")
            return view('customerLogout');

        # data
        $data = array();
        $data['uniqid'] = uniqid();
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        $data['customer'] = $this->objMainModel->objData('customer', 'id', $this->objSession->get('user')['customerID']);
        $data['address'] = $this->objMainModel->objData('address', 'customerID', $this->objSession->get('user')['customerID']);
        # page
        $data['page'] = 'customer/index';

        return view('customer/mainCustomer', $data);
    }

    public function reloadCustomerInfo()
    {
        # data
        $data = array();
        $data['customer'] = $this->objMainModel->objData('customer', 'id', $this->objSession->get('user')['customerID']);
        $data['address'] = $this->objMainModel->objData('address', 'customerID', $this->objSession->get('user')['customerID']);

        return view('customer/customerInfo', $data);
    }

    public function customerTabContent()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer")
            return view('customerLogout');

        # params
        $tab = $this->objRequest->getPost('tab');

        $data = array();
        # data
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        $data['uniqid'] = uniqid();

        $view = "";

        switch ($tab) {
            case 'tab-overview':
                # page
                $view = "customer/tabContent/tabOverview";
                break;
            case 'tab-account':
                $data['customer'] = $this->objMainModel->objData('customer', 'id', $this->objSession->get('user')['customerID']);
                $data['address'] = $this->objMainModel->objData('address', 'customerID', $this->objSession->get('user')['customerID']);
                # page
                $view = "customer/tabContent/tabAccount";
                break;
            case 'tab-profile':
                $data['customer'] = $this->objMainModel->objData('customer', 'id', $this->objSession->get('user')['customerID']);
                $data['address'] = $this->objMainModel->objData('address', 'customerID', $this->objSession->get('user')['customerID']);
                # page
                $view = "customer/tabContent/tabProfile";
                break;
        }

        return view($view, $data);
    }

    public function updateAccount()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        $token = md5(uniqid());

        $dataAccount = array();
        $dataAccount['email'] = htmlspecialchars(trim($this->objRequest->getPost('email')));
        if (!empty(htmlspecialchars(trim($this->objRequest->getPost('password')))))
            $dataAccount['password'] = password_hash(htmlspecialchars(trim($this->objRequest->getPost('password'))), PASSWORD_DEFAULT);

        $customer = $this->objMainModel->objData('customer', 'id', $this->objSession->get('user')['customerID']);

        $response = array();
        if ($this->objSession->get('user')['email'] !== $dataAccount['email']) {
            $dataAccount['token'] = $token;
            $dataAccount['emailVerified'] = 0;

            $dataEmail = array();
            $dataEmail['pageTitle'] = $this->profile[0]->company_name;
            $dataEmail['person'] = $customer[0]->name . ' ' . $customer[0]->lastName;
            $dataEmail['url'] = base_url('Home/verifiedEmail') . '?token=' . $token . '&action=reactivate';
            $dataEmail['action'] = "reactivate";
            $dataEmail['companyPhone'] = $this->profile[0]->phone1;
            $dataEmail['companyEmail'] = $this->profile[0]->email;

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $this->profile[0]->company_name);
            $this->objEmail->setTo($dataAccount['email']);
            $this->objEmail->setSubject($this->profile[0]->company_name);
            $this->objEmail->setMessage(view('email/mailSignup', $dataEmail), []);

            if ($this->objEmail->send(false)) {
                $this->objMainModel->objUpdate('customer', $dataAccount, $this->objSession->get('user')['customerID']);
                $response['error'] = 0;
                $response['msg'] = 'SENT_EMAIL';
            } else {
                $response['error'] = 1;
                $response['msg'] = 'ERROR_SEND_EMAIL';
            }
        } else
            $response['error'] = 0;


        return json_encode($response);
    }

    public function updateProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        $dataProfile = array();
        $dataProfile['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $dataProfile['lastName'] = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $dataProfile['phone'] = htmlspecialchars(trim($this->objRequest->getPost('phone')));
        $dataProfile['gender'] = htmlspecialchars(trim($this->objRequest->getPost('gender')));

        $resultUpdateCustomer = $this->objMainModel->objUpdate('customer', $dataProfile, $this->objSession->get('user')['customerID']);
        if ($resultUpdateCustomer['error'] == 0) {

            $dataAddress = array();
            $dataAddress['line1'] = htmlspecialchars(trim($this->objRequest->getPost('address1')));
            $dataAddress['line2'] = htmlspecialchars(trim($this->objRequest->getPost('address2')));
            $dataAddress['city'] = htmlspecialchars(trim($this->objRequest->getPost('city')));
            $dataAddress['state'] = htmlspecialchars(trim($this->objRequest->getPost('state')));
            $dataAddress['zip'] = htmlspecialchars(trim($this->objRequest->getPost('zip')));
            $dataAddress['country'] = htmlspecialchars(trim($this->objRequest->getPost('country')));

            $updateAddress = $this->objMainModel->objData('address', 'customerID', $this->objSession->get('user')['customerID']);
            if (!empty($updateAddress))
                $this->objMainModel->objUpdate('address', $dataAddress, $updateAddress[0]->id);
            else {
                $dataAddress['customerID'] = $this->objSession->get('user')['customerID'];
                $this->objMainModel->objCreate('address', $dataAddress);
            }
            $result['error'] = 0;
        } else {
            $result['error'] = 1;
            $result['msg'] = 'ERROR_ON_UPDATE_CUSTOMER';
        }
        return json_encode($result);
    }

    public function uploadAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        return json_encode($this->objMainModel->uploadFile('customer', $this->objSession->get('user')['customerID'], 'avatar', $_FILES['file']));
    }

    public function removeAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        $data = array();
        $data['avatar'] = '';

        return json_encode($this->objMainModel->objUpdate('customer', $data, $this->objSession->get('user')['customerID']));
    }
}
