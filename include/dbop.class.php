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
           $lsQry = "select admin_id,username,password,admin_type from admin_master where username='".mysql_real_escape_string($username)."' and password='".mysql_real_escape_string(base64_encode($password))."'";
           $this->lsQry = $lsQry;
           $this->rs = mysql_query($lsQry,$this->dbCon) or die("Error in chkUser(): ".mysql_error());
           $liCount = mysql_num_rows($this->rs);       
           if($liCount != 0)
                return mysql_fetch_array($this->rs);
           else        
               return false;
        }
        function chkPermission($user_id,$permission_keyword) 
        {
            $this->rs = mysql_query("SELECT permissions FROM admin_master WHERE admin_id=$user_id") or die("Fetch Error chkPermission (): ".mysql_error());
            if($this->rs)
            {
                $value = mysql_fetch_row($this->rs);            
                $permission_list = $value[0];
                if(substr_count($permission_list,$permission_keyword) != 0)
                    return true;
                else
                    return false;
            }
            else
                return false;

        }
        // Function return all records of specified table if exist else return false
        function getAllRecord($table) 
        {
            $lsQry="select * from $table";
			
            $this->lsQry=$lsQry;
            $this->rs=mysql_query($lsQry);
			
            if($this->rs) 
            {
                if(mysql_num_rows($this->rs)!=0)
                    return $this->rs;
                else 
                    return false;
            }
            else 
                return false;
        }
         function getAllRecordcondition($table,$fieldArray,$condition) 
        {
            $lsQry="select * from $table order by $fieldArray $condition";
            $this->lsQry=$lsQry;
            $this->rs=mysql_query($lsQry);
            if($this->rs) 
            {
                if(mysql_num_rows($this->rs)!=0)
                    return $this->rs;
                else 
                    return false;
            }
            else 
                return false;
        }
        
        
        // Function return result set according to condition
        // Return result set in acending order if condition is "asc" and 
        // Return result set in desending order if condition is "desc" 
        function getSelectedRecord($table,$fieldArray,$condition) 
        {
            if($condition!="")
            {
                if($condition=="asc")
                {
                    $lsQry="select $fieldArray from $table order by $fieldArray asc";
                }
                else if($condition=="desc")
                {
                    $lsQry="select $fieldArray from $table order by $fieldArray desc";
                }
                else
                    $lsQry="select $fieldArray from $table where $condition";
            }
            else
                $lsQry="select $fieldArray from $table";
                
            $this->lsQry=$lsQry;
            $this->rs=mysql_query($lsQry);
			
            if($this->rs) 
            {
                if(mysql_num_rows($this->rs)!=0)
                    return $this->rs;
                else 
                    return false;
            }else 
                return false;
        }
        
        // Function to insert record in specified table
        function insert_array($table, $liCounternsert_values) 
        {
            foreach($liCounternsert_values as $key=>$value) 
            {
                if(!empty($value)) {
                    $keys[] = $key;
                    $liCounternsertvalues[] = '\''.mysql_real_escape_string($value).'\'';
                }
            }
            if(count($keys) < 1)
                return false;
                
            $keys = implode(',', $keys);
            $liCounternsertvalues = implode(',', $liCounternsertvalues);
            $lsQry = "INSERT INTO $table ($keys) VALUES ($liCounternsertvalues)";     
			
            $this->lsQry=$lsQry;
            unset($keys);
            unset($liCounternsertvalues);
            
            $this->rs=mysql_query($lsQry) or die("Insert Error insert_array(): ".mysql_error());
            return true;
            
            if($this->rs)
                return $this->rs;
        }
        
        // Funtion to update specified table record with passes values on particular condition 
        function update_array($table, $update_values, $condition) 
        {                                           
            foreach($update_values as $key=>$value) {
                $sets[] = $key.'=\''.$value.'\'';
            }
            $sets = implode(',', $sets);
        	$lsQry = "UPDATE $table SET $sets WHERE $condition";
            $this->lsQry=$lsQry;
            $this->rs=mysql_query($lsQry) or die("Update Error update_array(): ".mysql_error());
            if($this->rs)
                return true;
            else
                return false;
                
                //$this->rs;
        }
        
        // Function to delete record of specified table
	    function deleteRec($table,$field,$fieldValue) 
        {
            $lsQry="delete from $table where $field='$fieldValue'";
            $this->lsQry=$lsQry;
            $this->rs=mysql_query($lsQry) or die("Delete Error deleteRec(): ".mysql_error());
            if($this->rs)
                return true;
            else
                return mysql_error();
        }
        
       
        function deleteOnCond($table,$condition) 
        {
            $lsQry="delete from $table where $condition";
            $this->lsQry=$lsQry;
            $this->rs=mysql_query($lsQry) or die("Delete Error deleteOnCond(): ".mysql_error());
            if($this->rs)
                return true;
            else
                return mysql_error();
        }
        // Function to fetch single value directly
        function getSingleVal($table,$field,$cond) 
        {
            $lsQry = "SELECT $field FROM $table WHERE $cond";        
            $rs = mysql_query($lsQry) or die("Fetch Error getSingleVal(): ".mysql_error()); 
            $cnt = mysql_num_rows($rs);
            if($cnt == 0)
                return false;
            else            
                return mysql_fetch_row($rs);
        }
        
        // Function to check if specified filed value is exist in table or not
        function isExist($table,$field,$fieldvalue)
        {
            $lsQry = "Select $field from $table where $field='".$fieldvalue."'";            
            $rs = mysql_query($lsQry) or die("Check Error isExist(): ".mysql_error());
            $num = mysql_num_rows($rs);
            if($num == 0)
                return false;
            else
                return true;        
        }
        
        // Function to fetch data from two filed from 2 different table in 1 filed
        //function getRecordByQuery($lsQry)
