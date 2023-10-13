<?php

namespace App\Models;

use CodeIgniter\Model;

class Profile_Model extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getProfile($id)
    {
        $query = $this->db->table('profile')
        ->where('id', $id);

        return $query->get()->getResult();
    }
}