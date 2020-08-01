<?php
session_start();
ob_start();
include 'conn.php';
if(!(isset($_SESSION['ser'])))
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
<h2 style="color:white;">SERGENT</h2>
<i class="fa fa-user-circle-o" style="font-size:30px;"></i> <b>Welcome Sergent: <?php echo strtoupper($_SESSION['ser']);?></b>
<a href="logout.php" >
<button class="btn btn-primary" style="float:right;background-color:transparent"><i class="fa fa-sign-out"></i> Logout
</button>
</a><hr/>

<div class="container-fluid">
	<div class="row">
	<div class="col-lg-12">
		<h4>FIRST INFORMATION REPORT</h4>
		<?php
		$query	= mysqli_query($conn, "SELECT * FROM fir");
		if (mysqli_num_rows($query) < 1) {
			echo "<div class='alert alert-danger'>No compliant records</div>";
		}else{
			echo "<table class='table'>";
			echo "<thead><tr><th>S/N</th><th>Victim Name</th><th>Information About Victim</th><th>Crime Type</th><th>Complainant Name</th><th>Complainant Address</th><th></th></tr></thead>";
			$sn = 0;
			while ($loop = mysqli_fetch_array($query)) {
				$sn = $sn +1;
				echo "<tr><td>$sn</td><td>".$loop['vic_name']."</td><td>".$loop['com']."</td><td>".$loop['com_type']."</td><td>".$loop['com_fname']."</td><td>".$loop['com_addr']."</td><td><a href='?respond'><button class='btn btn-success'>Respond</button></a></td></tr>";
			}
			echo "</table>";
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