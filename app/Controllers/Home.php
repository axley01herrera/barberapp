<?php

namespace App\Controllers;

use App\Models\Config_Model;
use App\Models\Profile_Model;

class Home extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objConfigModel;
    protected $objProfileModel;
    protected $config;

    public function __construct()
    {
        # Clear Session
        $this->objSession = session();
        $this->objSession->set('user', []);
        $this->objRequest = \Config\Services::request();
        $this->objConfigModel = new Config_Model;
        $this->objProfileModel = new Profile_Model;
        $this->config = $this->objConfigModel->getConfig(1);
        $this->objRequest->setLocale($this->config[0]->lang);
    }

    public function index()
    {
        $data = array();
        $data['config'] = $this->config;
        $data['profile'] = $this->objProfileModel->getProfile(1);
        $data['page'] = 'home/mainHome';

        return view('main', $data);
    }

    public function loginAdmin()
    {
        $data = array();
        $data['session'] = $this->request->getGet('session');
        $data['config'] = $this->config;
        $data['profile'] = $this->objProfileModel->getProfile(1);
        $data['uniqid'] = uniqid();
        $data['page'] = 'loginAdmin/mainLoginAdmin';
        
        return view('main', $data);
    }

    public function loginAdminProcess()
    {
        $key = htmlspecialchars(trim($this->objRequest->getPost('key')));

        if(empty($key)) {
            $result = array();
            $result['error'] = 1;
            $result['code'] = "empty key";
            $result['msg'] = lang('Text.la_required_password');
            
            return json_encode($result);
        }

        $result = $this->objConfigModel->login($key);

        if($result['error'] === 0) {
            # Create Session
            $session = array();
            $session['role'] = 'admin';
            $this->objSession->set('user', $session);
        }

        return json_encode($result);
    }
}
