<?php

class Employee_IndexController extends Zend_Controller_Action
{
    private $department;
    private $employee;
    
    public function init()
    {
        /* Initialize action controller here */
        
        $this->logger = Zend_Registry::get('Zend_Log');
        
        // setting the site in the title; possibly in the layout script:
        $this->view->headTitle('Home');
        
        //$this->_helper->layout->setLayout('left-sidebar');
        
        // setting the controller and action name as title segments:
        $request = Zend_Controller_Front::getInstance()->getRequest();
        $this->view->headTitle($request->getControllerName())
             ->headTitle($request->getActionName());
         
        // setting a separator string for segments:
        $this->view->headTitle()->setSeparator(' / ');
        
        $this->department = new Employee_Model_Department();
        $this->employee = new Employee_Model_Employee();
    }

    public function indexAction()
    {        
        $this->view->message = "This is the INDEX Action within the INDEX Controller within the EMPLOYEE Module";
    }
    
    public function homeAction()
    {
        $employee_list = $this->employee->getAllEmployees();
        $this->view->user_list = $employee_list;
        $this->logger->info($employee_list);
    }
    
    public function deptAction()
    {
        $deptartment_list=$this->department->getDepartmentList();
        $this->view->dept_list = $deptartment_list;
        $rhis->logger->info($employee_list);
    }
    
    public function editAction()
    {
        $form = new Employee_Form_Editemployee();
        $params = $this->_request->getParams();
        $this->logger->info($params);
                
        if ($this->_request->isPost()) 
        {
            
            $form_data = $this->_request->getParams();
            $this->logger->info($form_data);

            if ($form->isValid($form_data))
            {
                $firstname = $form_data['firstname'];
                $lastname = $form_data['lastname'];
                $dob = $form_data['date_of_birth'];
                $job = $form_data['job_position_id'];
                $join_date = $form_data['join_date'];
                $sex = $form_data['sex'];
                $status = $form_data['status'];
                $employeeId = $params['employeeId'];        
                $this->logger->info($form_data);
                $data = $this->employee->updateEmployeeById($firstname,$lastname,$dob,$job,$join_date,$sex,$status,$employeeId);
                $this->view->message="Form is VALID $data Record Update";    
            }
            else
            {
                $this->view->message="This Form is INVALID Please Make Neccessary Changes";
                $this->view->form=$form;
            }
        }
        
        else
        {
            
            $empData=$this->employee->getEmployeeById($params['employeeId']);
            $form->populate($empData);
            $this->view->form=$form;
        }
    }
    
      
    public function updateAction()
    {
        $params = $this->_request->getParams();
        $firstname = $params['fname'];
        $lastname = $params['lname'];
        $dob = $params['dob'];
        $job = $params['job'];
        $join_date = $params['join_date'];
        $sex = $params['sex'];
        $status = $params['status'];
        $employeeId = $params['employeeId'];        
        $this->logger->info($params);
        $data = $this->employee->updateEmployeeById($firstname,$lastname,$dob,$job,$join_date,$sex,$status,$employeeId);
        $this->view->success=$data;
    }
    
    public function addAction()
    {
        $jobData=$this->employee->getJobPosition();
        $this->view->jobData=$jobData;
    }
    
    public function newempAction()
    {
        $params = $this->_request->getParams();
        $firstname = $params['fname'];
        $lastname = $params['lname'];
        $dob = $params['dob'];
        $job = $params['job'];
        $join_date = $params['join_date'];
        $sex = $params['sex'];
        $status = $params['status'];        
        $this->logger->info($params);
        $data=$this->employee->addNewEmployee($firstname,$lastname,$dob,$job,$join_date,$sex,$status);
        $this->view->data=$data;
        $this->view->message='Record Added to Database';
    }
    
    public function deleteAction()
    {
        $params = $this->_request->getParams();
        $data=$this->employee->deleteEmployeeById($params['employeeId']);
        $this->view->success=$data;
    }
    
    public function newemployeeAction()
    {
        $form = new Employee_Form_Newemployee();
        
        if ($this->_request->isPost()) {
            
            $form_data = $this->_request->getParams();
            
            if ($form->isValid($form_data)) {
                $firstname = $form_data['fname'];
                $lastname = $form_data['lname'];
                $dob = $form_data['dob'];
                $job = $form_data['job'];
                $join_date = $form_data['join_date'];
                $sex = $form_data['sex'];
                $status = $form_data['status'];        
                $this->logger->info($form_data);
                $data = $this->employee->addNewEmployee($firstname,$lastname,$dob,$job,$join_date,$sex,$status);
                $this->view->message = " Form is VALID. $data Record Added to Database";
            } else {
                $this->view->message = "Form is INVALID please make neccessary changes";
                $this->view->form = $form;
            }
        } else {
            $this->view->form = $form;
            
        }
    }
}

