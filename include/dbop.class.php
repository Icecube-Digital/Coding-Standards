<?php
  	// error_reporting(0);
    require_once("config.php");
    class dbop 
    {
        public $rs = "";
        var $liCounter;
        var $dbCon;
        var $totalRow;
        var $lsQry;
        
        //  Constructor For class which define database connection 
     /*   function dbop() 
        {
            $this->dbCon = mysql_connect(HOST,USER,PWD)  or die('Could not connect :'.mysql_error());
            mysql_select_db(DB, $this->dbCon)or die('DataBase Not Found'.mysql_error());
        }*/
        
        // Function check user with this username and password is existing or not
        // Return user_id if exists else return 0	
        function chkUser($username,$password) 
        {
           
        }
        function chkPermission($user_id,$permission_keyword) 
        {
            

        }
        // Function return all records of specified table if exist else return false
        function getAllRecord($table) 
        {
           
        }
         function getAllRecordcondition($table,$fieldArray,$condition) 
        {
            
        }
        
        
        // Function return result set according to condition
        // Return result set in acending order if condition is "asc" and 
        // Return result set in desending order if condition is "desc" 
        function getSelectedRecord($table,$fieldArray,$condition) 
        {
            
        }
        
        // Function to insert record in specified table
        function insert_array($table, $liCounternsert_values) 
        {
            
        }
        
        // Funtion to update specified table record with passes values on particular condition 
        function update_array($table, $update_values, $condition) 
        {                                           
            
        }
        
        // Function to delete record of specified table
	function deleteRec($table,$field,$fieldValue) 
        {
            
        }
        
       
        function deleteOnCond($table,$condition) 
        {
            
        }
        // Function to fetch single value directly
        function getSingleVal($table,$field,$cond) 
        {
            
        }
        
        // Function to check if specified filed value is exist in table or not
        function isExist($table,$field,$fieldvalue)
        {
            
        }
        
        
        // Function To get no of records in table
        function getTotalRecord($table,$fieldArray,$condition)
        {
            
        }
        
        // Function To copy records from one table to another
        function copyRecords($table,$fieldArray,$condition)
        {
            
        }
        
        function getValueById($table,$field,$cond)    
        {
	
        }
        
        // Functions used to define database transaction --------------------------------------------------------------------
        
        // Used to begin transaction
        function begin()
        {
            @mysql_query("BEGIN");
        }
        
        // Used to commit transaction
        function commit()
        {
            @mysql_query("COMMIT");
        }
        
        // Used to rollback transaction
        function rollback()
        {
            @mysql_query("ROLLBACK");
        }
        
       // retrurn true or false  depend on record existance
       function isDuplicateEntry($table,$fieldArray)
       {
             
       }
       function getPageContent($page_id)
       {
           
       }
	function deleteByCondition($table,$condition) 
        {
           
        }
	   


	function deleteAll($table) 
        {
        
           
        }
	   
    }
    
    
?>
