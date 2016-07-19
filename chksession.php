<?php
	session_start();
	if(!isset($_SESSION['Admin_id']) || $_SESSION['Admin_id']=='')
	{
		header('Location: login.php');
	}
?>
