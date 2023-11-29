<?php

namespace App\Controllers;

use App\Models\Config_Model;
use App\Models\Admin_Model;
use App\Models\Main_Model;

class Home extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objConfigModel;
    protected $objAdminModel;
    protected $objMainModel;
    protected $config;

    public function __construct()
    {
        # Clear Session
        $this->objSession = session();
        $this->objSession->set('user', []);
        $this->objRequest = \Config\Services::request();
        $this->objConfigModel = new Config_Model;
        $this->objAdminModel = new Admin_Model;
        $this->objMainModel = new Main_Model;
        $this->config = $this->objConfigModel->getConfig(1);
        $this->objRequest->setLocale($this->config[0]->lang);
    }

    public function index()
    {
        $data = array();
        $data['config'] = $this->config;
        $data['profile'] = $this->objAdminModel->getProfile(1);
        $data['page'] = 'home/mainHome';

        return view('main', $data);
    }

    public function loginAdmin()
    {
        $data = array();
        $data['session'] = $this->request->getGet('session');
        $data['config'] = $this->config;
        $data['profile'] = $this->objAdminModel->getProfile(1);
        $data['uniqid'] = uniqid();
        $data['page'] = 'loginAdmin/mainLoginAdmin';

        return view('main', $data);
    }

    public function loginAdminProcess()
    {
        $key = htmlspecialchars(trim($this->objRequest->getPost('key')));

        if (empty($key)) {
            $result = array();
            $result['error'] = 1;
            $result['code'] = "empty key";
            $result['msg'] = lang('Text.la_required_password');

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
        $token = $this->objRequest->getPostGet('token');

        $data = array();
        $data['config'] = $this->config;
        $data['profile'] = $this->objAdminModel->getProfile(1);

        if (empty($token))
            return view('emptyToken', $data);

        $result = $this->objMainModel->objData('customer', 'token', $token);

        if (!empty($result)) {

            $dataUpdate = array();
            $dataUpdate['emailVerified'] = 1;
            $dataUpdate['token'] = '';
            $this->objMainModel->objUpdate('customer', $dataUpdate, $result[0]->id);

            $data['uniqid'] = uniqid();
            $data['customerID'] = $result[0]->id;
            $data['page'] = 'Admin/customers/createPassword';

            return view('main', $data);
        } else
            return view('tokenExpired', $data);
    }

    public function createPassword()
    {
        $data = array();
        $data['password'] = password_hash(htmlspecialchars(trim($this->objRequest->getPost('pass'))), PASSWORD_DEFAULT);

        return json_encode($this->objMainModel->objUpdate('customer', $data, $this->objRequest->getPost('customerID')));
    }
}
