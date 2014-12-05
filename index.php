<?php
	include('include/config.php');
	include('chksession.php');
	include('include/dbop.class.php');
	include('include/ps_pagination.php');
	$dbop = new dbop();
	global $arrGoogleApiString;
	global $arrSeomozApiString ;	

?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Extreme Local SEO Admin - Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/960.css" />
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/text.css" />
	<link rel="stylesheet" type="text/css" href="css/blue.css" />
	<link type="text/css" href="css/ui.css" rel="stylesheet" />  
	<script type="text/javascript" src="javascript/jquery.min.js"></script>
	<script type="text/javascript" src="javascript/jquery.js"></script>
	
	<script type="text/javascript" src="javascript/jquery.blend.js"></script>
	<script type="text/javascript" src="javascript/ui.core.js"></script>
	<script type="text/javascript" src="javascript/ui.sortable.js"></script>    
	<script type="text/javascript" src="javascript/ui.dialog.js"></script>
	<script type="text/javascript" src="javascript/ui.datepicker.js"></script>
	<script type="text/javascript" src="javascript/effects.js"></script>
		
	<script type="text/javascript" src="javascript/jquery.flot.pack.js"></script>
	
	<?php 
		//   Create Curent  Month  Ticket Label 
		$curMonYear  = date('Y-m');
		$getApiDetail = $dbop->getSelectedRecord('client_api',' SUM(googlemap_api) as google ,SUM(seomoz_api) as seomoz,used_date  '," used_date LIKE '%".$curMonYear."%' GROUP BY used_date");
		$arrGoogleApiString = '';
		$arrSeomozApiString = '';
		$count =  0;
		date_default_timezone_set('UTC');

		while($rowApi  =  mysql_fetch_assoc($getApiDetail)){
			$arrGoogleApiString  .=  ((strtotime($rowApi['used_date']) * 1000)).','.$rowApi["google"].',';
			$arrSeomozApiString  .=  ((strtotime($rowApi['used_date']) * 1000)).','.$rowApi["seomoz"].',';
			
		}
		if($arrGoogleApiString  !=  ''  &&  $arrSeomozApiString != ''){
			$arrGoogleApiString =  substr_replace($arrGoogleApiString,'',-1); 
			$arrSeomozApiString = substr_replace($arrSeomozApiString,'',-1); 
		}
		
	?>
	<script type="text/javascript" language="javascript" src="javascript/graphs.js" ></script>	
	
	<!--[if IE]><script type="text/javascript" src="javascript/excanvas.js"></script><![endif]-->

	<style type="text/css">
		.ui-datepicker {
			padding: 0px !important;
			width:auto !important;
		}
	</style>

</head>

