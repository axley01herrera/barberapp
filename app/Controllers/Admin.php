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
        $data['activeDashboard'] = "active";
        $data['page'] = 'Admin/dashboard/mainDashboard';

        return view('Admin/mainAdmin', $data);
    }

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
        if (empty($data['profile'][0]->avatar))
            $data['profilePercent'] = 0;
        else
            $data['profilePercent'] = 1;

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
        $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $data['last_name'] = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
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

        if($this->objConfigModel->login($key)['error'] === 1) {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "invalid current key";
            return json_encode($result);
        }

        $data = array();
        $data['access_key'] = password_hash(htmlspecialchars(trim($this->objRequest->getPost('newp'))), PASSWORD_DEFAULT);

        return json_encode($this->objMainModel->objUpdate('config', $data, 1));
    }
}
