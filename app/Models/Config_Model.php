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
            $result['msg'] = lang('Text.la_invalid_password');
            return $result;
        }
    }
}