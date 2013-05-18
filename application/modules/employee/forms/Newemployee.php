<?php

class Employee_Form_Newemployee extends Zend_Form
{
    private $job_title_list;
    
    public function init()
   {
       Zend_Dojo::enableForm($this);
       
       $employee = new Employee_Model_Department();
       $this->job_title_list = $employee->getDepartmentListOnly();
   }

   public function __construct($options = null)
   {
        parent::__construct($options);    
        /* Form Elements & Other Definitions Here ... */

        // Set the method for the display form to POST
        $this->setAction('')->setMethod('post');
            
            // add first name element
            $fname = new Zend_Form_Element_Text('fname');
            $fname->setLabel('Firstname:')
                ->addFilters(array('StringTrim', 'StripTags'))
                ->setRequired(TRUE)
                ->addValidator('NotEmpty');
            $this->addElement($fname);
                       
            // add first name element
            $this->addElement('text', 'lname',
                    array(
                       'label'      => 'Last Name *',
                       'required'   => 'true'));
                       

            // Add a DOB element
            $this->addElement('text', 'dob',
                array(
                'label'      => 'Date of Birth *',
                'required'   => true,
                    'filters'    => array('StringTrim')));
            
            // Add the Job Title type
            $this->addElement('select', 'job',
                array(
                'label'      => 'Job Title *',
                'multiOptions' => $this->job_title_list,
                'required'   => true
                ));
                
            // Add a DOB element
            $this->addElement('text', 'join_date',
                array(
                'label'      => 'Join Date *',
                'required'   => true,
                'filters'    => array('StringTrim')));
            
            $gender_list = array('' => '-- Select a Gender --', 'MALE' => 'MALE','FEMALE' => 'FEMALE');
            // Add the gender
            $this->addElement('select', 'sex',
                array(
                'label'      => 'Gender *',
                'multiOptions' => $gender_list,
                'required'   => true
                ));
                
            // Add the status
            $this->addElement('select', 'status',
                array(
                'label'      => 'Status *',
                'multiOptions' => array('' => '-- Select a Status --', 'ACTIVE' => 'ACTIVE','INACTIVE' => 'INACTIVE'),
                'required'   => true
                ));
                
            /*    

            $this->addElement(
                'DateTextBox', 
                 'start_dt',
                array(
                    'label'          => 'Start Date *',
                    'required'       => true,
                    'invalidMessage' => 'Invalid date specified.',
                    'formatLength'   => 'long',
                    'datePattern'     => 'yyyy-MM-dd',
                    'class'          => 'textbox'));
                    
            $this->addElement(
                'TimeTextBox', 
                 'start_time',
                array(
                    'label'          => 'Start Time *',
                    'required'       => true,
                    'invalidMessage' => 'Invalid time specified.',
                    'timePattern'      => 'HH:mm:ss',
                    'clickableIncrement'  => 'T00:15:00',
                    'visibleIncrement'    => 'T00:15:00',
                    'visibleRange'        => 'T01:00:00',
                    'class'             => 'textbox'));

            $this->addElement(
                    'DateTextBox', 
                    'end_dt',
                    array(
                        'label'          => 'End Date *',
                        'required'       => true,
                        'invalidMessage' => 'Invalid date specified.',
                        'datePattern'    => 'yyyy-MM-dd',
                        'class'          => 'textbox'));
                        
            $this->addElement(
                'TimeTextBox', 
                 'end_time',
                array(
                    'label'          => 'End Time *',
                    'required'       => true,
                    'invalidMessage' => 'Invalid time specified.',
                    'timePattern'      => 'HH:mm:ss',
                    'clickableIncrement'  => 'T00:15:00',
                    'visibleIncrement'    => 'T00:15:00',
                    'visibleRange'        => 'T01:00:00',
                    'class'             => 'textbox'));
                */
                

             // Add the submit button
            $this->addElement('submit', 'submit',
                   array(
                    'ignore'   => true,
                    'label'    => 'Create Campaign'));
    }
}