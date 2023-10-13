<?php

namespace App\Controllers;

use App\Models\Config_Model;
use App\Models\Profile_Model;

class Admin extends BaseController
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
        $this->objRequest = \Config\Services::request();
        $this->objConfigModel = new Config_Model;
        $this->objProfileModel = new Profile_Model;
        $this->config = $this->objConfigModel->getConfig(1);
        $this->objRequest->setLocale($this->config[0]->lang);
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

    public function profile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "admin")
            return view('adminLogout');

        $data = array();
        $data['config'] = $this->config;
        $data['profile'] = $this->objProfileModel->getProfile(1);
        $data['activeProfile'] = "active";
        $data['page'] = 'Admin/profile/mainProfile';

        return view('Admin/mainAdmin', $data);
    }
}
