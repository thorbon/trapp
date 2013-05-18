<?php
  
class Employee_Model_Department
{
    function __construct()
    {
        $this->db = Zend_Registry::get('Zend_Module3_Db');
        $this->logger = Zend_Registry::get('Zend_Log');
    }
    
    /**
     * Retrieves user information
     *
     * @parameter int $arg1 
     * @parameter float $arg2
     * @return array
     */
    function getDepartmentList()
    {
        try
        {
            $sql = $this->db->select()->from(array('department'))
                                      ->join('employee','department.manager_id=employee.employee_id',array('employee.firstname','employee.lastname'));
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
    
    function getDepartmentListOnly()
    {
        try
        {
            $sql = $this->db->select()->from(array('job_position'), array('job_position_id', 'job_position_name'));
                            /*->where('T1.column1 = ?', $arg1)
                            ->where('T1.column2 = ?', $arg2)
                            ->where('T1.column3 = ?', 'ACTIVE')
                            ->limit(1);*/
                            
            $data = $this->db->fetchPairs($sql);
            
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
}
?>