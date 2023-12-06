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

    public function getProfile($id)
    {
        $query = $this->db->table('profile')
            ->where('id', $id);

        return $query->get()->getResult();
    }

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
    }

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
    }

    public function getTotalCustomers()
    {
        $query = $this->db->table('customer')
            ->selectCount('id')
            ->get()->getResult();

        return $query[0]->id;
    }
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
    }

    public function getEmployeeProcessingSort($column, $dir)
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

        if ($column == 4) {
            if ($dir == 'asc')
                $sort = 'status ASC';
            else
                $sort = 'status DESC';
        }

        return $sort;
    }

    public function getTotalEmployees()
    {
        $query = $this->db->table('employee')
            ->selectCount('id')
            ->get()->getResult();

        return $query[0]->id;
    }
    # End Employee DT
}
