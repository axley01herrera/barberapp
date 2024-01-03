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

    public function getCompanyProfileSettings()
    {
        $query = $this->db->table('company_profile')
            ->select('companyID, avatar, companyName, companyType, email, phone1, address1, address2, city, state, zip, country, about')
            ->where('id', 1);

        $data = $query->get()->getResult();

        return $data;
    } // ok

    public function getCompanyProfileAbout()
    {
        $query = $this->db->table('company_profile')
            ->select('about')
            ->where('id', 1);

        $data = $query->get()->getResult();

        return $data;
    } // ok

    public function getCompanyProfilePrivacyPolice()
    {
        $query = $this->db->table('company_profile')
            ->select('privacyPolice')
            ->where('id', 1);

        $data = $query->get()->getResult();

        return $data;
    }

    public function getActiveAndPublicServices()
    {
        $query = $this->db->table('service')
            ->where('status', 1)
            ->where('visibility', 1)
            ->orderBy('ordering');

        $data = $query->get()->getResult();

        return $data;
    } // ok

    public function getActiveEmployees()
    {
        $query = $this->db->table('employee')
            ->where('status', 1)
            ->where('deleted', 0);

        $data = $query->get()->getResult();

        return $data;
    } // ok

    public function getActiveSocialNetworks()
    {
        $query = $this->db->table('company_social_network')
            ->where('status', 1);

        $data = $query->get()->getResult();

        return $data;
    } // ok
}
