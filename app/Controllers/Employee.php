<?php

namespace App\Controllers;

use App\Models\ConfigModel;
use App\Models\MainModel;
use App\Models\ControlPanelModel;
use App\Models\DataTableModel;

class Employee extends BaseController
{
    protected $objSession;
    protected $objRequest;
    protected $objConfigModel;
    protected $objControlPanelModel;
    protected $objDataTableModel;
    protected $objMainModel;
    protected $config;
    protected $profile;
    protected $objEmail;
    protected $companyProfile;

    public function __construct()
    {
        # Session
        $this->objSession = session();

        # Models
        $this->objConfigModel = new ConfigModel;
        $this->objControlPanelModel = new ControlPanelModel;
        $this->objMainModel = new MainModel;
        $this->objDataTableModel = new DataTableModel;

        # Config
        $this->config = $this->objConfigModel->getConfig(1);
        $this->companyProfile = $this->objControlPanelModel->getCompanyProfile(1);

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
    }

    public function index()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee")
            return view('employeeLogout');

        # params
        $employeeID =  $this->objSession->get('user')['employeeID'];

        # data
        $data = array();
        $data['uniqid'] = uniqid();
        $data['config'] = $this->config;
        $data['companyProfile'] = $this->companyProfile;
        $data['employee'] = $this->objMainModel->objData('employee', 'id', $this->objSession->get('user')['employeeID']);
        $data['upcomingAppointments'] = $this->objMainModel->employeeUpcomingAppointments($employeeID);
        # page
        $data['page'] = 'employee/main';

