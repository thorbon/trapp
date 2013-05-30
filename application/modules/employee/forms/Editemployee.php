<?php

class Employee_Form_Editemployee extends Zend_Form
{
    private $job_title_list;
    
    public function init()
   {
       Zend_Dojo::enableForm($this);
       $logger = Zend_Registry::get('Zend_Log');
       
       $dept = new Employee_Model_Department();
       $this->job_title_list = $dept->getDepartmentListOnly();
              
       $logger->info($this->job_title_list);
   }

   public function __construct($options = null)
   {
        parent::__construct($options);
        /* Form Elements & Other Definitions Here ... */

        // Set the method for the display form to POST
        $this->setAction('')->setMethod('post');
            
            // add first name element
            $this->addElement('text','firstname',array('label'=>'First Name *','required'=>'true','filters'=>array('StringTrim','StripTags'),
            'validators'=>array('Alpha')));
                       
            // add last name element
            $this->addElement('text', 'lastname',array('label' => 'Last Name *','required' => 'true','filters'=>array('StringTrim','StripTags'),
            'validators'=>array('Alpha')));
                       

            // Add a DOB element
            $this->addElement('text', 'date_of_birth', 
            array(
            'label' => 'Date of Birth (Format YYYY-MM-DD) *', 
            'required' => true, 
            'filters' => array('StringTrim','StripTags'),
            'validators' =>  array(array('date',true,'format'=>'yyyy-MM-dd'))));
            
            // Add the Job Title type
            $this->addElement('select', 'job_position_id', array('label' => 'Job Title *', 'multiOptions' => $this->job_title_list, 'required' => true));
                
            // Add a DOB element
            $this->addElement('text', 'join_date',
            array(
            'label' => 'Join Date (Format YYYY-MM-DD) *',
            'required' => true,
            'filters' => array('StringTrim','StripTags'),
            'validators' =>  array(array('date', true, 'format'=>'yyyy-MM-dd'))));

            
            $gender_list = array('MALE' => 'MALE','FEMALE' => 'FEMALE');
            // Add the gender
            $this->addElement('select', 'sex',
                array(
                'label' => 'Gender *',
                'multiOptions' => $gender_list,
                'required' => true
                ));
                
            // Add the status
            $this->addElement('select', 'status',
                array(
                'label' => 'Status *',
                'multiOptions' => array('ACTIVE' => 'ACTIVE','INACTIVE' => 'INACTIVE'),
                'required' => true
                ));
                
            /*

$this->addElement(
'DateTextBox',
'start_dt',
array(
'label' => 'Start Date *',
'required' => true,
'invalidMessage' => 'Invalid date specified.',
'formatLength' => 'long',
'datePattern' => 'yyyy-MM-dd',
'class' => 'textbox'));
$this->addElement(
'TimeTextBox',
'start_time',
array(
'label' => 'Start Time *',
'required' => true,
'invalidMessage' => 'Invalid time specified.',
'timePattern' => 'HH:mm:ss',
'clickableIncrement' => 'T00:15:00',
'visibleIncrement' => 'T00:15:00',
'visibleRange' => 'T01:00:00',
'class' => 'textbox'));

$this->addElement(
'DateTextBox',
'end_dt',
array(
'label' => 'End Date *',
'required' => true,
'invalidMessage' => 'Invalid date specified.',
'datePattern' => 'yyyy-MM-dd',
'class' => 'textbox'));
$this->addElement(
'TimeTextBox',
'end_time',
array(
'label' => 'End Time *',
'required' => true,
'invalidMessage' => 'Invalid time specified.',
'timePattern' => 'HH:mm:ss',
'clickableIncrement' => 'T00:15:00',
'visibleIncrement' => 'T00:15:00',
'visibleRange' => 'T01:00:00',
'class' => 'textbox'));
*/
                

             // Add the submit button
            $this->addElement('submit', 'submit',
                   array(
                    'ignore' => true,
                    'label' => 'Update Record'));
    }
}