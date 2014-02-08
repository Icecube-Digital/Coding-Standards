<?php
session_start();

if(isset($_SESSION['Admin_id']))
{
	header("location: index.php");
}

$message  = ''; ///  Set the Message 
include('include/config.php');
include('include/dbop.class.php');

include('Mail.php');
$mail = new Mail();

$dbop = new dbop();
if(isset($_POST['btnsubmit']))
{
	$result = $dbop->getSelectedRecord('user','*',"username='".mysql_real_escape_string($_POST['txtUser'])."'");
	//$result=mysql_query($query);
	
	if($result)
	{
		$data=mysql_fetch_assoc($result);
		if($data['username']==$_POST['txtUser'])
		{
			
			$userdata = $dbop->getSelectedRecord('user','*','usertype ="admin"');
			$adminEmailId = mysql_fetch_array($userdata);
		
			$from = $adminEmailId['emailid'];
			$to = $data['emailid'];			
			$subject = "Site.com - Account Detail.";
			
			$body="";
			$body .="Hi ,<br><br>";
			$body .="Your details are as the following. <br><br>";
			
			$body .="Username : ".$data['username']." <br>";
			$body .="Password : ".base64_decode($data['password'])." <br>";
			$body .="You can change your account details after login.<br><br><br>";
			$body .="Thank you,<br><br>";
			
			$headers = array ('From' => $from,
	     					  'To' => $to,
	      					  'Subject' => $subject,
							  'Content-type' => 'text/html; charset=iso-8859-1');
			
			if($mail->send($to, $headers, $body))
				$success = 'Password sent successfully to your Email Id.';
			
		}
		else
			$message = 'Email Id not found.';
	}
	else
		$message = 'Email Id not found.';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>FORGOT PASSWORD</title>
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
	
	if(usr=='')
	{
		document.getElementById('errordiv').innerHTML='Please enter Username.';	
		return false
	}
	

}

</script>
</head>
<body>
<div class="container_16"> <!--start--container_16-->
	<div class="grid_6 prefix_5 suffix_5"><!--start--grid_6 prefix_5 suffix_5-->
		<h1>Admin - FORGOT PASSWORD</h1>
		<div class="login"><!--start--login-->
		
		<form id="form1" action="" method="post" name="form1" onSubmit="return checkfrmBlankValidation();">
			<?php if(isset($message)) { ?>
			<div id="errordiv" style="font-size:15px; font-weight:bold;color: #ff0000;">
				<?php echo $message."<br/>"; ?>
			</div>
			<?php } ?>
			<?php if(isset($success)) { ?>
			<div id="errordiv" style="font-size:15px; font-weight:bold;color: #666666;">
				<?php echo $success."<br/>"; ?>
			</div>
			<?php } ?>
			<p>
				<label>
					<strong>Username</strong>
					<input id="txtUser" class="inputText" type="text" name="txtUser"  value="" />
				</label>
				
			</p>			
			
			<br />
            <div  style="width:270px;">
			
			<div  class="black_button">
				<input type="submit" name="btnsubmit" class="black_button_btn" value="SUBMIT" >
			</div>
			</div>
			
			
		</form>
		<br clear="all">
		
		</div><!--end--login-->
		<div id="forgot">
			<a class="forgotlink" href="login.php">
			<span>LOGIN</span>
			</a>
		</div>
		
	</div><!--end--grid_6 prefix_5 suffix_5-->
</div><!--end--container_16-->

</body>
</html>