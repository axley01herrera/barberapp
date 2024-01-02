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
    #### Customer DT
    ####################

    public function getCustomersProcessingData($params)
    {
        $query = $this->db->table('customer');

        if (!empty($params['search'])) {
            $query->groupStart();
            $query->like('name', $params['search']);
            $query->orLike('lastName', $params['search']);
            $query->orLike('email', $params['search']);
            $query->groupEnd();
        }

        $query->groupStart();
        $query->where('deleted', 0);
        $query->groupEnd();

        $query->offset($params['start']);
        $query->limit($params['length']);
        $query->orderBy($this->getCustomerProcessingSort($params['sortColumn'], $params['sortDir']));

        return $query->get()->getResult();
    } // ok

    public function getCustomerProcessingSort($column, $dir)
    {
        $sort = '';

        if ($column == 1) {
            if ($dir == 'asc')
                $sort = 'name ASC';
            else
                $sort = 'name DESC';
        }

        if ($column == 2) {
            if ($dir == 'asc')
                $sort = 'lastName ASC';
            else
                $sort = 'lastName DESC';
        }

        if ($column == 3) {
            if ($dir == 'asc')
                $sort = 'email ASC';
            else
                $sort = 'email DESC';
        }

        if ($column == 4) {
            if ($dir == 'asc')
                $sort = 'status ASC';
            else
                $sort = 'status DESC';
        }

        return $sort;
    } // ok

    public function getTotalCustomers()
    {
        $query = $this->db->table('customer')
            ->selectCount('id')
            ->get()->getResult();

        return $query[0]->id;
    } // ok

    ####################
    #### End Customer DT
    ####################

    ####################
    #### Employee DT
    ####################

    public function getEmployeesProcessingData($params)
    {
        $query = $this->db->table('employee');

        if (!empty($params['search'])) {
            $query->groupStart();
            $query->like('name', $params['search']);
            $query->orLike('lastName', $params['search']);
            $query->orLike('email', $params['search']);
            $query->groupEnd();
        }

        $query->groupStart();
        $query->where('deleted', 0);
        $query->groupEnd();

        $query->offset($params['start']);
        $query->limit($params['length']);
        $query->orderBy($this->getEmployeeProcessingSort($params['sortColumn'], $params['sortDir']));

        return $query->get()->getResult();
    } // ok

    public function getEmployeeProcessingSort($column, $dir)
    {
        $sort = '';

        if ($column == 1) {
            if ($dir == 'asc')
                $sort = 'name ASC';
            else
                $sort = 'name DESC';
        }

        if ($column == 2) {
            if ($dir == 'asc')
                $sort = 'lastName ASC';
            else
                $sort = 'lastName DESC';
        }

        if ($column == 3) {
            if ($dir == 'asc')
                $sort = 'email ASC';
            else
                $sort = 'email DESC';
        }

        if ($column == 4) {
            if ($dir == 'asc')
                $sort = 'status ASC';
            else
                $sort = 'status DESC';
        }

        return $sort;
    } // ok

    public function getTotalEmployees()
    {
        $query = $this->db->table('employee')
            ->selectCount('id')
            ->get()->getResult();

        return $query[0]->id;
    } // ok

    ####################
    #### End Employee DT
    ####################

    ####################
    #### DT Customer Appointments
    ####################

    public function getCustomerAppointmentProcessingData($params)
    {
        $query = $this->db->table('view_appointment');

        if (!empty($params['search'])) {
            $query->groupStart();
            $query->like('employeeName', $params['search']);
            $query->orLike('employeeLastName', $params['search']);
            $query->orLike('totalTime', $params['search']);
            $query->orLike('totalPrice', $params['search']);
            $query->orLike('date', $params['search']);
            $query->orLike('servicesJSON', $params['search']);
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
    } // ok

    public function getTotalCustomerAppointments($params)
    {
        $query = $this->db->table('view_appointment')
            ->select('appointmentID');

        $query->groupStart();
        $query->where('customerID', $params['customerID']);
        $query->groupEnd();

        $data = $query->get()->getResult();

        return sizeof($data);
    } // ok

    ####################
    #### End DT Customer Appointments
    ####################

    ####################
    #### DT Today Appointments
    ####################

    public function todayAppointments () {
        $query = $this->db->table('view_appointment')
        ->where('date', date('Y-m-d'));

        $data = $query->get()->getResult();

        return $data;
    }
    
    ####################
    #### DT Today Appointments
    ####################
}
