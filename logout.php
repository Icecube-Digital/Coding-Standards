<?php
	session_start();
	//session_destroy();
	unset($_SESSION['Admin_id']);
	unset($_SESSION['Admin_name']);
	header('Location:login.php');
?>