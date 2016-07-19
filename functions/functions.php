<?php
    function selectedOption($option,$value)
    {
        //check option selected
    }
    function checkedOption($option,$value)
    {
	//check option selected
    }
    function rdbOption($option,$value)
    {
        //check option selected
    }
    function __selected($name, $val) 
    {        
	//check option selected
    }
    function __checked($name, $val) 
    {        
        //check option checked
    }    
    function uploadBanner($file,$folder)
    {        
        //check upload banner to specified folder
    }
  
    //  Check Function Of the Date All
    function check_in_range($start_date, $end_date)
    {
    	// Check that date is between start & end
    }
    /*
    	********************************************************
    	  Get the  All Date WeekDays current Date .	
    	********************************************************
    	1.  Pass weekdays Name array ,month , year and number of days  in month .
    */
    function getAllDateWeekdays($weekdays,$days_in_month,$month,$year){
    	// Return dates array
    }
	
    /*
    	********************************************************
    	  GEt All  WeekDayS Name 
    	********************************************************
    	1.  Pass The  Day numbere only.
    */
    function  dayName($dayNum){
        // Return day from date
    }
	
    /*
    	********************************************************
    	  GEt All  WeekDayS Name 
    	********************************************************
    	1.  Pass  All  The  Date  Of the  Weeks and those are belog which  Month and year .
    */
    function getAllDateWeekdaysName ($datesArr,$days_in_month,$month,$year){
        // Return dates array with day names
    }
	
    /*
    	********************************************************
    	  Get city name from user's IP 
    	********************************************************
    */	
    function getClientLocation()
    {
    	
    	$ip=$_SERVER['REMOTE_ADDR'];
	
        $key = '';
	
	$urlToFetch = 'http://api.ipinfodb.com/v3/ip-city/?key='. $key .'&ip='. $ip .'&format=json';
	
	$curl_handle = curl_init();
	
	$header[] =  'Content-Type: application/json';
	
	curl_setopt($curl_handle, CURLOPT_URL, "$urlToFetch");
	curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $header);
	
	curl_setopt($curl_handle, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
	curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 120);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
	
	$buffer = curl_exec($curl_handle);
	//var_dump(curl_getinfo($curl_handle));
	curl_close($curl_handle);
	
	$arr = json_decode($buffer,true);
	
	return $arr;
    }
    
    //  GEt  the  local business's details from google
    /******************************
    	searchKeyword  =  Keyword of busineess search
    	city  =  City of business search.
    	state =  State of business search.
    	country =  Country of business search.
    ************************/
    function getUserBusinessDetail($searchKeyword,$city,$state,$country)
    {
    	$key = '';
    	
    	//      Fetch list of hotels from local maps 
    	//      custom code all hidden
    	
    	return $details;
    
    }
	
    //  Sorting  Two Dimesiona Array Key Wise 
    function array_sort($array, $on, $order=SORT_ASC)
    {
        // Return array
    }

    //  Array  Clean up 
    function array_clean($array, $on, $valueForClean=0)
    {
        // Return array
    }

    // Object to  array
    function objectToArray($d) {
    	// Return array
    }
	
    //  GEt  the  Citation Count Detail  
    /******************************
    	Client_id  =  User id
    	Project_id  =  If Project  assign to it  Otherwise exclude it.
    	type =  get Count of ralated Business OR keywod by default keyword count.
    ************************/
    function getCitationCount($client_id,$project_id,$type= 'keyword'){
    		
    }

    /*function for get unique value then sort them*/
    function unique_sort($arrs, $id) {
        // Return array
    }

?>
