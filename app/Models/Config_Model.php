<?php

namespace App\Models;

use CodeIgniter\Model;

class Config_Model extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getConfig($id)
    {
        $query = $this->db->table('config')
        ->where('id', $id);

        return $query->get()->getResult();
    }

    public function login($key)
    {
        $query = $this->db->table('config')
        ->where('id', 1);

        $data = $query->get()->getResult();

        if (password_verify($key, $data[0]->access_key)) {
            $result = array();
            $result['error'] = 0;
            return $result;
        } else {
            $result = array();
            $result['error'] = 1;
            $result['code'] = "invalid access key";
            $result['msg'] = lang('Text.cp_auth_invalid_password');
            return $result;
        }
    }

    public function loginCustomer($email, $password)
    {
        $query = $this->db->table('customer')
            ->where('email', $email);

        $data = $query->get()->getResult();
        $result = array();

        if (empty($data)) {
            $result['error'] = 1;
            $result['msg'] = 'EMAIL_NOT_FOUND';
            return $result;
        }

        if (password_verify($password, $data[0]->password)) {
            if ($data[0]->status == 1) {
                $result['error'] = 0;
                $result['data'] = $data[0];
            } else {
                $result['error'] = 1;
                $result['msg'] = 'ACTIVATE_STATUS';
            }
        } else {
            $result['error'] = 1;
            $result['msg'] = 'INVALID_PASSWORD';
        }

        return $result;
    }
}