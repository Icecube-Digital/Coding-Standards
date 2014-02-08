<?php
include('include/config.php');
include('chksession.php');

include('include/dbop.class.php');
include('functions/functions.php');
$dbop = new dbop();

if(isset($_REQUEST['email']))
{

	$check_email = $dbop->getSelectedRecord('client','username','username= "'.mysql_real_escape_string($_REQUEST['email']).'"');
	
	if($check_email)
	{
		$row= mysql_num_rows($check_email);
		if($row > 0)
		{
			echo "<p style='color:red'>Email Id Already Exists.</p><input type='hidden' id='emailerr' value='true'/>";
		}
	}
	else
	{
		echo "<p style='color:green'>Email Id Available.</p><input type='hidden' id='emailerr' value='false'/>";
	}
	
}
?> 