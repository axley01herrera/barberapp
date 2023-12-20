<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getCompanyProfileAbout()
    {
        $query = $this->db->table('company_profile')
        ->select('about')
        ->where('id', 1);

        $data = $query->get()->getResult();

        return $data;
    }
}