        return view('employee/mainEmployee', $data);
    }

    public function updateEmployee()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $name = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $lastName = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $email = strtolower(htmlspecialchars(trim($this->objRequest->getPost('email'))));
        $employeeID =  $this->objSession->get('user')['employeeID'];

        $checkDuplicate = $this->objMainModel->objCheckDuplicate('employee', 'email', $email, $employeeID);

        if (empty($checkDuplicate)) {
            $data = array();
            $data['name'] = $name;
            $data['lastName'] = $lastName;
            $data['email'] = $email;
            $data['token'] = md5(uniqid());

            $result = $this->objMainModel->objUpdate('employee', $data, $employeeID);
            return json_encode($result);
        } else {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "ERROR_DUPLICATE_EMAIL";

            return json_encode($result);
        }
    }

    public function deleteEmployee()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $employeeID =  $this->objSession->get('user')['employeeID'];

        $data = array();
        $data['status'] = 0;
        $data['deleted'] = 1;

        $result = $this->objMainModel->objUpdate('employee', $data, $employeeID);

        return json_encode($result);
    }

    public function changeEmployeeStatus()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $employeeID =  $this->objSession->get('user')['employeeID'];

        $data = array();
        $data['status'] = htmlspecialchars(trim($this->objRequest->getPost('status')));

        $result = $this->objMainModel->objUpdate('employee', $data, $employeeID);

        return json_encode($result);
    }

    public function employeeProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee")
            return view('employeeLogout');

        $data = array();
        # config
        $data['companyProfile'] = $this->companyProfile;
        $data['config'] = $this->config;
        # menu
        $data['activeEmployees'] = "active";
        # data
        $data['employee'] = $this->objMainModel->objData('employee', 'id', $this->objRequest->getPostGet('id'));
        # page
        $data['page'] = 'employee/main';

        return view('employee/mainEmployee', $data);
    }

    public function employeeProfileTabContent()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee")
            return view('employeeLogout');

        # params
        $employeeID =  $this->objSession->get('user')['employeeID'];
        $tab = $this->objRequest->getPost('tab');

        $view = "";

        $data = array();
        # config
        $data['config'] = $this->config;
        # data
        $data['employeeID'] = $employeeID;
        $data['uniqid'] = uniqid();

        if ($this->config[0]->lang == 'es')
            $data['dateLabel'] = "d-m-Y";
        else if ($this->config[0]->lang == 'en')
            $data['dateLabel'] = "m-d-Y";

        switch ($tab) {
            case 'tab-overview':
                $data['employee'] = $this->objMainModel->objData('employee', 'id', $employeeID);
                $data['employeeServices'] = $this->objMainModel->objData('employee_service', 'employeeID', $employeeID);
                $data['employeeBussinesDay'] = $this->objMainModel->objData('employee_bussines_day', 'employeeID', $employeeID);
                $data['employeeTimes'] = $this->objMainModel->objData('employee_shift_day', 'employeeID', $employeeID);
                # page
                $view = "employee/tabContent/tabOverview";
                break;
            case 'tab-services':
                $data['services'] = $this->objControlPanelModel->getActiveServices();
                $data['employeeServices'] = $this->objMainModel->objData('employee_service', 'employeeID', $employeeID);
                # page
                $view = "employee/tabContent/tabService";
                break;
            case 'tab-schedule':
                $data['employeeBussinesDay'] = $this->objMainModel->objData('employee_bussines_day', 'employeeID', $employeeID);
                if (empty($data['employeeBussinesDay'])) {
                    $this->objMainModel->objCreate('employee_bussines_day', ['employeeID' => $employeeID]);
                    $data['employeeBussinesDay'] = $this->objMainModel->objData('employee_bussines_day', 'employeeID', $employeeID);
                }
                $data['employeeTimes'] = $this->objMainModel->objData('employee_shift_day', 'employeeID', $employeeID);
                $view = "employee/tabContent/tabSchedule";
                break;
            case 'tab-account':
                $data['employee'] = $this->objMainModel->objData('employee', 'id', $employeeID);
                $view = "employee/tabContent/tabAccount";
                break;
            case 'tab-profile':
                $data['employee'] = $this->objMainModel->objData('employee', 'id', $employeeID);
                $view = "employee/tabContent/tabProfile";
                break;
        }

        return view($view, $data);
    }

    public function modalTime()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee")
            return view('employeeLogout');

        # params
        $action = $this->objRequest->getPost('action');
        $employeeID =  $this->objSession->get('user')['employeeID'];
        $timeID = $this->objRequest->getPost('timeID');

        $data = array();
        # config
        $data['action'] = $action;
        # data
        $data['employeeID'] = $employeeID;
        $data['timeID'] = $timeID;
        $data['uniqid'] = uniqid();
        $data['employeeBussinesDay'] = $this->objMainModel->objData('employee_bussines_day', 'employeeID', $data['employeeID']);

        if ($action == 'create')
            $data['modalTitle'] = lang('Text.emp_modal_title_create_time');
        else if ($action == 'update') {
            $data['modalTitle'] = lang('Text.emp_modal_title_edit_time');
            $data['time'] = $this->objMainModel->objData('employee_shift_day', 'id', $timeID);
        }
        # page
        $page = 'employee/modalTime';

        return view($page, $data);
    }

    public function createTime()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $employeeID =  $this->objSession->get('user')['employeeID'];
        $day = $this->objRequest->getPost('day');
        $startPost = $this->objRequest->getPost('startTime');
        $endPost = $this->objRequest->getPost('endTime');

        # Set time sql format
        $tiempoUnixS = strtotime($startPost);
        $tiempoUnixE = strtotime($endPost);
        $timeSqlS = date('H:i:s', $tiempoUnixS);
        $timeSqlE = date('H:i:s', $tiempoUnixE);

        $data = array();
        $data['employeeID'] = $employeeID;
        $data['day'] = $day;
        $data['start'] = $timeSqlS;
        $data['end'] = $timeSqlE;

        $result = $this->objMainModel->objCreate('employee_shift_day', $data);

        return json_encode($result);
    }

    public function updateTime()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $day = $this->objRequest->getPost('day');
        $startPost = $this->objRequest->getPost('startTime');
        $endPost = $this->objRequest->getPost('endTime');
        $timeID = $this->objRequest->getPost('timeID');

        # Set time sql format
        $tiempoUnixS = strtotime($startPost);
        $tiempoUnixE = strtotime($endPost);
        $timeSqlS = date('H:i:s', $tiempoUnixS);
        $timeSqlE = date('H:i:s', $tiempoUnixE);

        $data = array();
        $data['day'] = $day;
        $data['start'] = $timeSqlS;
        $data['end'] = $timeSqlE;

        $result = $this->objMainModel->objUpdate('employee_shift_day', $data, $timeID);

        return json_encode($result);
    }

    public function deleteTime()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        return json_encode($this->objMainModel->objDelete('employee_shift_day', array('id' => $this->objRequest->getPost('timeID'))));
    }

    public function reloadEmployeeInfo()
    {
        # params
        $employeeID =  $this->objSession->get('user')['employeeID'];
        # data
        $data = array();
        $data['employee'] = $this->objMainModel->objData('employee', 'id', $employeeID);
        # page
        $page = 'employee/employeeProfileInfo';
        return view($page, $data);
    }

    public function updateEmployeeAccount()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # params
        $email = strtolower(htmlspecialchars(trim($this->objRequest->getPost('email'))));
        $currentPassword = htmlspecialchars(trim($this->objRequest->getPost('currentPassword')));
        $newPassword = password_hash(htmlspecialchars(trim($this->objRequest->getPost('password'))), PASSWORD_DEFAULT);

        $employeeID =  $this->objSession->get('user')['employeeID'];

        $employee = $this->objMainModel->objData('employee', 'id', $employeeID);

        if (!empty($currentPassword)) {
            if ($this->objConfigModel->loginEmployee($currentPassword, $employeeID)['error'] == 1) {
                $result = array();
                $result['error'] = 1;
                $result['msg'] = "INVALID_CURRENT_KEY";
                return json_encode($result);
            }
        }

        $dataAccount = array();
        if (!empty($this->objRequest->getPost('password')))
            $dataAccount['password'] = $newPassword;

        if ($employee[0]->email !== $email) {
            $dataAccount['email'] = $email;
            $dataAccount['token'] = md5(uniqid());
            $dataAccount['emailVerified'] = 0;
        }

        if (empty($dataAccount)) {
            $response = array();
            $response['error'] = 0;
            return json_encode($response);
        }

        $this->objMainModel->objUpdate('employee', $dataAccount, $employeeID);

        if (!empty($dataAccount['email'])) {
            $dataEmail = array();
            $dataEmail['pageTitle'] = $this->companyProfile[0]->companyName;
            $dataEmail['person'] = $employee[0]->name . ' ' . $employee[0]->lastName;
            $dataEmail['url'] = base_url('Home/verifiedEmail') . '?token=' . $dataAccount['token'] . '&type=employee';
            $dataEmail['companyPhone'] = $this->companyProfile[0]->phone1;
            $dataEmail['companyEmail'] = $this->companyProfile[0]->email;

            $this->objEmail->setFrom(EMAIL_SMTP_USER, $this->companyProfile[0]->companyName);
            $this->objEmail->setTo($dataAccount['email']);
            $this->objEmail->setSubject($this->companyProfile[0]->companyName);
            $this->objEmail->setMessage(view('email/verifyNewEmail', $dataEmail), []);

            $this->objEmail->send(false);
        }

        $response = array();
        $response['error'] = 0;

        return json_encode($response);
    }

    public function updateEmployeeProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";

            return json_encode($result);
        }

        # employeeID
        $employeeID =  $this->objSession->get('user')['employeeID'];

        $data = array();
        # Profile
        $data['name'] = htmlspecialchars(trim($this->objRequest->getPost('name')));
        $data['lastName'] = htmlspecialchars(trim($this->objRequest->getPost('lastName')));
        $data['gender'] = htmlspecialchars(trim($this->objRequest->getPost('gender')));
        $data['phone'] = htmlspecialchars(trim($this->objRequest->getPost('phone')));
        $data['dob'] = date('Y-m-d', strtotime($this->objRequest->getPost('dob')));
        $data['address1'] = htmlspecialchars(trim($this->objRequest->getPost('address1')));
        $data['address2'] = htmlspecialchars(trim($this->objRequest->getPost('address2')));
        $data['city'] = htmlspecialchars(trim($this->objRequest->getPost('city')));
        $data['state'] = htmlspecialchars(trim($this->objRequest->getPost('state')));
        $data['zip'] = htmlspecialchars(trim($this->objRequest->getPost('zip')));
        $data['country'] = htmlspecialchars(trim($this->objRequest->getPost('country')));

        $result = $this->objMainModel->objUpdate('employee', $data, $employeeID);

        return json_encode($result);
    }

    public function uploadEmployeeAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        return json_encode($this->objMainModel->uploadFile('employee',  $this->objSession->get('user')['employeeID'], 'avatar', $_FILES['file']));
    }

    public function removeEmployeeAvatarProfile()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee") {
            $result = array();
            $result['error'] = 2;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        $data = array();
        $data['avatar'] = '';

        return json_encode($this->objMainModel->objUpdate('employee', $data, $this->objSession->get('user')['employeeID']));
    }

    public function employeeService()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }

        # params
        $checked = $this->objRequest->getPost('checked');
        $serviceID = $this->objRequest->getPost('serviceID');
        $employeeID = $this->objSession->get('user')['employeeID'];

        if ($checked == 0) { // Add Service To Employee
            $data = array();
            $data['serviceID'] = $serviceID;
            $data['employeeID'] = $employeeID;
            $result = $this->objMainModel->objCreate('employee_service', $data);
            return json_encode($result);
        } else if ($checked == 1) { // Remove Service To Employee
            $result = $this->objControlPanelModel->removeEmployeeService($employeeID, $serviceID);
            return json_encode($result);
        }
    }

    public function updateBussinessDay()
    {
        # Verify Session 
        if (empty($this->objSession->get('user')) || $this->objSession->get('user')['role'] != "employee") {
            $result = array();
            $result['error'] = 1;
            $result['msg'] = "SESSION_EXPIRED";
            return json_encode($result);
        }
        # params
        $field = $this->objRequest->getPost('field');
        $value = $this->objRequest->getPost('value');
        $employeeBussinesDayID = $this->objRequest->getPost('employeeBussinesDayID');

        $data = array();
        $data[$field] = $value;

        $result = $this->objMainModel->objUpdate('employee_bussines_day', $data, $employeeBussinesDayID);

        return json_encode($result);
    }

    public function cancelAppointment()
    {
        # params
        $appointmentID = $this->objRequest->getPost('appointmentID');

        $result = $this->objMainModel->objDelete('appointment', $appointmentID);

        return json_encode($result);
    } // ok

    public function processingAppointment()
    {
        $dataTableRequest = $_REQUEST;

        $params = array();
        $params['draw'] = $dataTableRequest['draw'];
        $params['start'] = $dataTableRequest['start'];
        $params['length'] = $dataTableRequest['length'];
        $params['search'] = $dataTableRequest['search']['value'];
        $params['employeeID'] = $dataTableRequest['employeeID'];

        $row = array();
        $totalRecords = 0;

        $result = $this->objDataTableModel->getEmployeeAppointmentProcessingData($params);
        $totalRows = sizeof($result);

        for ($i = 0; $i < $totalRows; $i++) {

            $custAvatar = '<div class="symbol symbol-30px symbol-circle me-3"><img src="' . imgCustomer($result[$i]->customerID) . '" class="" alt=""></div>';

            $date = "";
            if ($this->config[0]->lang == 'en')
                $date = date('F j, Y', strtotime($result[$i]->date));
            else {
                $mont =  date('F', strtotime($result[$i]->date));
                $date = lang('Text.' . $mont) . ' ' . date('j, Y', strtotime($result[$i]->date));
            }

            $schedule = '<span class="text-gray-800 fs-7 fw-bold"><i class="bi bi-clock-history fs-7"></i> ' . date('g:ia', strtotime($result[$i]->start)) . ' - ' . date('g:ia', strtotime($result[$i]->end)) . '</span>';
            $aux = json_decode($result[$i]->servicesJSON);
            $serv = "";

            foreach ($aux as $s) {
                $serv = $serv . '<div class="fw-semibold"><span class="bullet bullet-dot bg-primary me-2 h-10px w-10px"></span>' . $s->serviceTitle . '</div>';
            }

            $col = array();
            $col['customer'] = $custAvatar . ' ' . $result[$i]->customerName . ' ' . $result[$i]->customerLastName;
            $col['date'] = $date;
            $col['schedule'] = $schedule;
            $col['serv'] = $serv;
            $col['time'] = $result[$i]->totalTime . ' ' . lang('Text.minutes');
            $col['price'] = getMoneyFormat($this->config[0]->currency, $result[$i]->totalPrice);
            $row[$i] =  $col;
        }

        if ($totalRows > 0) {
            if (empty($params['search']))
                $totalRecords = $this->objDataTableModel->getTotalEmployeeAppointments($params);
            else
                $totalRecords = $totalRows;
        }

        $data = array();
        $data['draw'] = $dataTableRequest['draw'];
        $data['recordsTotal'] = intval($totalRecords);
        $data['recordsFiltered'] = intval($totalRecords);
        $data['data'] = $row;

        return json_encode($data);
    }
}
