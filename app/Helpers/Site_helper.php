<?php
function getMoneyFormat($currency, $value)
{
    return $currency . number_format($value, 2, ".", ',');
}

function socialNetworkIcon($type)
{
    $icon = "";
    switch ($type) {

        case 'Google':
            $icon = '<img src="' . base_url('public/assets/media/svg/brand-logos/google-icon.svg') . '" class="w-30px me-6" alt="logo">';
            break;

        case 'Facebook':
            $icon = '<img src="' . base_url('public/assets/media/svg/brand-logos/facebook-4.svg') . '" class="w-30px me-6" alt="logo">';
            break;

        case 'Twitter':
            $icon = '<img src="' . base_url('public/assets/media/svg/brand-logos/twitter.svg') . '" class="w-30px me-6" alt="logo">';
            break;

        case 'LinkedIn':
            $icon = '<img src="' . base_url('public/assets/media/svg/brand-logos/linkedin-1.svg') . '" class="w-30px me-6" alt="logo">';
            break;

        case 'Instagram':
            $icon = '<img src="' . base_url('public/assets/media/svg/brand-logos/instagram-2-1.svg') . '" class="w-30px me-6" alt="logo">';
            break;
    }

    return $icon;
}

function labelEmployeeName($employeeID)
{
    $db = \Config\Database::connect();

    $query = $db->table('employee')
        ->select('name')
        ->where('id', $employeeID);

    $data = $query->get()->getResult();

    return $data[0]->name;
}

function labelCustomerName($customerID)
{
    $db = \Config\Database::connect();

    $query = $db->table('customer')
        ->select('name')
        ->where('id', $customerID);

    $data = $query->get()->getResult();

    return $data[0]->name;
}

function imgEmployee($employeeID)
{
    $db = \Config\Database::connect();

    $query = $db->table('employee')
        ->select('avatar')
        ->where('id', $employeeID);

    $data = $query->get()->getResult();

    if (empty($data[0]->avatar))
        return base_url('public/assets/media/avatars/blank.png');
    else
        return "data:image/png;base64," . base64_encode($data[0]->avatar);
}

function imgCustomer($employeeID)
{
    $db = \Config\Database::connect();

    $query = $db->table('customer')
        ->select('avatar')
        ->where('id', $employeeID);

    $data = $query->get()->getResult();

    if (empty($data[0]->avatar))
        return base_url('public/assets/media/avatars/blank.png');
    else
        return "data:image/png;base64," . base64_encode($data[0]->avatar);
}

function labelService($serviceID)
{
    $db = \Config\Database::connect();

    $query = $db->table('service')
        ->select('title, price')
        ->where('id', $serviceID);

    $data = $query->get()->getResult();

    return $data;
}
