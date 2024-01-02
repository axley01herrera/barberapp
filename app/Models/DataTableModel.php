<?php

namespace App\Models;

use CodeIgniter\Model;

class DataTableModel extends Model
{
    protected $db;

    function  __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    ####################
    #### DT Appointments
    ####################

    public function getAppointmentProcessingData($params)
    {
        $query = $this->db->table('view_appointment');

        if (!empty($params['search'])) {
            $query->groupStart();
            $query->like('employeeName', $params['search']);
            $query->orLike('employeeLastName', $params['search']);
            $query->orLike('customerName', $params['search']);
            $query->orLike('customerLastName', $params['search']);
            $query->orLike('totalTime', $params['search']);
            $query->orLike('totalPrice', $params['search']);
            $query->orLike('date', $params['search']);
            $query->groupEnd();
        }

        if (!empty($params['customerID'])) {
            $query->groupStart();
            $query->where('customerID', $params['customerID']);
            $query->groupEnd();
        }

        $query->offset($params['start']);
        $query->limit($params['length']);
        $query->orderBy('date DESC');

        return $query->get()->getResult();
    }

    ####################
    #### End DT Appointments
    ####################
}