<body>
<!-- WRAPPER START -->
<div class="container_16" id="wrapper">	
		
        	<!--LOGO-->
	<div class="grid_8" id="logo">Admin - Website Administration</div>
    <div class="grid_8">
		<!-- USER TOOLS START -->
		  <div id="user_tools">
			  <span>
			  Welcome <a href="#"><?php echo $_SESSION['Admin_name']; ?></a> 
			  | <a href="logout.php">Logout</a>
			  </span>
		  </div><!-- USER TOOLS END --> 
    </div>
	<!-- HEADER START -->
	<div class="grid_16" id="header">
	<!-- MENU START -->
	<div id="menu">
		<ul class="group" id="menu_group_main">
			<li class="item first" id="one">
				<a href="#" class="main current">
					<span class="outer"><span class="inner dashboard">Dashboard</span></span>
				</a>
			</li>
			<li class="item middle" id="two">
				<a href="subscriptions.php" class="main" >
					<span class="outer"><span class="inner content">Subscriptions</span></span>
				</a>
			</li>
			<li class="item middle" id="three">
				<a href="reports.php" class="main">
					<span class="outer"><span class="inner reports">Reports</span></span>
				</a>
			</li>
			<li class="item middle" id="three">
				<a href="users.php" class="main">
				<span class="outer"><span class="inner users">Users</span></span></a>
			</li>
			<li class="item last" id="four">
				<a href="settings.php" class="main">
					<span class="outer"><span class="inner settings">Settings</span></span>
				</a>
			</li>   
		</ul>
	</div><!-- MENU END -->
	</div>
	<!-- HEADER END -->
	<div class="grid_16">
	<!-- TABS START -->
		<div id="tabs">
			 <div class="container">
				<ul>
					  <li><a href="index.php" class="current"><span>Dashboard elements</span></a></li>
			   </ul>
			 </div>
		</div><!-- TABS END -->    
	</div>
	<!-- CONTENT START -->
	<div class="grid_16" id="content">
		<!--  TITLE START  --> 
		<div class="grid_9">
			<h1 class="dashboard">Dashboard</h1>
            <h3 style="text-align:right"><?php if(isset($_REQUEST['msg'])) echo base64_decode($_REQUEST['msg']); ?></h3>
		</div>    <!--  TITLE END  --> 
		<!--RIGHT TEXT/CALENDAR-->
		<div class="grid_6" id="eventbox">
			<a class="inline_calendar">Calendar</a>
			<div class="hidden_calendar"></div>
		</div><!--RIGHT TEXT/CALENDAR END-->
		<div class="clear"></div>
    	<!-- #PORTLETS START -->
		<div id="portlets">
	    	<!-- FIRST SORTABLE COLUMN START -->
			<div class="column ui-sortable" id="left" unselectable="on" style="-moz-user-select: none;">
				<!--THIS IS A PORTLET-1 START-->
				<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
				   <div class="portlet-header ui-widget-header ui-corner-top">
						<img src="images/icons/chart_bar.gif" width="16" height="16" alt="Reports" /> Google Maps Place API - Last 30 days
					</div>
					<div class="portlet-content">
					    <!--THIS IS A PLACEHOLDER START FOR FLOT - Report & Graphs -->
					   <div id="placeholder1" style="width:auto; height:250px;  position: relative;">
							<canvas width="429" height="250"></canvas>
							<canvas width="429" height="250" style="position: absolute; left: 0px; top: 0px;"></canvas>
					
							<div style="font-size:smaller;color:#545454" class="tickLabels">
							
							</div>
					   </div> <!-- PLACEHOLDER END FOR FLOT - Report & Graphs -->
					</div>
				</div>
		    </div> <!-- FIRST SORTABLE COLUMN END -->
		    <!-- SECOND SORTABLE COLUMN START -->
		    <div class="column">
		      <!--THIS IS A PORTLET-1 START-->        
		      <!--THIS IS A PORTLET-2 START-->
			 	<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
					   <div class="portlet-header ui-widget-header ui-corner-top">
							<img src="images/icons/chart_bar.gif" width="16" height="16" alt="Reports" /> SEOMoz API - Last 30 days
						</div>
		         <div class="portlet-content">
		            <!--THIS IS A PLACEHOLDER START FOR FLOT - Report & Graphs -->
				   <div id="placeholder2" style="width:auto; height:250px;  position: relative;">
						<canvas width="429" height="250"></canvas>
						<canvas width="429" height="250" style="position: absolute; left: 0px; top: 0px;"></canvas>
						<div style="font-size:smaller;color:#545454" class="tickLabels">
						
						</div>
				   </div> <!-- PLACEHOLDER END FOR FLOT - Report & Graphs -->
		         </div>
		        </div><!--THIS IS A PORTLET-2 END-->
		    </div><!--  SECOND SORTABLE COLUMN END -->
		    <div class="clear"></div>
		    <!--THIS IS A WIDE PORTLET START-->

	    	<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
	        	<div class="portlet-header fixed ui-widget-header ui-corner-top">
					<img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />
					Last Registered users
				</div> <!--START--textcontent-->
				
				<div class="portlet-content nopadding">
					<form action="" method="post">
					  <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
						<thead>
						  <tr>
							<th width="34" scope="col"><input type="checkbox" name="allbox" id="allbox" onClick="checkAll()" /></th>
							<th width="136" scope="col">Name</th>
							<th width="102" scope="col">Username</th>
							<th width="109" scope="col">Date</th>
							<th width="129" scope="col">Location</th>
							<!--<th width="171" scope="col">E-mail</th>-->
							<th width="123" scope="col">Phone</th>
							<th width="90" scope="col">Actions</th>
						  </tr>
						</thead>
						<tbody>
                        
						  <tr>
                        			  <?php
						   $pageObj = new PS_Pagination('client','*','user_status="Active"',20,5,'user_status=Active');
						   $pageObj->setDebug(true);                                   
						   $rs = $pageObj->paginate();  
					  
						  	if(!empty($rs)){
							   $lTotalRow = mysql_num_rows($rs);
								  if($lTotalRow > 0){
										for($liCounter=0;$liCounter<$lTotalRow;$liCounter++) 
										{
											$dataRow=mysql_fetch_array($rs);
											
											
											echo '<td width="34"><label><input type="checkbox" name="checkbox" id="checkbox" />
											<input type="hidden" name="userid" value="'.$dataRow['client_id'].'"></label></td>';
											echo '<td>'.$dataRow['name'].'</td>';
											echo '<td>'.$dataRow['username'].'</td>';
											echo '<td>'.$dataRow['register_on'].'</td>';
											echo '<td>'.$dataRow['city'].'</td>';
											/*echo '<td>'.$dataRow['email_id'].'</td>';*/
											echo '<td>'.$dataRow['phone'].'</td>';
											echo '<td width="90">
												<a href="users.php?act='.$dataRow['client_id'].'" class="approve_icon" title="Activate"></a>
												<a href="users.php?deact='.$dataRow['client_id'].'" class="reject_icon" title="Deactivate"></a>
												<a href="edituser.php?edit='.$dataRow['client_id'].'" class="edit_icon" title="Edit"></a>
												<a href="users.php?del='.$dataRow['client_id'].'" class="delete_icon" title="Delete"></a>
											</td>';
										
										}
								  }
							}
						  ?>
						  </tr>
						  <tr class="footer">
							<td colspan="4">
								<!--<a href="#" class="edit_inline">Edit all</a>-->
								<a href="users.php?delall=deleteAll" class="delete_inline">Delete all</a>
								<a href="users.php?actall=activeAll" class="approve_inline">Activate all</a>
								<a href="users.php?deactall=deactiveAll" class="reject_inline">Deactivate all</a>
							</td>
							<td align="right">&nbsp;</td>
							<td colspan="3" align="right">
								<!--  PAGINATION START  -->             
								 <div class="pagination" style="float:right;width:200px;" ><?php if(isset($pageObj)) echo $pageObj->renderFullNav(); ?></div>
							</td>
						  </tr>
						</tbody>
					  </table>
					</form>
				</div>
				<div class="clear"></div>				
			</div><!--THIS IS A WIDE PORTLET END-->

   		</div><!--  END #PORTLETS --> 
    	<div class="clear"> </div>
	</div><!-- END CONTENT-->  
	<div class="clear"> </div>
		<!-- This contains the hidden content for modal box calls  COMES WHEN U CLICK ON MAIL ICON-->
	<div class='hidden'>
		<div id="inline_example1" title="This is a modal box" style='padding:10px; background:#fff;'>
			<p><strong>This content comes from a hidden element on this page.</strong></p>
			<p><strong>Try testing yourself!</strong></p>
			<p>You can call as many dialogs you want with jQuery UI.</p>
		</div>
	</div>
</div><!-- WRAPPER END -->

<!-- FOOTER START -->
<div class="container_16" id="footer">
<input type="hidden" name="googleapi" id="googleapi" value="<?php echo $arrGoogleApiString;?>" /> 
<input type="hidden" name="seomozapi" id="seomozapi" value="<?php echo $arrSeomozApiString;?>"/>
</div>
<!-- FOOTER END -->
</body>
</html>
