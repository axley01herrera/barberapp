<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthenticationModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function loginCustomer($email, $password)
    {
        $query = $this->db->table('customer')
            ->where('email', $email)
            ->where('deleted', 0);

        $data = $query->get()->getResult();
        $result = array();

        if (empty($data)) { 
            $result = array();
            $result['error'] = 1;
            $result['msg'] = 'EMAIL_NOT_FOUND';

            return $result;
        }

        if (password_verify($password, $data[0]->password)) {
            if ($data[0]->status == 1) {
                $result = array();
                $result['error'] = 0;
                $result['data'] = $data[0];

                return $result;
            } else {
                $result = array();
                $result['error'] = 1;
                $result['msg'] = 'USER_INACTIVE';

                return $result;
            }
        } else {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = 'INVALID_PASSWORD';

            return $result;
        }
    } // ok

    public function loginEmployee($email, $password)
    {
        $query = $this->db->table('employee')
            ->where('email', $email)
            ->where('deleted', 0);

        $data = $query->get()->getResult();
        $result = array();

        if (empty($data)) { 
            $result = array();
            $result['error'] = 1;
            $result['msg'] = 'EMAIL_NOT_FOUND';

            return $result;
        }

        if (password_verify($password, $data[0]->password)) {
            if ($data[0]->status == 1) {
                $result = array();
                $result['error'] = 0;
                $result['data'] = $data[0];

                return $result;
            } else {
                $result = array();
                $result['error'] = 1;
                $result['msg'] = 'USER_INACTIVE';

                return $result;
            }
        } else {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = 'INVALID_PASSWORD';

            return $result;
        }
    } // ok
}