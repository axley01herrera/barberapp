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
    }

    public function loginAdminProcess()
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
    }

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
}
