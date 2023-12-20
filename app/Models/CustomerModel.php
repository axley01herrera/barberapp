<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
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
        ->select('companyID, avatar, companyName, companyType, email, phone1, address1, address2, city, state, zip, country')
        ->where('id', 1);

        $data = $query->get()->getResult();

        return $data;
    } // ok

    public function getEmployeesByServices($services)
    {
        $data = array();

        if (!empty($services)) {
            $query = $this->db->table('employee_service es');
            $query->select('
                e.id AS employeeID,
                e.avatar AS avatar,
                e.name AS name,
                e.lastName AS lastName
            ');
            $query->whereIn('serviceID', $services);
            $query->join('employee e', 'e.id = es.employeeID');
            $query->join('service s', 's.id = es.serviceID');

            $subquery = $this->db->table('employee_service es2');
            $subquery->select('es2.employeeID')
                ->whereIn('es2.serviceID', $services)
                ->groupBy('es2.employeeID')
                ->having('COUNT(DISTINCT es2.serviceID)', count($services), false);

            $query->whereIn('es.employeeID', $subquery);
            $query->groupBy('es.employeeID');

            $data = $query->get()->getResult();
        }

        return $data;
    } // ok

    public function getServiceTimeAndPrice($services)
    {
        $return = array();
        $return['time'] = 0;
        $return['price'] = 0;

        if (!empty($services)) {
            $query = $this->db->table('service')
                ->select('time, price')
                ->whereIn('id', $services);

            $data = $query->get()->getResult();

            $time = 0;
            $price = 0;

            foreach ($data as $d) {
                $time = $time + $d->time;
                $price = $price + $d->price;
            }

            $return = array();
            $return['time'] = $time;
            $return['price'] = $price;
        }

        return $return;
    } // ok

    public function getEmployeeAppointmentDay($empID, $date)
    {
        $query = $this->db->table('appointment')
        ->where('employeeID', $empID)
        ->where('date', $date);

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

    public function getActiveAndPublicServices()
    {
        $query = $this->db->table('service')
            ->where('status', 1)
            ->where('visibility', 1)
            ->orderBy('ordering');

        $data = $query->get()->getResult();

        return $data;
    } // ok
}