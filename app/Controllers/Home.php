<?php

namespace App\Controllers;

use App\Models\Config_Model;
use App\Models\ControlPanelModel;
use App\Models\Main_Model;

class Home extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objConfigModel;
    protected $objControlPanelModel;
    protected $objMainModel;
    protected $config;
    protected $objEmail;

    public function __construct()
    {
        # Clear Session
        $this->objSession = session();
        $this->objSession->set('user', []);
        $this->objRequest = \Config\Services::request();
        $this->objConfigModel = new Config_Model;
        $this->objControlPanelModel = new ControlPanelModel;
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
    }

    public function index()
    {
        $data = array();
        $data['config'] = $this->config;
        $data['profile'] = $this->objControlPanelModel->getProfile(1);
        $data['page'] = 'home/landing';

        return view('home/mainHome', $data);
    }

    public function controlPanelAuth()
    {
        $data = array();
        $data['session'] = $this->request->getGet('session');
        $data['config'] = $this->config;
        $data['profile'] = $this->objControlPanelModel->getProfile(1);
        $data['uniqid'] = uniqid();
        $data['page'] = 'home/controlPanelAuthentication';

        return view('home/mainHome', $data);
    } // ok

    public function controlPanelAuthProcess()
    {
        $key = htmlspecialchars(trim($this->objRequest->getPost('key')));

        if (empty($key)) {
            $result = array();
            $result['error'] = 1;
            $result['code'] = "empty key";
            $result['msg'] = lang('Text.cp_auth_required_password');

            return json_encode($result);
        }

        $result = $this->objConfigModel->login($key);

        if ($result['error'] === 0) {
            # Create Session
            $session = array();
            $session['role'] = 'admin';
            $this->objSession->set('user', $session);
        }

        return json_encode($result);
    } // ok

    public function customerCreatePassword()
    {
        # params
        $token = $this->objRequest->getPostGet('token');

        # data
        $data = array();
        $data['uniqid'] = uniqid();
        $data['config'] = $this->config;
        $data['profile'] = $this->objControlPanelModel->getProfile(1);

        if (empty($token))
            return view('errorPages/globalError', $data);

        $result = $this->objMainModel->objData('customer', 'token', $token);

        if (!empty($result)) {

            $data['customerID'] = $result[0]->id;

            $dataUpdate = array();
            $dataUpdate['emailVerified'] = 1;
            $dataUpdate['token'] = '';

            $this->objMainModel->objUpdate('customer', $dataUpdate, $data['customerID']);

            # page
            $data['page'] = 'home/formCreatePassword';

            return view('home/mainHome', $data);
        } else
            return view('errorPages/tokenExpired', $data);
    } // ok

    public function createPassword()
    {
        # params
        $customerID = $this->objRequest->getPost('customerID');
        $password = password_hash(htmlspecialchars(trim($this->objRequest->getPost('pass'))), PASSWORD_DEFAULT);

        $data = array();
        $data['password'] = $password;
        $data['status'] = 1;

        $table = "";

        if (!empty($customerID))
            $table = 'customer';

        $result = $this->objMainModel->objUpdate($table, $data, $customerID);

        return json_encode($result);
    } // ok

    public function signInCustomer()
    {
        $data = array();
        $data['uniqid'] = uniqid();
        $data['config'] = $this->config;
        $data['profile'] = $this->objControlPanelModel->getProfile(1);
        #page
        $data['page'] = 'home/signInCustomer';

        return view('home/mainHome', $data);
    }

    public function signInCustomerProcess()
    {
        $email = htmlspecialchars(trim($this->objRequest->getPost('email')));
        $password = htmlspecialchars(trim($this->objRequest->getPost('pass')));

        $result = $this->objConfigModel->loginCustomer($email, $password);

        if ($result['error'] == 1)
            return json_encode($result);

        # CREATE SESSION
        $session = array();
        $session['id'] = $result['data']->id;
        $session['user'] = $result['data']->name . ' ' . $result['data']->lastName;
        $session['email'] = $result['data']->email;
        $session['role'] = 'customer';

        $this->objSession->set('user', $session);

        $response = array();
        $response['error'] = 0;

        return json_encode($response);
    }

    public function signUpCustomer()
    {
        $data = array();
        $data['uniqid'] = uniqid();
        $data['config'] = $this->config;
        $data['profile'] = $this->objControlPanelModel->getProfile(1);
        #page
        $data['page'] = 'home/signUpCustomer';

        return view('home/mainHome', $data);
    }

    public function signUpCustomerProcess()
    {
        $name = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $lastName = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $email = htmlspecialchars(trim($this->objRequest->getPost('email')));
        $phone = htmlspecialchars(trim($this->objRequest->getPost('phone')));
        $password = password_hash(htmlspecialchars(trim($this->objRequest->getPost('pass'))), PASSWORD_DEFAULT);
        $token = md5(uniqid());

        # Check Duplicate Email
        $checkEmail = $this->objMainModel->objCheckDuplicate('customer', 'email', $email, '');
        if (!empty($checkEmail)) {
            $response['error'] = 1;
            $response['msg'] = "DUPLICATE_EMAIL";
            return json_encode($response);
        }

        $data = array();
        $data['name'] = $name;
        $data['lastName'] = $lastName;
        $data['password'] = $password;
        $data['email'] = $email;
        $data['phone'] = $phone;
        $data['status'] = 0;
        $data['emailVerified'] = 0;
        $data['term'] = $this->objRequest->getPost('terms');
        $data['emailSubscription'] = $this->objRequest->getPost('emailSubscription');
        $data['token'] = $token;

        //var_dump($data);exit();

        # Create Customer
        $result = $this->objMainModel->objCreate('customer', $data);

        if ($result['error'] == 0) {
            $profile = $this->objControlPanelModel->getProfile(1);
            # Sen Activate Status Email
            $dataEmail = array();
            $dataEmail['pageTitle'] = $profile[0]->company_name;
            $dataEmail['person'] = $name . ' ' . $lastName;
            $dataEmail['url'] = base_url('Home/confirmSignup') . '?token=' . $token;
            $dataEmail['companyPhone'] = $profile[0]->phone1;
            $dataEmail['companyEmail'] = $profile[0]->email;

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $profile[0]->company_name);
            $this->objEmail->setTo($email);
            $this->objEmail->setSubject($profile[0]->company_name);
            $this->objEmail->setMessage(view('email/mailSignup', $dataEmail), []);

            if ($this->objEmail->send(false)) {
                $response['error'] = 0;
                $response['msg'] = 'SUCCESS_SEND_EMAIL';
            } else {
                $response['error'] = 1;
                $response['msg'] = 'ERROR_SEND_EMAIL';
            }
        } else {
            $response['error'] = 1;
            $response['msg'] = 'ERROR_CREATE_CUSTOMER';
        }

        return json_encode($response);
    }

    public function confirmSignup()
    {
        # params
        $token = $this->objRequest->getPostGet('token');

        # data
        $data = array();
        $data['uniqid'] = uniqid();
        $data['config'] = $this->config;
        $data['profile'] = $this->objControlPanelModel->getProfile(1);

        if (empty($token))
            return view('errorPages/globalError', $data);


        $result = $this->objMainModel->objData('customer', 'token', $token);

        if (!empty($result)) {
            $data = array();
            $data['status'] = 1;
            $data['emailVerified'] = 1;
            $data['token'] = '';

            # Update Customer 
            $this->objMainModel->objUpdate('customer', $data, $result[0]->id);

            # data
            $data['config'] = $this->config;
            $data['profile'] = $this->objControlPanelModel->getProfile(1);
            return view('home/successActivateAccount', $data);
        } else
            return view('errorPages/tokenExpired', $data);
    }
}
