<?php

namespace App\Models;

use CodeIgniter\Model;

class ControlPanelModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getCompanyProfile($id)
    {
        $query = $this->db->table('company_profile')
            ->where('id', $id);

        return $query->get()->getResult();
    } // ok

    public function removeEmployeeService($employeeID, $serviceID)
    {
        $query = $this->db->table('employee_service')
            ->where('employeeID', $employeeID)
            ->where('serviceID', $serviceID)
            ->delete();

        if ($query == true) {
            $return['error'] = 0;
            $return['msg'] = 'success';
        } else {
            $return['error'] = 1;
            $return['msg'] = 'error on delete record';
        }

        return $return;
    } // ok

    public function getActiveServices()
    {
        $query = $this->db->table('service')
            ->where('status', 1)
            ->orderBy('ordering');

        $data = $query->get()->getResult();

        return $data;
    } // ok

    public function getServices()
    {
        $query = $this->db->table('service')
            ->orderBy('ordering');

        $data = $query->get()->getResult();

        return $data;
    } // ok

    public function uploadBusinessImages($file)
    {
        $fileContent = file_get_contents($file['tmp_name']);

        $data = array(
            'img' => $fileContent
        );

        $this->db->table('company_img')
            ->insert($data);

        if ($this->db->resultID !== null) {
            $result = array();
            $result['error'] = 0;
            $result['id'] = $this->db->connID->insert_id;
        } else {
            $result = array();
            $result['error'] = 1;
        }

        return $result;
    } // ok

    public function dashCardActiveEmp()
    {
        $query = $this->db->table('employee')
            ->select('id')
            ->where('status', 1)
            ->where('deleted', 0);

        $data = $query->get()->getResult();

        return $data;
    } // ok

    public function dashCardActiveCust()
    {
        $query = $this->db->table('customer')
            ->select('id')
            ->where('status', 1)
            ->where('deleted', 0);

        $data = $query->get()->getResult();

        return $data;
    } // ok

    public function dashCardActiveServ()
    {
        $query = $this->db->table('service')
            ->select('id')
            ->where('status', 1);

        $data = $query->get()->getResult();

        return $data;
    } // ok


    public function getEmployeeShiftDay($employeeID) {

        $query = $this->db->table('employee_shift_day')
        ->where('employeeID', $employeeID)
        ->orderBy('start', 'ASC');

        $data = $query->get()->getResult();

        return $data;
    }
}
