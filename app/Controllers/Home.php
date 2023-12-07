<?php

namespace App\Controllers;

use App\Models\AuthenticationModel;
use App\Models\ConfigModel;
use App\Models\ControlPanelModel;
use App\Models\MainModel;

class Home extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objConfigModel;
    protected $objControlPanelModel;
    protected $objAuthenticationModel;
    protected $objMainModel;
    protected $config;
    protected $profile;
    protected $objEmail;

    public function __construct()
    {
        # Clear Session
        $this->objSession = session();
        $this->objSession->set('user', []);

        # Models
        $this->objConfigModel = new ConfigModel;
        $this->objControlPanelModel = new ControlPanelModel;
        $this->objAuthenticationModel = new AuthenticationModel;
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
        $data = array();
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        $data['page'] = 'home/landing';

        return view('home/mainHome', $data);
    }

    public function controlPanelAuth()
    {
        # params
        $session = $this->request->getGet('session');

        $data = array();
        # data
        $data['session'] = $session;
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
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

        if ($result['error'] == 0) {
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
        $data['profile'] = $this->profile;

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

    public function employeeCreatePassword()
    {
        # params
        $token = $this->objRequest->getPostGet('token');

        # data
        $data = array();
        $data['uniqid'] = uniqid();
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;

        if (empty($token))
            return view('errorPages/globalError', $data);

        $result = $this->objMainModel->objData('employee', 'token', $token);

        if (!empty($result)) {
            $data['employeeID'] = $result[0]->id;

            $dataUpdate = array();
            $dataUpdate['emailVerified'] = 1;
            $dataUpdate['token'] = '';

            $this->objMainModel->objUpdate('employee', $dataUpdate, $data['employeeID']);

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
        $employeeID = $this->objRequest->getPost('employeeID');

        $password = password_hash(htmlspecialchars(trim($this->objRequest->getPost('password'))), PASSWORD_DEFAULT);

        $data = array();
        $data['password'] = $password;
        $data['status'] = 1;

        $table = "";
        $id = "";

        if (!empty($customerID)) {
            $table = 'customer';
            $id = $customerID;
        }

        if (!empty($employeeID)) {
            $table = 'employee';
            $id = $employeeID;
        }

        $result = $this->objMainModel->objUpdate($table, $data, $id);

        return json_encode($result);
    } // ok

    public function signInCustomer()
    {
        # params
        $session = $this->request->getGet('session');

        $data = array();
        # data
        $data['uniqid'] = uniqid();
        $data['session'] = $session;
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        # page
        $data['page'] = 'home/signInCustomer';

        return view('home/mainHome', $data);
    } // ok

    public function signInCustomerProcess()
    {
        $email = strtolower(htmlspecialchars(trim($this->objRequest->getPost('email'))));
        $password = htmlspecialchars(trim($this->objRequest->getPost('pass')));

        $result = $this->objAuthenticationModel->loginCustomer($email, $password);

        if ($result['error'] == 0) {
            $data = array();
            $data['lastSession'] = date('Y-m-d');
            $this->objMainModel->objUpdate('customer', $data, $result['data']->id);

            # Create Session
            $session = array();
            $session['customerID'] = $result['data']->id;
            $session['role'] = 'customer';
            $session['email'] = $result['data']->email;

            $this->objSession->set('user', $session);
        }
        $response = array();
        $response['error'] = $result['error'];
        $response['msg'] = @$result['msg'];

        return json_encode($response);
    } // ok

    public function signInEmployee()
    {
        # params
        $session = $this->request->getGet('session');

        $data = array();
        # data
        $data['uniqid'] = uniqid();
        $data['session'] = $session;
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        # page
        $data['page'] = 'home/signInEmployee';

        return view('home/mainHome', $data);
    }

    public function signInEmployeeProcess()
    {
        $email = strtolower(htmlspecialchars(trim($this->objRequest->getPost('email'))));
        $password = htmlspecialchars(trim($this->objRequest->getPost('pass')));

        $result = $this->objAuthenticationModel->loginEmployee($email, $password);

        if ($result['error'] == 0) {
            $data = array();
            $data['lastSession'] = date('Y-m-d');
            $this->objMainModel->objUpdate('employee', $data, $result['data']->id);

            # Create Session
            $session = array();
            $session['employeeID'] = $result['data']->id;
            $session['role'] = 'employee';
            $session['email'] = $result['data']->email;

            $this->objSession->set('user', $session);
        }
        $response = array();
        $response['error'] = $result['error'];
        $response['msg'] = @$result['msg'];

        return json_encode($response);
    }

    public function signUpCustomer()
    {
        $data = array();
        # data
        $data['uniqid'] = uniqid();
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        #page
        $data['page'] = 'home/signUpCustomer';

        return view('home/mainHome', $data);
    } // ok

    public function policyPrivacyModal()
    {
        return view('home/policyPrivacyModal');
    } // ok

    public function signUpCustomerProcess()
    {
        # params
        $name = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $lastName = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $email = strtolower(htmlspecialchars(trim($this->objRequest->getPost('email'))));
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
        $data['token'] = $token;

        # Create Customer
        $result = $this->objMainModel->objCreate('customer', $data);


        # Sen Email
        $dataEmail = array();
        $dataEmail['pageTitle'] = $this->profile[0]->company_name;
        $dataEmail['person'] = $name . ' ' . $lastName;
        $dataEmail['url'] = base_url('Home/verifiedEmail') . '?token=' . $token . '&type=customer';
        $dataEmail['companyPhone'] = $this->profile[0]->phone1;
        $dataEmail['companyEmail'] = $this->profile[0]->email;

        $this->objEmail->setFrom(EMAIL_SMTP_USER, $this->profile[0]->company_name);
        $this->objEmail->setTo($email);
        $this->objEmail->setSubject($this->profile[0]->company_name);
        $this->objEmail->setMessage(view('email/mailSignup', $dataEmail), []);

        $this->objEmail->send(false);

        return json_encode($result);
    } // ok

    public function verifiedEmail()
    {
        # params
        $token = $this->objRequest->getPostGet('token');
        $type = $this->objRequest->getPostGet('type');
        $table = "";

        if ($type == "customer")
            $table = $type;
        if ($type == "employee")
            $table = $type;

        $data = array();
        # data
        $data['uniqid'] = uniqid();
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;

        if (empty($token))
            return view('errorPages/globalError', $data);
        if (empty($table))
            return view('errorPages/globalError', $data);

        $result = $this->objMainModel->objData($table, 'token', $token);

        if (!empty($result)) {
            $dataUpdate = array();
            $dataUpdate['emailVerified'] = 1;
            $dataUpdate['token'] = '';

            # Update Customer 
            $this->objMainModel->objUpdate($table, $dataUpdate, $result[0]->id);

            return view('home/successActivateAccount', $data);
        } else
            return view('errorPages/tokenExpired', $data);
    } // ok

    public function forgotPassword()
    {
        $data = array();
        #data
        $data['uniqid'] = uniqid();
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;
        #page
        $data['page'] = 'home/forgotPassword';

        return view('home/mainHome', $data);
    } // ok

    public function sendForgotPasswordEmail()
    {
        # params
        $email = strtolower(htmlspecialchars(trim($this->objRequest->getPost('email'))));

        $result = $this->objMainModel->objData('customer', 'email', $email);

        if (empty($result)) {
            $response = array();
            $response['error'] = 1;
            $response['msg'] = 'EMAIL_NOT_FOUND';

            return json_encode($response);
        }

        $data = array();
        #data
        $data = array();
        $data['token'] = md5(uniqid());

        # Update Customer
        $this->objMainModel->objUpdate('customer', $data, $result[0]->id);

        $data['uniqid'] = uniqid();
        $data['config'] = $this->config;
        $data['profile'] = $this->profile;

        # Sen Email
        $dataEmail = array();
        $dataEmail['pageTitle'] = $this->profile[0]->company_name;
        $dataEmail['person'] = $result[0]->name . ' ' . $result[0]->lastName;
        $dataEmail['url'] = base_url('Home/customerCreatePassword') . '?token=' . $data['token'];
        $dataEmail['companyPhone'] = $this->profile[0]->phone1;
        $dataEmail['companyEmail'] = $this->profile[0]->email;

        $this->objEmail->setFrom(EMAIL_SMTP_USER, $this->profile[0]->company_name);
        $this->objEmail->setTo($email);
        $this->objEmail->setSubject($this->profile[0]->company_name);
        $this->objEmail->setMessage(view('email/recoverPassword', $dataEmail), []);

        if ($this->objEmail->send(false)) {
            $response = array();
            $response['error'] = 0;
            $response['msg'] = 'SUCCESS_SEND_EMAIL';
        } else {
            $response = array();
            $response['error'] = 1;
            $response['msg'] = 'ERROR_SEND_EMAIL';
        }

        return json_encode($response);
    } // ok

    public function emailView()
    {
        $profile = $this->objControlPanelModel->getProfile(1);
        $dataEmail = array();
        $dataEmail['pageTitle'] = $profile[0]->company_name;
        $dataEmail['person'] = "Axley Herrera";
        $dataEmail['url'] = base_url('Home');
        $dataEmail['companyPhone'] = $profile[0]->phone1;
        $dataEmail['companyEmail'] = $profile[0]->email;

        return view('email/recoverPassword', $dataEmail);
    }
}
