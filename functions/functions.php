<?php
    function selectedOption($option,$value)
    {
        if($option == $value)
            return "selected='selected'";
        else
            return "";
    }
    function checkedOption($option,$value)
    {
		if(is_array($value)){			
			if(in_array($option, $value))
				return 'checked="checked"';
			else
				return "";        
		}else {
			if($option == $value)
				return 'checked="checked"';
			else
				return "";        
		}
    }
    function rdbOption($option,$value)
    {
        if($option == $value)
            return 'checked="checked"';
        else
            return "";                
    }
    function __selected($name, $val) 
    {        
		//if(isset($name) && ($name == $val)){ echo  'selected="selected"'; }else{ echo 'hi';} die;
        return isset($name) && ($name == $val) ? 'selected="selected"' : '';
    }
    function __checked($name, $val) 
    {        
        return isset($_POST[$name]) && ($_POST[$name] == $val) ? 'checked="checked"' : '';
    }    
    function uploadBanner($file,$folder)
    {        
        if ((($file["type"] == "image/gif") || ($file["type"] == "image/jpeg") || ($file["type"] == "image/pjpeg") || ($file["type"] == "image/png")))
        {
            if ($file["error"] > 0)
            {
                return "Return Code: " . $file["error"] . "<br />";
            }
            else
            {
                if (file_exists("$folder/" . $file["name"]))
                {
                    return $file["name"] . " already exists. ";
                }
                else
                {
                    move_uploaded_file($file["tmp_name"],"$folder/" . $file["name"]);
//                    return "File Uploaded in: " . "$folder/" . $file["name"];
                    return "Success";
                }
            }
        }
        else
        {
            return "Invalid file";
        }
    }
  
	//  Check Function Of the Date All
	function check_in_range($start_date, $end_date)
	{
		// Convert to timestamp
		$start_ts = strtotime($start_date);
		$end_ts = strtotime($end_date);
		// Check that date is between start & end
		if(($start_ts <= $end_ts))
			return true;
		else 
			return false;
	}
	/*
		********************************************************
		  Get the  All Date WeekDays current Date .	
		********************************************************
		1.  Pass weekdays Name array ,month , year and number of days  in month .
	*/
	function getAllDateWeekdays($weekdays,$days_in_month,$month,$year){
		
		$arrDate  = '';
		
		if($weekdays != ''){
			$dateCnt = 1;
			while($dateCnt  <=   $days_in_month ){
				$curDate  = $year.'-'.$month.'-'.$dateCnt;
				$dayName = strtolower(date('l',strtotime($curDate)));											
				if(in_array($dayName,$weekdays))
				{
					if ($dateCnt >= 1 &&  $dateCnt <= 9){
						$inpDigit  =  '0'.$dateCnt;
						$arrDate[] = str_pad($dateCnt, 2, '0', STR_PAD_LEFT);
					}else {
						$arrDate[] = $dateCnt;
					}
				}
				$dateCnt++;
			}
			if(!empty($arrDate))
				return $arrDate;
			else
				return false;
		}else{
			return false;
		}
	}
	
	/*
		********************************************************
		  GEt All  WeekDayS Name 
		********************************************************
		1.  Pass The  Day numbere only.

	*/
	function  dayName($dayNum){
		$daysName = '';
		switch ($dayNum){
			case 0:
				$daysName ='sunday';
				break;			
			case 1:
				$daysName = 'monday';
				break;				
			case 2:
				$daysName = 'tuesday';
				break;
			case 3:
				$daysName = 'wednesday';
				break;
			case 4:
				$daysName = 'thursday';
				break;
			case 5:
				$daysName = 'friday';
				break;
			case 6:
				$daysName = 'saturday';
				break;
			default :
				$daysName ='';
			 break;
	
		}
		if($daysName != '')
			return $daysName ;
		else 
			return  false;
		
	}
	
	/*
		********************************************************
		  GEt All  WeekDayS Name 
		********************************************************
		1.  Pass  All  The  Date  Of the  Weeks and those are belog which  Month and year .
	*/
	function getAllDateWeekdaysName ($datesArr,$days_in_month,$month,$year){
		$includedNames = ''; 
		for($i= 0; $i <=7 ; $i++){
			$flag = false;
			$dayName1 = dayName($i) ;
			$weekdays[0] = $dayName1;
			$dateArr  =  getAllDateWeekdays($weekdays,$days_in_month,$month,$year);
			for($j =0; $j < count($dateArr);$j++){
				if(!in_array($dateArr[$j],$datesArr)){					
					$flag =  false;
					break;
				}else {
					$flag =  true;
				}			
			}
			//  if Flag True  Get the Days  Include.
			if($flag){
				$includedNames[$i] = $dayName1;
			}
		}
		if($includedNames != ''  &&  (!empty($includedNames)))
			return  array_values(array_filter($includedNames));
		else
			return false;
	}
	
	
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
	
	function getUserBusinessDetail($searchkeyword,$city,$state,$country)
	{
		$key = '';
		
		//      Fetch list of hotels from local maps and custom code all hidden
		
		return $details;
	
	}
	
	//  Sorting  Two Dimesiona Array Key Wise 
	function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
//  Array  Clean up 
	function array_clean($array, $on, $valueForClean=0)
{
	$new_array = array();
    $sortable_array = array();
	$sortable_array =  $array;
	   if (count($array) > 0) {
		foreach( $array as $key =>$val )
		{
			//echo( $array[$key][$on]);
			   if ( $valueForClean == (int) $array[$key][$on]){
				 	unset( $sortable_array[ $key ] );
					//echo  $key;
			  }
		}
       }	

    return $sortable_array;
}
// Object to  array
function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}
	
	//  GEt  the  Citation Count Detail  
	/******************************
		Client_id  =  User id
		Project_id  =  If Project  assign to it  Otherwise exclude it.
		type =  get Count of ralated Business OR keywod by default keyword count.
	************************/
	function getCitationCount($client_id,$project_id,$type= 'keyword'){
		if($client_id != '' &&  $client_id != 0){
			if ($project_id  != ''  &&  $project_id != 0){
				$Sql = "SELECT * FROM  citation WHERE  client_id = ".$client_id." AND type=".$type;
			}else{
				$Sql = "SELECT * FROM  citation WHERE  client_id = ".$client_id." AND type=".$type." AND  poject_id=".$project_id;
			}
			$rsCitaionCount =  mysql_query($Sql);
			if(!empty($rsCitationCount) &&  $rsCitaionCount != ''){
				$rowCitationCount  =  mysql_fetch_array($rsCitationCount);
				return ($rowCitationCount['total_count']);
			}else
				return  false;			
		}else{
			return false;
		}		
	}
	/*function for get unique value then sort them*/

function unique_sort($arrs, $id) {
    $unique_arr_final = array();
	$unique_arr =  array();
	$num =1;
    foreach ($arrs AS $arr) {

        if (!in_array($arr[$id], $unique_arr)) {
            $unique_arr_final[] = $arrs[$num];
			$unique_arr[] = $arr[$id];
        }
		$num++;
    }
    sort($unique_arr_final);
    return $unique_arr_final;
}
		
?>