<?php
session_start();
ob_start();
include 'conn.php';
if(!(isset($_SESSION['ig'])))	
{
	header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
	table tr:nth-child(even){
		
		background: #444;
	}
</style>
	</head>
<body>
	
 
<!-- beginning of nav -->
	<nav class="navbar navbar-inverse navbar-fixed-top" style="padding:1%;background-color:#000;border-bottom:5px solid lightgreen;">
		<div style="float:left;height:50px;width:15px;border:1px solid lightgreen;background-color:lightgreen"></div>
		<div style="float:left;height:50px;width:15px;border:1px solid white;background-color:white"></div> 
		<div style="float:left;height:50px;width:15px;border:1px solid lightgreen;background-color:lightgreen"></div> 

		<h3 style="margin-left:5%;">POLICE JUDICIARY AND CIVILIAN PROFILING MANAGEMENT SYSTEM</h3>
	</nav>
<!-- end of nav -->
<!-- beginning of container -->

<div class="container" style="padding-top:0px;margin-top:10%;background-image:url('img/px2.png');border:0px groove lightgreen;">
	<h2 style="color:white;">INSPECTOR GENERAL</h2>
<i class="fa fa-user-circle-o" style="font-size:30px;"></i> <b>Welcome: <?php echo strtoupper($_SESSION['ig']);?></b>
<a href="logout.php" >
<button class="btn btn-primary" style="float:right;background-color:transparent"><i class="fa fa-sign-out"></i> Logout
</button>
</a><hr/>
<div class="container-fluid">
	<div class="row">
		
		<div align="center" class="col-lg-3" style="padding-top:2%;">
			
			<h3 >CRIME TYPE</h3>
			<a href="?crime_type" >

			<div id="hover"  style="border:1px solid #fff;padding-top:15%;background-image:url('img/bg4.jpg');background-position:left;border-radius:150px; height:150px; width:150px;">
				
			<i class="fa fa-user"  style="font-size:70px;"></i> <br/>
			<?php
			$count = mysqli_query($conn, "SELECT * FROM crime_type");

			$rows = mysqli_num_rows($count);
			echo "<b style='color:white;'>(".$rows.")</b>";
			?>
			
			
			</div>
			</a>
			<h3 >OFFICER LEVEL</h3>
			<a href="?off_level" >
			<div id="hover"  style="border:1px solid #fff;padding-top:15%;background-image:url('img/bg4.jpg');background-position:left;border-radius:150px; height:150px; width:150px;">
				
			<i class="fa fa-star" style="font-size:70px;"></i>
			 <br/>
			<?php
			$off_count = mysqli_query($conn, "SELECT * FROM officer_level");

			$rowsCount = mysqli_num_rows($off_count);
			echo "<b style='color:white;'>(".$rowsCount.")</b>";
			?>
			
			</div>
			</a>
		</div>
		<div  align="center" class="col-lg-3" style="padding-top:2%;">
			<h3 >COURT</h3>
			<a href="?court" >
			<div id="hover" style="border:1px solid #fff;padding-top:15%;background-image:url('img/bg4.jpg');background-position:left;border-radius:150px; height:150px; width:150px;">
				
			<i class="fa fa-graduation-cap" style="font-size:70px;"></i>
			
			</div>
			</a>
			<h3 >NPF</h3>
			<a href="?npf" >
			<div id="hover"  style="border:1px solid #fff;padding-top:15%;background-image:url('img/bg4.jpg');background-position:left;border-radius:150px; height:150px; width:150px;">
				
			<i class="fa fa-users" style="font-size:70px;"></i>
			
			</div>
		</a>
				
			
		</div>
	
		<div class="col-lg-6" style="height:400px ; overflow:auto; 	">
			
			
			
			<?php
			if (isset($_GET['crime_type'])) {
				
			
			?>
			<div id="crime_type" style="margin-top:2%;">
			<h4 align="center">CRIME TYPE REGISTRATION</h4>
			<form method="POST" action="#" style="border:none;">
				<label>Crime Name: </label>
				<input type="text" class="form-control" name="crime_name" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>
				<br/>
				
				<input type="submit" name="crime_type" value="Register Crime Type" style="width:100%;" class="btn btn-success"/>
			</form>
			<?php
			if (isset($_POST['crime_type'])) {
						$crime_name = $_POST['crime_name'];
					$query = mysqli_query($conn, "SELECT * FROM crime_type WHERE crime_name='$crime_name'");

					$rows = mysqli_num_rows($query);
					if($rows > 0){
						echo "<h3 align='center' style='color:red;'><i class='fa fa-exclamation-circle'></i> Crime name already exists!</h3>";

					}else{
						  $new_crime_name = strtoupper($crime_name);
					mysqli_query($conn, "INSERT INTO crime_type (crime_name) VALUES ('$new_crime_name')");
						echo "<h3 align='center' style='color:lightgreen;'><i class='fa fa-check-circle'></i> Crime name added successfully!</h3>";
					}
			}
			

			?><br/>
			<?php

			$countViewCrime = mysqli_query($conn, "SELECT * FROM crime_type ORDER BY crime_name");

			if(mysqli_num_rows($countViewCrime) > 0){
				echo "<table class='table'>";
				echo "<tr><th>S/N</th><th>Crime Name</th></tr>";
				$sn = 0;
				while ($loopViewCrime = mysqli_fetch_array($countViewCrime)) {

					$sn = $sn +1;

					echo "<tr><td>$sn</td><td>".$loopViewCrime['crime_name']."<td></tr>";
				}
				echo "</table>";
			}else{
				echo "<div class='alert alert-danger'>No crime type uploaded</div>";
			}


			?>
			</div>
			<?php
			}elseif (isset($_GET['off_level'])) {
			?>


			<div id="off_level" style="margin-top:20%;">
			<h4 align="center">OFFICER LEVEL REGISTRATION</h4>
			<form method="POST" action="#" style="border:none;">
				<label>Officer Level: </label>
				<input type="text" class="form-control" name="off_level" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>
				<br/>
				
				<input type="submit" value="Register Officer Level" style="width:100%;" class="btn btn-success"/>
			</form>
			<?php
			if (isset($_POST['off_level'])) {
				$off_level = $_POST['off_level'];
			$query = mysqli_query($conn, "SELECT * FROM officer_level WHERE level_name='$off_level'");

			$rows = mysqli_num_rows($query);
			if($rows > 0){
				echo "<h3 align='center' style='color:red;'><i class='fa fa-exclamation-circle'></i> Officer level already exists!</h3>";

			}else{
				  $new_lev_name = strtoupper($off_level);
			mysqli_query($conn, "INSERT INTO officer_level (level_name) VALUES ('$new_lev_name')");
				echo "<h3 align='center' style='color:lightgreen;'><i class='fa fa-check-circle'></i> Officer level added successfully!</h3>";
			}
			}
			

			?>
			</div>
			<?php
			}elseif (isset($_GET['npf'])) {
			
			?>

			<div id="npf" >
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

				<input type="submit" name="pol_stat" value="Register Police Station" style="" class="btn btn-success"/>
			</form>
			<?php

			if (isset($_POST['pol_stat'])) {
						$npf_name = $_POST['npf_name'];
						$npf_loc = $_POST['npf_loc'];
						$npf_ad_uname = $_POST['npf_ad_uname'];
						$npf_ad_pwd = $_POST['npf_ad_pwd'];
						$npf_addr = $_POST['npf_addr'];
					$query = mysqli_query($conn, "SELECT * FROM npf_admin WHERE admin_uname='$npf_ad_uname' || pol_stat_name='$npf_name' && stat_loc='$npf_loc'");

					 $rows = mysqli_num_rows($query);
					if($rows > 0){
						echo "<h3 align='center' style='color:red;'><i class='fa fa-exclamation-circle'></i> Username or Police Station Name already exists!</h3>";

					}else{
					mysqli_query($conn, "INSERT INTO npf_admin (pol_stat_name,stat_loc,admin_uname,admin_pwd,stat_addr) VALUES ('$npf_name','$npf_loc','$npf_ad_uname','$npf_ad_pwd','$npf_addr')");
						echo "<h3 align='center' style='color:lightgreen;'><i class='fa fa-check-circle'></i> Username And Police Station Name added successfully!</h3>";
					}
			}
			

			?>
			</div>
			<?php
			}elseif (isset($_GET['court'])) {
			?>
			<div id="court" >
			<h4>COURT REGISTRATION</h4>
			<form method="POST" action="#" >
				<label>Court Name: </label>
				<input type="text" class="form-control" name="co_name" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Crime Type Handled: </label>
				
				<select  class="form-control" name="co_crm_hand" style="background-color:#000;border-bottom:6px solid lightgreen;color:white;" required>
					<option class="form-control" selected="selected" value=""> -- Choose crime handled --</option>
					<?php
					$c_type = mysqli_query($conn, "SELECT crime_name FROM crime_type ORDER BY crime_name");
					while ($loop = mysqli_fetch_row($c_type)) {
						 $c = $loop[0];
						echo "<option class=\"form-control\" value=\"$c\">".$c."</option>";
					}

					?>

					
				</select>

				


				<label>Court Admin Username: </label>
				<input type="text" class="form-control" name="co_ad_uname" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>


				<label>Court Admin Password: </label>
				<input type="text" class="form-control" name="co_ad_pwd" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Court Address: </label>
				<textarea rows=5 class="form-control" name="co_addr" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"></textarea><br/>

				<input type="submit" name="court_reg" value="Register Court" style="" class="btn btn-success"/>
			</form>
			<?php
			if (isset($_POST['court_reg'])) {
						$co_name = $_POST['co_name'];
						$co_crm_hand = $_POST['co_crm_hand'];
						$co_ad_uname = $_POST['co_ad_uname'];
						$co_ad_pwd = $_POST['co_ad_pwd'];
						$co_addr = $_POST['co_addr'];
					$query = mysqli_query($conn, "SELECT * FROM court WHERE co_crm_hand='".$_POST['co_crm_hand']."' && co_name='$co_name' || co_ad_uname='$co_ad_uname'");

					$rows = mysqli_num_rows($query);
					if($rows > 0){
						echo "<h3 align='center' style='color:red;'><i class='fa fa-exclamation-circle'></i> Username or Police Station Name already exists!</h3>";

					}else{
					mysqli_query($conn, "INSERT INTO court (co_name,co_crm_hand,co_ad_uname,co_ad_pwd,co_addr) VALUES ('$co_name','$co_crm_hand','$co_ad_uname','$co_ad_pwd','$co_addr')");
						echo "<h3 align='center' style='color:lightgreen;'><i class='fa fa-check-circle'></i> Username And Police Station Name added successfully!</h3>";
					}
			}
			
			?>
			</div>

			<?php
			}else {
			?>
			<div id="rss" >
			<h3 align="center">RSS FEED</h3>
			<ul style="font-size:16px;">
				<li> Nigerian Student emerge winner at the math competition</li>
				<li> Nigerian Student emerge winner at the math competition</li>
				<li> Nigerian Student emerge winner at the math competition</li>
				<li> Nigerian Student emerge winner at the math competition</li>
				<li> Nigerian Student emerge winner at the math competition</li>
				<li> Nigerian Student emerge winner at the math competition</li>
				<li> Nigerian Student emerge winner at the math competition</li>
				<li> Nigerian Student emerge winner at the math competition</li>
				<li> Nigerian Student emerge winner at the math competition</li>

				<table class="table">
					<tr><td>Name</td><td>Age</td></tr>
					<tr><td>Bola</td><td>12</td></tr>
					<tr><td>Sade</td><td>20</td></tr>
					<tr><td>Temi</td><td>25</td></tr>
					<tr><td>Jane</td><td>40</td></tr>
					<tr><td>Adealu</td><td>25</td></tr>
				</table>
			</ul>
			</div>

			<?php
			}
			?>


		</div>
		
		

	</div>
</div>

<hr/>
Nathaniel Nosa | Police Profiling &copy; 2019
</div><!-- end of container -->

</body>
</html>