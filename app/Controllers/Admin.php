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

    public function __construct()
    {
        # Clear Session
        $this->objSession = session();
        $this->objRequest = \Config\Services::request();
        $this->objConfigModel = new Config_Model;
        $this->objProfileModel = new Profile_Model;
        $this->objMainModel = new Main_Model;
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

        $profilePercent  = 0;

        if (!empty($data['profile'][0]->company_name)) // 1
            $profilePercent++;

        if (!empty($data['profile'][0]->company_type)) // 2
            $profilePercent++;

        if (!empty($data['profile'][0]->email)) // 3
            $profilePercent++;

        if (!empty($data['profile'][0]->phone1)) // 4
            $profilePercent++;

        if (!empty($data['profile'][0]->address1)) // 5
            $profilePercent++;

        if (!empty($data['profile'][0]->avatar)) // 6
            $profilePercent++;

        $data['profilePercent'] = number_format($profilePercent * 100  / 6, 0,".",',');

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

        return json_encode($this->objMainModel->objUpdate('config', $data, 1));
    }

    # End Section Profile
}
