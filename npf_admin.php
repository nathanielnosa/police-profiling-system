<?php
session_start();
ob_start();
include 'conn.php';
if(!(isset($_SESSION['npf_admin'])))
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
	<h2 style="color:white;">NPF</h2>
<i class="fa fa-user-circle-o" style="font-size:30px;"></i> <b>Welcome NPF Admin: <?= $_SESSION['npf_admin'];?></b>
<a href="logout.php" >
<button class="btn btn-primary" style="float:right;background-color:transparent"><i class="fa fa-sign-out"></i> Logout
</button>
</a><hr/>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<h4>NPF OFFICER REGISTRATION</h4>
			<?php
			error_reporting(0);
			$locQuery = mysqli_query($conn, "SELECT pol_stat_name FROM npf_admin WHERE admin_uname='".$_SESSION['npf_admin']."'");
			$numNpfQuery = mysqli_query($conn, "SELECT * FROM npf");
			 $numNpfRows = mysqli_num_rows($numNpfQuery);

			$loopQuery = mysqli_fetch_row($locQuery);
			$loopResult = $loopQuery[0];
			$new_loop_result = substr(strtoupper($loopResult),0,3);

			if (isset($_POST['off_level_btn'])) {
						
					$query = mysqli_query($conn, "SELECT * FROM npf WHERE access_uname='".$_POST['access_uname']."'");

					$rows = mysqli_num_rows($query);
					if($rows > 0){
						echo "<h3 align='center' style='color:red;'><i class='fa fa-exclamation-circle'></i> Officer with Access User Name already exists!</h3>";

					}else{
						 $pic_name = $_FILES['off_img']['name'];
						$pic_loc = $_FILES['off_img']['tmp_name'];
						$loc = 'uploads/'.$pic_name;
						move_uploaded_file($pic_loc, $loc);
					mysqli_query($conn, "INSERT INTO npf (pol_stat_name,off_fname,off_lname,pnum,email,addr,img,off_level,access_uname) VALUES ('".$_POST['stat_name']."','".$_POST['off_fname']."','".$_POST['off_lname']."','".$_POST['off_pnum']."','".$_POST['off_email']."','".$_POST['off_addr']."','$loc','".$_POST['off_level']."','".$_POST['access_uname']."')");

						echo "<h3 align='center' style='color:lightgreen;'><i class='fa fa-check-circle'></i> Officer has been added successfully!</h3>";
						//header('refresh:1; url=index.php');
					}
			}
			
			?>
			<h4>Choose An Officer Level To Regsiter</h4>
			<form method="GET" action="#"  style="border:none;">
			<select  class="form-control" name="off_level" style="background-color:#000;border-bottom:6px solid lightgreen;color:white;" required>
					<option class="form-control" selected="selected" value=""> -- Choose officer level --</option>
					<?php
					$c_type = mysqli_query($conn, "SELECT level_name FROM officer_level");
					while ($loop = mysqli_fetch_row($c_type)) {
						 $c = $loop[0];
						echo "<option class=\"form-control\" value=\"$c\">".$c."</option>";
					}

					

					?>					
				</select>
				<br/>
				<input type="submit" value="Select Officer" style="" class="btn btn-success"/>
			</form>
			<?php
			$s_name = mysqli_query($conn, "SELECT pol_stat_name FROM npf_admin");
					while ($loop = mysqli_fetch_row($s_name)) {
						 $s = $loop[0];
						
					}
				?>
			<hr/>
			<form method="POST" action="#" ENCTYPE="multipart/form-data" style="border:none;">
				<label>Officer's First Name: </label>
				<input type="text" class="form-control" name="off_fname" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Officer's Last Name: </label>
				<input type="text" class="form-control" name="off_lname" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Officer's Phone Number: </label>
				<input type="text" class="form-control" name="off_pnum" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Officer's Email: </label>
				<input type="text" class="form-control" name="off_email" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Officer's Address: </label>
				<textarea rows=2 class="form-control" name="off_addr" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"></textarea>

				<label>Officer's Photo: </label>
				<input type="file" class="form-control" name="off_img" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;height:100%;"/>

				<label>Officer's Access Username: </label>
				<input type="text" class="form-control" name="access_uname" value="<?=substr($_GET['off_level'],0,3).$new_loop_result."0".$numNpfRows;?>" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Officer's Level: </label>
				<input type="text" class="form-control" name="off_level" value="<?=$_GET['off_level'];?>" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Police Station Name: </label>
				<input type="text" class="form-control" name="stat_name" value="<?=$s;?>" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				
				<br/>
				<input type="submit" name="off_level_btn" value="Register Officer" style="" class="btn btn-success"/>
			</form>


		</div>
		<div class="col-lg-6">
			<h4>CRIME PROFILING FORM</h4>
			
			<?php
			if(isset($_POST['sub_pro'])){
				$query = mysqli_query($conn, "SELECT * FROM crime_profile WHERE crime_id='".$_POST['crimeId']."'");

					$rows = mysqli_num_rows($query);
					if($rows > 0){
						echo "<h3 align='center' style='color:red;'><i class='fa fa-exclamation-circle'></i> Crime profile already exists!</h3>";

					}else{
						 $pic_name = $_FILES['cImg']['name'];
						$pic_loc = $_FILES['cImg']['tmp_name'];
						$loc = 'uploads/'.$pic_name;
						move_uploaded_file($pic_loc, $loc);
					mysqli_query($conn, "INSERT INTO crime_profile (crime_id,criminal_fname,crime_type,criminal_photo,criminal_status,court_name) VALUES ('".$_POST['crimeId']."','".$_POST['cFname']."','".$_POST['cType']."','$loc','".$_POST['cStatus']."','".$_POST['coName']."')");

						echo "<h3 align='center' style='color:lightgreen;'><i class='fa fa-check-circle'></i> Crime profile has been saved successfully!</h3>";
						//header('refresh:1; url=index.php');
					}
			}
			?>
			<form method="POST" action="#" ENCTYPE="multipart/form-data" style="border:none;">
				<label>Criminal's ID: </label>
				<input type="text" class="form-control" name="crimeId" value="<?php $text = '12345678900987654321'; echo "CRM-".substr(str_shuffle($text),0, 5);?>" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>
				<br/>
				<label>Criminal's Full Name: </label>
				<input type="text" class="form-control" name="cFname" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>
				<br/>
				<label>Crime Type: </label>
				
				<select  class="form-control" name="cType" style="background-color:#000;border-bottom:6px solid lightgreen;color:white;" required>
					<option class="form-control" selected="selected" value=""> -- Choose Crime Type --</option>
					<?php
					$c_type = mysqli_query($conn, "SELECT crime_name FROM crime_type ORDER BY crime_name");
					while ($loop = mysqli_fetch_row($c_type)) {
						 $c = $loop[0];
						echo "<option class=\"form-control\" value=\"$c\">".$c."</option>";
					}

					?>

					
				</select>
				<br/>
				<label>Court Name: </label>
				
				<select  class="form-control" name="coName" style="background-color:#000;border-bottom:6px solid lightgreen;color:white;" required>
					<option class="form-control" selected="selected" value=""> -- Choose Court --</option>
					<?php
					$c_type = mysqli_query($conn, "SELECT co_name FROM court ORDER BY co_name");
					while ($loop = mysqli_fetch_row($c_type)) {
						 $c = $loop[0];
						echo "<option class=\"form-control\" value=\"$c\">".$c."</option>";
					}

					?>

					
				</select>
				<br/>
				<label>Criminal Status: </label>
				<select  class="form-control" name="cStatus" style="background-color:#000;border-bottom:6px solid lightgreen;color:white;" required>
					<option class="form-control"  value="Allerged">Allerged</option>
					<option class="form-control"  value="Discharged">Discharged</option>

					<option class="form-control"  value="Convicted">Convicted</option>
					<option class="form-control" value="Community Service">Community Service</option>
					<option class="form-control"  value="House Arrest">House Arrest</option>
					<option class="form-control" value="Death Sentence">Death Sentence</option>
				</select>
				<br/>

				<label>Criminal's Photo: </label>
				<input type="file" class="form-control" name="cImg" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;height:100%;"/>

				

				
				<br/>
				<input type="submit" name="sub_pro" value="Save Crime Profile" style="" class="btn btn-success"/>
			</form>

		</div>
	</div>
</div>

<hr/>
Nathaniel Nosa | Police Profiling &copy; 2019
</div><!-- end of container -->

</body>
</html>