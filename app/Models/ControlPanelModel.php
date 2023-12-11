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

    # Customer DT
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

        if ($column == 0) {
            if ($dir == 'asc')
                $sort = 'name ASC';
            else
                $sort = 'name DESC';
        }

        if ($column == 1) {
            if ($dir == 'asc')
                $sort = 'lastName ASC';
            else
                $sort = 'lastName DESC';
        }

        if ($column == 2) {
            if ($dir == 'asc')
                $sort = 'email ASC';
            else
                $sort = 'email DESC';
        }

        if ($column == 3) {
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
    # End Customer DT

    # Employee DT
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
    # End Employee DT

    # Service DT
    public function getserviceProcessingData($params)
    {
        $query = $this->db->table('service');

        if (!empty($params['search'])) {
            $query->groupStart();
            $query->like('title', $params['search']);
            $query->orLike('price', $params['search']);
            $query->orLike('time', $params['search']);
            $query->groupEnd();
        }

        $query->offset($params['start']);
        $query->limit($params['length']);
        $query->orderBy($this->getServiceProcessingSort($params['sortColumn'], $params['sortDir']));

        return $query->get()->getResult();
    } // ok

    public function getServiceProcessingSort($column, $dir)
    {
        $sort = '';

        if ($column == 0) {
            if ($dir == 'asc')
                $sort = 'title ASC';
            else
                $sort = 'title DESC';
        }

        if ($column == 1) {
            if ($dir == 'asc')
                $sort = 'price ASC';
            else
                $sort = 'price DESC';
        }

        if ($column == 2) {
            if ($dir == 'asc')
                $sort = 'time ASC';
            else
                $sort = 'time DESC';
        }

        if ($column == 4) {
            if ($dir == 'asc')
                $sort = 'status ASC';
            else
                $sort = 'status DESC';
        }

        return $sort;
    } // ok

    public function getTotalService()
    {
        $query = $this->db->table('employee')
            ->selectCount('id')
            ->get()->getResult();

        return $query[0]->id;
    } // ok
    # End Service DT

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
        ->where('status', 1);
        $data = $query->get()->getResult();
        return $data;
    } // ok

    public function getActiveEmployees()
    {
        $query = $this->db->table('employee')
        ->where('status', 1);

        $data = $query->get()->getResult();

        return $data;
    } // ok
}
