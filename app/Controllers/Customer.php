<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\MainModel;
use App\Models\CustomerModel;
use App\Models\DataTableModel;

class Customer extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objConfigModel;
    protected $objCustomerModel;
    protected $objMainModel;
    protected $objDataTableModel;
    protected $config;
    protected $profile;
    protected $objEmail;

    public function __construct()
    {
        # Session
        $this->objSession = session();

        # Models
        $this->objConfigModel = new ConfigModel;
        $this->objCustomerModel = new CustomerModel;
        $this->objMainModel = new MainModel;
        $this->objDataTableModel = new DataTableModel;

        # Config
        $this->config = $this->objConfigModel->getConfig(1);
        $this->profile = $this->objCustomerModel->getCompanyProfileSettings();

        # Email Settings
        $emailConfig = array();
        $emailConfig['protocol'] = EMAIL_PROTOCOL;
        $emailConfig['SMTPHost'] = EMAIL_SMTP_HOST;
        $emailConfig['SMTPUser'] = EMAIL_SMTP_USER;
        $emailConfig['SMTPPass'] = EMAIL_SMTP_PASSWORD;
        $emailConfig['SMTPPort'] = EMAIL_SMTP_PORT;
        $emailConfig['SMTPCrypto'] = EMAIL_SMTP_CRYPTO;
        $emailConfig['mailType'] = EMAIL_MAIL_TYPE;

        # Services
        $this->objRequest = \Config\Services::request();
        $this->objEmail = \Config\Services::email($emailConfig);

        # Set Lang
        $this->objRequest->setLocale($this->config[0]->lang);

        # Set TimeZone
        date_default_timezone_set($this->config[0]->timezone);

        # Load Helpers
        helper('Site');
    }

    public function dashboard()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer")
            return view('customerLogout');

        if ($this->config[0]->lang == 'es')
            $dateLabel = "d-m-Y";
        else if ($this->config[0]->lang == 'en')
            $dateLabel = "m-d-Y";

        $customerID = $this->objSession->get('user')['customerID'];

        $data = array();
        # menu 
        $data['activeDashboard'] = "active";
        # config
        $data['config'] = $this->config;
        $data['companyProfile'] = $this->profile;
        # data
        $data['uniqid'] = uniqid();
        $data['dateLabel'] = $dateLabel;
        $data['customer'] = $this->objMainModel->objData('customer', 'id', $this->objSession->get('user')['customerID']);
        $data['upcomingAppointments'] = $this->objCustomerModel->upcomingAppointments($customerID);
        $data['col'] = "col-12 col-md-12 col-lg-6";
        # page
        $data['page'] = 'customer/dashboard/mainDashboard';

        return view('customer/mainCustomer', $data);
    }

    public function appointment()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer")
            return view('customerLogout');

        $customerID = $this->objSession->get('user')['customerID'];

        if ($this->config[0]->lang == 'es')
            $dateLabel = "d-m-Y";
        else if ($this->config[0]->lang == 'en')
            $dateLabel = "m-d-Y";

        $data = array();
        # menu 
        $data['activeAppointment'] = "active";
        # config
        $data['config'] = $this->config;
        $data['companyProfile'] = $this->profile;
        # data
        $data['uniqid'] = uniqid();
        $data['dateLabel'] = $dateLabel;
        $data['customer'] = $this->objMainModel->objData('customer', 'id', $customerID);
        $data['upcomingAppointments'] = $this->objCustomerModel->upcomingAppointments($customerID);
        # page
        $data['page'] = 'customer/appointment/mainAppointment';

        return view('customer/mainCustomer', $data);
    } // ok

    public function processingAppointment()
    {
        $dataTableRequest = $_REQUEST;

        $params = array();
        $params['draw'] = $dataTableRequest['draw'];
        $params['start'] = $dataTableRequest['start'];
        $params['length'] = $dataTableRequest['length'];
        $params['search'] = $dataTableRequest['search']['value'];
        $params['customerID'] = $this->objSession->get('user')['customerID'];

        $row = array();
        $totalRecords = 0;

        $result = $this->objDataTableModel->getAppointmentProcessingData($params);
        $totalRows = sizeof($result);

        for ($i = 0; $i < $totalRows; $i++) {

            $empAvatar = '<div class="symbol symbol-30px symbol-circle me-3"><img src="' . imgEmployee($result[$i]->employeeID) . '" class="" alt=""></div>';

            $date = "";
            if ($this->config[0]->lang == 'en')
                $date = date('F j, Y', strtotime($result[$i]->date));
            else {
                $mont =  date('F', strtotime($result[$i]->date));
                $date = lang('Text.' . $mont) . ' ' . date('j, Y', strtotime($result[$i]->date));
            }

            $schedule = '<span class="text-gray-800 fs-7 fw-bold"><i class="bi bi-clock-history fs-7"></i> '. date('g:ia', strtotime($result[$i]->start)) .' - ' .date('g:ia', strtotime($result[$i]->end)) . '</span>';
            $aux = json_decode($result[$i]->servicesJSON);
            $serv = "";
            
            foreach ($aux as $s) {
                $serv = $serv. '<div class="fw-semibold"><span class="bullet bullet-dot bg-primary me-2 h-10px w-10px"></span>'. $s->serviceTitle. '</div>';
            }
           
            $col = array();
            $col['emp'] = $empAvatar . ' ' . $result[$i]->employeeName . ' ' . $result[$i]->employeeLastName;
            $col['date'] = $date;
            $col['schedule'] = $schedule;
            $col['serv'] = $serv;
            $col['time'] = $result[$i]->totalTime . ' ' . lang('Text.minutes');
            $col['price'] = getMoneyFormat($this->config[0]->currency, $result[$i]->totalPrice);
            $row[$i] =  $col;
        }

        if ($totalRows > 0) {
            if (empty($params['search']))
                //$totalRecords = $this->objControlPanelModel->getTotalCustomers();
                //else
                $totalRecords = $totalRows;
        }

        $data = array();
        $data['draw'] = $dataTableRequest['draw'];
        $data['recordsTotal'] = intval($totalRecords);
        $data['recordsFiltered'] = intval($totalRecords);
        $data['data'] = $row;

        return json_encode($data);
    }

    public function profile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer")
            return view('customerLogout');

        if ($this->config[0]->lang == 'es')
            $dateLabel = "d-m-Y";
        else if ($this->config[0]->lang == 'en')
            $dateLabel = "m-d-Y";

        # params
        $tab = $this->objRequest->getPostGet('tab');

        if (empty($tab))
            $tab = "profile";

        $data = array();
        # menu 
        $data['activeProfile'] = "active";
        # config
        $data['config'] = $this->config;
        $data['companyProfile'] = $this->profile;
        # data
        $data['uniqid'] = uniqid();
        $data['dateLabel'] = $dateLabel;
        $data['tab'] = $tab;
        # page
        $data['page'] = 'customer/profile/mainProfile';

        return view('customer/mainCustomer', $data);
    } // ok

    public function profileTab()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer")
            return view('customerLogout');

        $customerID = $this->objSession->get('user')['customerID'];

        # params
        $tab = $this->objRequest->getPost('tab');

        $data = array();
        $data['config'] = $this->config;
        $data['uniqid'] = uniqid();

        switch ($tab) {
            case 'profile':
                # page
                $view = 'customer/profile/tabContent/customerProfile';
                # data
                $data['customer'] = $this->objMainModel->objData('customer', 'id', $customerID);
                break;
            case 'account':
                # page
                $view = 'customer/profile/tabContent/customerAccount';
                $data['customer'] = $this->objMainModel->objData('customer', 'id', $customerID);
                break;
        }

        return view($view, $data);
    } // ok

    public function updateAccount()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        $customerID = $this->objSession->get('user')['customerID'];

        # params
        $email = strtolower(htmlspecialchars(trim($this->objRequest->getPost('email'))));
        $currentPassword = htmlspecialchars(trim($this->objRequest->getPost('currentPassword')));
        $newPassword = password_hash(htmlspecialchars(trim($this->objRequest->getPost('password'))), PASSWORD_DEFAULT);

        if (!empty($currentPassword)) {
            if ($this->objConfigModel->loginCustomer($currentPassword, $customerID)['error'] == 1) {
                $result = array();
                $result['error'] = 1;
                $result['msg'] = "INVALID_CURRENT_KEY";

                return json_encode($result);
            }
        }

        $dataAccount = array();

        if (!empty($this->objRequest->getPost('password')))
            $dataAccount['password'] = $newPassword;

        if ($this->objSession->get('user')['email'] != $email) {
            $dataAccount['email'] = $email;
            $dataAccount['token'] = md5(uniqid());
            $dataAccount['emailVerified'] = 0;
        }

        if (empty($dataAccount)) {
            $response = array();
            $response['error'] = 0;

            return json_encode($response);
        }

        $this->objMainModel->objUpdate('customer', $dataAccount, $customerID);

        if (!empty($dataAccount['email'])) {
            $customer = $this->objMainModel->objData('customer', 'id', $customerID);

            $dataEmail = array();
            $dataEmail['pageTitle'] = $this->profile[0]->companyName;
            $dataEmail['person'] = $customer[0]->name . ' ' . $customer[0]->lastName;
            $dataEmail['url'] = base_url('Home/verifiedEmail') . '?token=' . $dataAccount['token'] . '&type=customer';
            $dataEmail['companyPhone'] = $this->profile[0]->phone1;
            $dataEmail['companyEmail'] = $this->profile[0]->email;

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $this->profile[0]->companyName);
            $this->objEmail->setTo($dataAccount['email']);
            $this->objEmail->setSubject($this->profile[0]->companyName);
            $this->objEmail->setMessage(view('email/verifyNewEmail', $dataEmail), []);

            $this->objEmail->send(false);
        }

        $response = array();
        $response['error'] = 0;

        return json_encode($response);
    } // ok

    public function updateProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $customerID = $this->objSession->get('user')['customerID'];

        $data = array();
        $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $data['lastName'] = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $data['phone'] = htmlspecialchars(trim($this->objRequest->getPost('phone')));
        $data['gender'] = htmlspecialchars(trim($this->objRequest->getPost('gender')));
        $data['dob'] = date('Y-m-d', strtotime($this->objRequest->getPost('dob')));
        $data['address1'] = htmlspecialchars(trim($this->objRequest->getPost('address1')));
        $data['address2'] = htmlspecialchars(trim($this->objRequest->getPost('address2')));
        $data['city'] = htmlspecialchars(trim($this->objRequest->getPost('city')));
        $data['state'] = htmlspecialchars(trim($this->objRequest->getPost('state')));
        $data['zip'] = htmlspecialchars(trim($this->objRequest->getPost('zip')));
        $data['country'] = htmlspecialchars(trim($this->objRequest->getPost('country')));

        $result = $this->objMainModel->objUpdate('customer', $data, $customerID);

        return json_encode($result);
    } // ok

    public function uploadAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        $result = $this->objMainModel->uploadFile('customer', $this->objSession->get('user')['customerID'], 'avatar', $_FILES['file']);

        return json_encode($result);
    } // ok

    public function removeAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $customerID = $this->objSession->get('user')['customerID'];

        $data = array();
        $data['avatar'] = '';

        $result = $this->objMainModel->objUpdate('customer', $data, $customerID);

        return json_encode($result);
    } // ok

    public function createAppointment()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer")
            return view('customerLogout');

        if ($this->config[0]->lang == 'es')
            $dateLabel = "d-m-Y";
        else if ($this->config[0]->lang == 'en')
            $dateLabel = "m-d-Y";

        $currentDate = date('Y-m-d');
        $dateTime = new \DateTime($currentDate);
        $dateTime->modify('+2 months');
        $maxDate = $dateTime->format('Y-m-d');

        $data = array();
        # menu 
        $data['activeAppointment'] = "active";
        # config
        $data['config'] = $this->config;
        $data['companyProfile'] = $this->profile;
        # data
        $data['services'] = $this->objCustomerModel->getActiveAndPublicServices();
        $data['employees'] = $this->objCustomerModel->getActiveEmployees();
        $data['dateLabel'] = $dateLabel;
        $data['currentDate'] = $currentDate;
        $data['minDate'] = $currentDate;
        $data['maxDate'] = $maxDate;
        $data['uniqid'] = uniqid();
        # page
        $data['page'] = 'customer/appointment/mainCreateAppointment';

        return view('customer/mainCustomer', $data);
    } // ok

    public function employeesByServices()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer")
            return view('customerLogout');

        # params
        $services = $this->objRequest->getPost('services');
        $serviceCalc = $this->objCustomerModel->getServiceTimeAndPrice($services);

        $data = array();
        # data
        $data['employees'] = $this->objCustomerModel->getEmployeesByServices($services);
        $data['serviceTime'] = $serviceCalc['time'];
        $data['servicePrice'] = $serviceCalc['price'];
        # page
        $view = 'customer/appointment/employees';

        return view($view, $data);
    } // ok

    public function employeeAvailability()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer")
            return view('customerLogout');

        # params
        $employeeID = $this->objRequest->getPost('employeeID');
        $date = date('Y-m-d', strtotime($this->objRequest->getPost('date')));
        $serviceTime = $this->objRequest->getPost('serviceTime');

        if ($this->config[0]->lang == 'es')
            $dateLabel = "d-m-Y";
        else if ($this->config[0]->lang == 'en')
            $dateLabel = "m-d-Y";

        $currentDate = date("Y-m-d H:i:s");
        $currentTimestamp = strtotime($currentDate);

        $objDate = new \DateTime($date);
        $day = strtolower($objDate->format('l'));

        $empBussinesDay = $this->objMainModel->objData('employee_bussines_day', 'employeeID', $employeeID); // Employee Bussiness Day
        $empAppointment = $this->objCustomerModel->getEmployeeAppointmentDay($employeeID, $date); // Employee Appointment Date Selected

        $dayTimes = array();
        $rangeTimes = array();

        if ($empBussinesDay[0]->$day == 1) {
            $empTimes = $this->objMainModel->objData('employee_shift_day', 'employeeID', $employeeID); // Employee Times

            foreach ($empTimes as $time) {
                if ($time->day == $day) {
                    $dayTimes[] = $time;
                }
            }

            foreach ($dayTimes as $index => $t) {
                $start = new \DateTime($t->start);
                $end = new \DateTime($t->end);
                $end->sub(new \DateInterval('PT' . $serviceTime . 'M'));

                if ($index == 0)
                    $slotStartTimestamp = $start;

                while ($slotStartTimestamp <= $end) {

                    $slotStart = $slotStartTimestamp->format('g:ia');
                    $slotStartTimestamp->add(new \DateInterval('PT' . $serviceTime . 'M')); // Iterator
                    $slotEnd = $slotStartTimestamp->format('g:ia');

                    $auxDate = date("Y-m-d H:i:s", strtotime($date . ' ' . $slotStart));
                    $auxTimestamp = strtotime($auxDate);

                    if ($auxTimestamp > $currentTimestamp) {
                        $flag = 0;

                        foreach ($empAppointment as $ea) {
                            $eaS = strtotime($ea->start);
                            $eaE = strtotime($ea->end);

                            $sT = strtotime($slotStart);
                            $eT = strtotime($slotEnd);

                            if ($eaS >= $sT && $eaE <= $eT) {
                                $flag = 1;
                                $aptTime = ($eaE - $eaS) / 60;
                                $slotStartTimestamp->sub(new \DateInterval('PT' . $serviceTime . 'M')); // Back To Previous Slot
                                $slotStartTimestamp->add(new \DateInterval('PT' . $aptTime . 'M')); // Add Appointment Time 
                                break;
                            }
                        }

                        if ($flag == 0) {
                            $rangeTimes[] = $slotStart . ' - ' . $slotEnd;
                        }
                    }
                }
            }
        }

        $data = array();
        $data['availability'] = $rangeTimes;
        $data['dateReview'] = date($dateLabel, strtotime($date));

        # page
        $view = 'customer/appointment/availability';

        return view($view, $data);
    } // ok

    public function saveAppointment()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $date = date('Y-m-d', strtotime($this->objRequest->getPost('date')));
        $time = $this->objRequest->getPost('time');
        $employeeID = $this->objRequest->getPost('employeeID');
        $services = $this->objRequest->getPost('services');
        $empAppointment = $this->objCustomerModel->getEmployeeAppointmentDay($employeeID, $date);

        $aux = explode(" - ", $time);
        $s = $aux[0];
        $e = $aux[1];

        $flag = 0;
        foreach ($empAppointment as $ea) {
            $eaS = new \DateTime($ea->start);
            $eaE = new \DateTime($ea->end);

            $sT = new \DateTime($s);
            $eT = new \DateTime($e);

            if ($eaS >= $sT &&  $eaE <= $eT) {
                $flag = 1;
                break;
            }
        }

        if ($flag == 0) {
            $data = array();
            $data['customerID'] = $this->objSession->get('user')['customerID'];
            $data['employeeID'] = $employeeID;
            $data['date'] = $date;
            $data['start'] = date('H:i:s', strtotime($s));
            $data['end'] = date('H:i:s', strtotime($e));
            $data['services'] = json_encode($services);

            $result = $this->objMainModel->objCreate('appointment', $data);
        } else {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = lang('Text.cust_error_create_appointment');
        }

        return json_encode($result);
    } // ok

    public function cancelAppointment()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $appointmentID = $this->objRequest->getPost('appointmentID');

        $result = $this->objMainModel->objDelete('appointment', $appointmentID);

        return json_encode($result);
    } // ok

    public function resendVerifyEmail()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "customer") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        $token = md5(uniqid());
        $customerID = $this->objSession->get('user')['customerID'];

        # Get Customer
        $customer = $this->objMainModel->objData('customer', 'id', $customerID);

        # Set Customer Token
        $result = $this->objMainModel->objUpdate('customer', array('token' => $token), $customerID);

        $dataEmail = array();
        $dataEmail['pageTitle'] = $this->profile[0]->companyName;
        $dataEmail['person'] = $customer[0]->name . ' ' . $customer[0]->lastName;
        $dataEmail['url'] = base_url('Home/verifiedEmail') . '?token=' . $token . '&type=customer';
        $dataEmail['companyPhone'] = $this->profile[0]->phone1;
        $dataEmail['companyEmail'] = $this->profile[0]->email;

        $this->objEmail->setFrom(EMAIL_SMTP_USER, $this->profile[0]->companyName);
        $this->objEmail->setTo($customer[0]->email);
        $this->objEmail->setSubject($this->profile[0]->companyName);
        $this->objEmail->setMessage(view('email/verifyNewEmail', $dataEmail), []);

        if ($this->objEmail->send(false)) {
            $response['error'] = 0;
            $response['msg'] = lang('Text.emp_success_resend_verify_email');
        } else {
            $response['error'] = 1;
            $response['msg'] = 'ERROR_SEND_EMAIL';
        }

        return json_encode($response);
    } // ok
}
