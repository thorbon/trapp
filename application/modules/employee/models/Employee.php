<?php
  
class Model_Employee
{
    function __construct()
    {
        $this->db = Zend_Registry::get('Zend_Module3_Db');
        $this->logger = Zend_Registry::get('Zend_Log');
    }
    
    /**
    * Retrieves employee information
    * 
    * @return array
    * 
    */
    function getAllEmployees()
    {
        try
        {
            $sql = $this->db->select()
                            ->from(array('employee'))
                            ->join('job_position', 'employee.job_position_id = job_position.job_position_id');
                            /*->where('T1.column1 = ?', $arg1)
                            ->where('T1.column2 = ?', $arg2)
                            ->where('T1.column3 = ?', 'ACTIVE')
                            ->limit(1);*/
                            
            $data = $this->db->fetchAll($sql);
            
            $this->logger->info("This is a test info");
            
            if ($data)
                return $data;
        }
        catch (Exception $e)
        {
            $this->logger->err(__CLASS__."->".__FUNCTION__.": {$e->getMessage()}");
        }
        
        return false;
    }
    
   /**
   * Updates Employee Record Selected by employee_id varialble
   * 
   * @param string $firstname
   * @param string $lastname
   * @param date $dob
   * @param string $job
   * @param date $join_date
   * @param string $sex
   * @param sting $status
   * @param int $employee_id
   */
    function updateEmployeeById($firstname, $lastname, $dob, $job, $join_date, $sex, $status, $employee_id)
    {
        try
        {
            $data['firstname'] = $firstname;
            $data['lastname'] = $lastname;
            $data['date_of_birth'] = $dob;
            $data['job_position_id'] = $job;
            $data['join_date'] = $join_date;
            $data['sex'] = $sex;
            $data['status'] = $status;
            
            $dateofbirth = new DateTime($dob);
            $todaydate = new DateTime();
            $age=$todaydate->diff($dateofbirth);
            $years_age = $age->y;
            $data['age'] = $years_age;
            
            $join = new DateTime($join_date);
            $tenure=$todaydate->diff($join);
            $years_tenure = $tenure->y;
            $data['tenure'] = $years_tenure;
            
            $where[] = $this->db->quoteInto('employee_id = ?', $employee_id);
            
            $rows_updated = $this->db->update('employee', $data, $where);
            
            if ($rows_updated)
                return true;
        }
        catch (Exception $e)
        {
            $this->logger->err(__CLASS__."->".__FUNCTION__.": {$e->getMessage()}");
        }
        
        return false;
    }
    
    /**
    * Retrieves Employee Record by Employee ID
    * 
    * @param int $empId
    */
    
    function getEmployeeById($empId)
    {
        try
       {
        $sql = $this->db->select()
                            ->from(array('employee'))
                            ->where('employee.employee_id = ?', $empId);
                                                        
            $data = $this->db->fetchRow($sql);
            
            $this->logger->info($data);
            
            if ($data)
                return $data;
        }
        catch (Exception $e)
        {
            $this->logger->err(__CLASS__."->".__FUNCTION__.": {$e->getMessage()}");
        }
        
        return false; 
    }
    
    /**
    * Retrieves List of Job Positions
    * 
    */
    
    function getJobPosition()
    {
        try
       {
        $sql = $this->db->select()
                            ->from(array('job_position'));
                            
                            
            $data = $this->db->fetchAll($sql);
                      
            if ($data)
                return $data;
        }
        catch (Exception $e)
        {
            $this->logger->err(__CLASS__."->".__FUNCTION__.": {$e->getMessage()}");
        }
        
        return false; 
    }
    /**
    * put your comment there...
    * 
    * @param mixed $first_name
    * @param mixed $last_name
    * @param mixed $age
    * @param mixed $status
    */
    function addNewEmployee($firstname, $lastname, $dob, $job, $join_date, $sex, $status)
    {
        try
        {
            $data['firstname'] = $firstname;
            $data['lastname'] = $lastname;
            $data['date_of_birth'] = $dob;
            $data['job_position_id'] = $job;
            $data['join_date'] = $join_date;
            $data['sex'] = $sex;
            $data['status'] = $status;
            
            $dateofbirth = new DateTime($dob);
            $todaydate = new DateTime();
            $age=$todaydate->diff($dateofbirth);
            $years_age = $age->y;
            $data['age'] = $years_age;
            
            $join = new DateTime($join_date);
            $tenure=$todaydate->diff($join);
            $years_tenure = $tenure->y;
            $data['tenure'] = $years_tenure;
            
            $this->db->insert('employee', $data);
        }
        catch (Exception $e)
        {
            $this->logger->err(__CLASS__."->".__FUNCTION__.": {$e->getMessage()}");
        }
    }
    
    function deleteEmployeeById($empId)
    {
        try
        {
            $where[] = $this->db->quoteInto('employee_id = ?', $empId);
            
            $rows_deleted = $this->db->delete('employee',$where);
            
            if ($rows_deleted)
                return true;
        }
        catch (Exception $e)
        {
            $this->logger->err(__CLASS__."->".__FUNCTION__.": {$e->getMessage()}");
        }
        
        return false;
    }
}