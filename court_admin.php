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
	<h2 style="color:white;">COURT</h2>
<i class="fa fa-user-circle-o" style="font-size:30px;"></i> <b>Welcome Court Admin: <?= $_SESSION['court_admin'];?></b>
<a href="logout.php" >
<button class="btn btn-primary" style="float:right;background-color:transparent"><i class="fa fa-sign-out"></i> Logout
</button>
</a><hr/>
<div class="container-fluid">
	<div class="row">
<?php
			$getCourtname= mysqli_query($conn, "SELECT * FROM court WHERE co_ad_uname='".$_SESSION['court_admin']."'");
			$loopCourtName = mysqli_fetch_assoc($getCourtname);
			echo "<b>COURT NAME: </b>".$CourName =  $loopCourtName['co_name'];
			$queryNum = mysqli_query($conn, "SELECT * FROM crime_profile WHERE court_name='$CourName'");
			$numCase = mysqli_num_rows($queryNum);
			echo "<br/><br/><b>COURT CASES: (".$numCase.")";
			echo "<hr/>";
?>
		<div class="col-lg-10">			
			
			<?php
			$query = mysqli_query($conn, "SELECT * FROM crime_profile WHERE court_name='$CourName'");
			if (mysqli_num_rows($query) < 1) {

				echo "<h3  style='color:red;'><i class='fa fa-exclamation-circle'></i> No crime profile recorded!</h3>";
			}else{
				echo '<h4>CRIME PROFILE LIST</h4>	';
				echo "<table class='table'>";
				echo "<thead><tr><th>PHOTO</th><th>CRIME ID</th><th>CRIMINAL FULL NAME</th><th>CRIME TYPE</th><th>CRIMINAL STATUS</th></tr></thead>";
				while ($loop = mysqli_fetch_assoc($query)) {
						 $cId = $loop['crime_id'];$cFname = $loop['criminal_fname'];
						 $cType = $loop['crime_type'];$cName = $loop['court_name'];
						 $cStats = $loop['criminal_status'];$img = $loop['criminal_photo'];

					echo "<tbody><tr><td><img src='$img' /></td><td>$cId</td><td>$cFname</td><td>$cType</td><td>$cStats</td><td></td></tr></tbody>";
				}
				echo "</table>";
			}



			?>
		</div>
		<div class="col-lg-6">			
			

		</div>
		
		

	</div>
</div>

<hr/>
Nathaniel Nosa | Police Profiling &copy; 2019
</div><!-- end of container -->

</body>
</html>