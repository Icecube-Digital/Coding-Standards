<?php
  $mysql_hostname = "localhost";
  $mysql_user = "";
  $mysql_password = "";
  $mysql_database = "sitedatabase";
  $bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Oops something went wrong");
  mysql_select_db($mysql_database, $bd) or die("Oops something went wrong");
?>