//        {
//            $this->rs=mysql_query($lsQry) or die("Fetch Error getRecordByQuery(): ".mysql_error());    
//            if($this->rs) 
//            {        
//                if(mysql_num_rows($this->rs) != 0)
//                    return $this->rs;
//                else 
//                    return false;
//            }
//            else
//                return false;
//            
//        } 
        
        // Function To get no of records in table
        function getTotalRecord($table,$fieldArray,$condition)
        {
            if($condition != "")
                $lsQry = "SELECT $fieldArray from $table where $condition";
            else
                $lsQry="SELECT $fieldArray from $table"; 

            $this->rs=mysql_query($lsQry) or die("Fetch Error getTotalRecord(): ".mysql_error());    
            return mysql_num_rows($this->rs);
        }
        
        // Function To copy records from one table to another
        function copyRecords($table,$fieldArray,$condition)
        {
            foreach($fieldArray as $key=>$value) 
            {
                $aKey[] = $key;
                $aValue[] =$value;
            }
            $aKey = implode(',',$aKey);
            $aValue = implode(',',$aValue);
            $this->lsQry ="INSERT INTO $table($aKey) SELECT $aValue FROM $table WHERE $condition";
            $this->rs = mysql_query($this->lsQry) or die("Insertion Error copyRecords(): ".mysql_error());

            if($this->rs)
                return $this->rs;
            else
                return false;
        }
        
        function getValueById($table,$field,$cond)    
        {
			
            $this->rs = mysql_query("SELECT $field FROM $table WHERE $cond") or die("Fetch Error getValueById(): ".mysql_error());
            if($this->rs)
            {
                $value = mysql_fetch_row($this->rs);            
                return $value[0];
            }
            else
                return "";
            
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
           foreach($fieldArray as $key=>$value) 
           {
                $sets[] = $key.'=\''.$value.'\'';
           }
           $sets = implode(' AND ', $sets);
           $lsQry="SELECT * FROM $table WHERE $sets";
           $this->lsQry=$lsQry;
           $rs=mysql_query($lsQry);
           if(mysql_num_rows($rs) > 0)
                return true;    // Duplicate
            else
                return false;    // Not Duplicate        
       }
       function getPageContent($page_id)
       {
           $lsQry = "Select * FROM cms_master WHERE page_id=$page_id";
           $rs = mysql_query($lsQry);
           return mysql_fetch_assoc($rs);
       }
	    function deleteByCondition($table,$condition) 
        {
            $lsQry="delete from $table where $condition";
            $this->lsQry=$lsQry;
            $this->rs=mysql_query($lsQry) or die("Delete Error deleteRec(): ".mysql_error());
            if($this->rs)
                return true;
            else
                return mysql_error();
        }
	   


		function deleteAll($table) 
        {
        
            $this->lsQry=$lsQry;
            $this->rs=mysql_query($lsQry) or die("Delete Error deleteRec(): ".mysql_error());
            if($this->rs)
                return true;
            else
                return mysql_error();
        }
	   
    }
    
    
?>