<?php
session_start();
ob_start();
include 'conn.php';
if(!(isset($_SESSION['court_admin'])))
{
	header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Police Profiling - Index page</title>
		<link rel="stylesheet" type="text/css" href="css/font4.7/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="css/css.css">
		<link rel="short icon" href="img/icon.jpg" />
		<style type="text/css">
		body {
			background-color: #1f1b30;
			color:white;
		}
		img {
	    border: 1px solid #ddd; /* Gray border */
	    border-radius: 4px;  /* Rounded border */
	    padding: 5px; /* Some padding */
	    width: 150px; /* Set a small width */
	    height: 150px;
	    margin:1%;
	}

	/* Add a hover effect (blue shadow) */
	img:hover {
	    box-shadow: 0 0 2px 5px lightgreen;
	}
	
	i{
		cursor: pointer;
	}

	#hover:hover{

		box-shadow: 0 0 2px 5px lightgreen;
	}
		i:hover {
	    color: lightgreen;

	}
	
</style>
	</head>
<body>
	
 
<!-- beginning of nav -->
	<nav class="navbar navbar-inverse navbar-fixed-top" style="padding:1%;background-color:#000;border-bottom:5px solid lightgreen;height:100px;">
		<div style="float:left;height:50px;width:15px;border:1px solid lightgreen;background-color:lightgreen"></div>
		<div style="float:left;height:50px;width:15px;border:1px solid white;background-color:white"></div> 
		<div style="float:left;height:50px;width:15px;border:1px solid lightgreen;background-color:lightgreen"></div> 

		<h3 style="margin-left:5%;">POLICE JUDICIARY AND CIVILIAN PROFILING MANAGEMENT SYSTEM</h3>
	</nav>
<!-- end of nav -->
<!-- beginning of container -->

<div class="container" style="padding-top:0px;margin-top:10%;background-image:url('img/px2.png');border:0px groove lightgreen;">
<i class="fa fa-user-circle-o" style="font-size:30px;"></i> <b>Welcome: IG</b>

<div class="container-fluid">
	<div class="row">
		
		<div align="center" class="col-lg-3" style="padding-top:2%">
			
			<h3 >SETTINGS</h3>
			<div id="hover" style="border:1px solid #fff;padding-top:15%;background-image:url('img/bg4.jpg');background-position:left;border-radius:150px; height:150px; width:150px;">
				
			<i class="fa fa-gears" style="font-size:70px;"></i>
			
			</div>
			
			<h3 >LOG OUT</h3>
			<div id="hover" style="border:1px solid #fff;padding-top:15%;background-image:url('img/bg4.jpg');background-position:left;border-radius:150px; height:150px; width:150px;">
				
			<i class="fa fa-power-off" style="font-size:70px;"></i>
			
			</div>
			
		</div>
		<div  align="center" class="col-lg-3" style="">
			
				<h3 >COURT</h3>
			<img src="img/ht1.jpg" onclick="document.getElementById('court').style.display='block';document.getElementById('bg').style.display='none';document.getElementById('npf').style.display='none'" class="img-circle" />
			<h3 >NPF</h3>
			<img src="img/ht6.jpg" onclick="document.getElementById('npf').style.display='block';document.getElementById('bg').style.display='none';document.getElementById('court').style.display='none'" class="img-circle" />
			
			
		</div>
	
		<div class="col-lg-6">
			<div id="bg" style="background-image:url('img/construt3.png');background-size:cover;height:450px;margin-top:10%;"></div>
			<div id="court" style="display:none;">
			<h4>COURT REGISTRATION</h4>
			<form method="POST" action="#" style="border:none;">
				<label>Court Name: </label>
				<input type="text" class="form-control" name="co_name" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Crime Type Handled: </label>
				<input type="text" class="form-control" name="co_crm_hand" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>


				<label>Court Admin Username: </label>
				<input type="text" class="form-control" name="co_ad_uname" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>


				<label>Court Admin Password: </label>
				<input type="text" class="form-control" name="co_ad_pwd" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Court Address: </label>
				<textarea rows=5 class="form-control" name="co_addr" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"></textarea><br/>

				<input type="submit" value="Register Court" style="" class="btn btn-success"/>
			</form>
			</div>
			<div id="npf" style="display:none;">
			<h4>POLICE STATION REGISTRATION</h4>
			<form method="POST" action="#" style="border:none;">
				<label>Police Station Name: </label>
				<input type="text" class="form-control" name="npf_name" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Police Station Location: </label>
				<input type="text" class="form-control" name="npf_loc" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>


				<label>NPF Admin Username: </label>
				<input type="text" class="form-control" name="npf_ad_uname" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>


				<label>NPF Admin Password: </label>
				<input type="text" class="form-control" name="npf_ad_pwd" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Police Station Address: </label>
				<textarea rows=5 class="form-control" name="npf_addr" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"></textarea><br/>

				<input type="submit" value="Register Police Station" style="" class="btn btn-success"/>
			</form>
			</div>

		</div>
		
		

	</div>
</div>

<hr/>
Nathaniel Nosa | Police Profiling &copy; 2019
</div><!-- end of container -->

</body>
</html>