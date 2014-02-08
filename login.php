<?php
session_start();
if(isset($_SESSION['Admin_id']))
{
	header('Location: index.php');
}

include('include/config.php');
include('include/dbop.class.php');

$dbop = new dbop();
if(isset($_POST['btnsubmit']))
{
	$result = $dbop->getSelectedRecord('user','*',"username='".$_POST['txtUser']."' AND password='".$_POST['txtPwd']."'");
	//$result=mysql_query($query);
	if($result)
	{
		$row=mysql_num_rows($result);
		$data=mysql_fetch_assoc($result);
	
	
		if(isset($_POST['chkrememberme']))
			{
				$usename=$_POST['txtUser'];
				$password=$_POST['txtPwd'];
				setcookie("username",$usename);
				setcookie("password",$password);
			}
		if($row>0)
		{
			session_start();
			$_SESSION['Admin_id'] = $data['user_id'];
			$_SESSION['Admin_name'] = $data['username'];
			
			header('Location:index.php');
		}
	}
	else
	{
			$msg= "Incorrect username and password";
	}
}
?>
<html>
<head>
<title>Login</title>
<link media="all" type="text/css" rel="stylesheet" href="css/960.css">
<link media="all" type="text/css" rel="stylesheet" href="css/reset.css">
<link media="all" type="text/css" rel="stylesheet" href="css/text.css">
<link media="all" type="text/css" rel="stylesheet" href="css/login.css">
<!--[if IE]>
<style type="text/css">h1{	

width:320px;}.container_16{margin-left:100px;magin-right:100px;}.label_re{width:120px;float:

left;}.black_button{float:left;width:auto;}#errordiv{ width:270px;}</style><![endif]-->
<script type="text/javascript" language="javascript">


function checkfrmBlankValidation()
{	
	usr=document.getElementById('txtUser').value;
	pwd=document.getElementById('txtPwd').value;
	if(usr=='' || pwd=='')
	{
		document.getElementById('errordiv').innerHTML='Please enter Username and Password.';	
		return false
	}
	

}



</script>
</head>
<body>
<div class="container_16"> <!--start--container_16-->
	<div class="grid_6 prefix_5 suffix_5"><!--start--grid_6 prefix_5 suffix_5-->
		<h1>Admin - Login</h1>
		<div class="login"><!--start--login-->
		<!--<p class="tip">You just need to hit the button and you're in!</p>
		<p class="error">This is when something is wrong!</p>-->
		<form id="form1" action="" method="post" name="form1" onSubmit="return checkfrmBlankValidation();">
			<p>
				<label>
					<strong>Username</strong>
					<input id="txtUser" class="inputText" type="text" name="txtUser"  value="<?php if(isset($_COOKIE['username'])) echo $_COOKIE['username']; ?>" />
				</label>
				
			</p>
			<p>
				<label>
					<strong>Password</strong>
					<input id="txtPwd" class="inputText" type="password" name="txtPwd" value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>" />
				</label>
				
			</p>
			<div id="errordiv" style="font-size:15px; font-weight:bold;color:#666666;">
			</div>
			<br />
			<br />
            <div  style="width:270px;">
			<label class="label_re">
				<input id="checkbox" type="checkbox" name="chkrememberme">Remember me</label>
			
			<div  class="black_button">
				<input type="submit" name="btnsubmit" class="black_button_btn" value="Authentification" >
			</div>
			</div>
			
			
		</form>
		<br clear="all">
		<?php if(isset($msg)) echo "<br/>". $msg;?>
		</div><!--end--login-->
		<div id="forgot">
			<a class="forgotlink" href="forgot-password.php">
			<span>Forgot your username or password?</span>
			</a>
		</div>
		
	</div><!--end--grid_6 prefix_5 suffix_5-->
</div><!--end--container_16-->

</body>
</html>