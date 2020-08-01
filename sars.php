<?php
session_start();
ob_start();
include 'conn.php';
if(!(isset($_SESSION['sars'])))
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
<h2 style="color:white;">SARS</h2>
<i class="fa fa-user-circle-o" style="font-size:30px;"></i> <b>Welcome Sars Officer: <?php echo strtoupper($_SESSION['sars']);?></b>
<a href="logout.php" >
<button class="btn btn-primary" style="float:right;background-color:transparent"><i class="fa fa-sign-out"></i> Logout
</button>
</a><hr/>

<div class="container-fluid">
	<div class="row">
	<div class="col-lg-6">
		<h4 align="center">MOST WANTED PERSONS REGISTRATION</h4>

		<?php

		if (isset($_POST['most'])) {
			$pname = $_FILES['img']['name'];
			$temploc = $_FILES['img']['tmp_name'];
			$loc = "uploads/".$pname;
			move_uploaded_file($temploc, $loc);
			mysqli_query($conn, "INSERT INTO most_wanted (fname, loc_last_seen, img, eye_color, hair_color, height, time_last_seen, age, gender, crime_commited) VALUES ('".$_POST['fname']."', '".$_POST['loc']."', '$loc','".$_POST['eye']."', '".$_POST['hair']."', '".$_POST['height']."', '".$_POST['tym']."', '".$_POST['age']."', '".$_POST['gender']."', '".$_POST['crime']."')");

			echo "<script>alert('Most wanted person\'s profile uploaded successfully!'); window.location = 'sars.php'</script>";
		}

		?>
			<form method="POST" action="#" style="border:none;" enctype="multipart/form-data">
				<label>Full Name: </label>
				<input type="text" class="form-control" name="fname" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Location Last Seen: </label>
				<input type="text" class="form-control" name="loc" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Time Last Seen: </label>
				<input type="text" class="form-control" name="tym" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>


				<label>Eye Color: </label>
				<input type="text" class="form-control" name="eye" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Hair Color: </label>
				<input type="text" class="form-control" name="hair" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>


				<label>Height: </label>
				<input type="text" class="form-control" name="height" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Age: </label>
				<input type="text" class="form-control" name="age" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Photo: </label>
				<input type="file" class="form-control" name="img" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Gender: </label>
				<select name="gender" class="form-control" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;">
				<option selected="selected" value="" class="form-control">-- CHOOSE GENDER --</option>
				<option class="form-control" value="MALE">MALE</option>
				<option class="form-control" value="FEMALE">FEMALE</option>
				</select>

				<label>Crime Committed: </label>
				<textarea rows=5 class="form-control" name="crime" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"></textarea><br/>

				<input type="submit" name="most" value="Register Most Wanted Person" style="" class="btn btn-success"/>
			</form>
	</div>
		<div class="col-lg-6">
		<h4 align="center">MISSING PERSONS RECORDS</h4>
		<?php
		$queryview = mysqli_query($conn, "SELECT * FROM most_wanted");
		if ($queryview->num_rows < 1) {
			echo "<b style='color:red;'> No records found </b>";
		}
		else
		{	
			echo "<table class='table'>";
			echo "<tr><th>S/N</th><th>Photo</th><th>Full Name</th><th>Location Last Seen</th></tr>";
			$sn = 0;
			while ($loopview = $queryview->fetch_array()) {
				$sn += 1;
				$img = $loopview['img'];
				$fname = $loopview['fname'];
				$seen = $loopview['loc_last_seen'];
				echo "<tr><td>$sn</td><td><img src='$img' height=100 width='100%' /></td><td>$fname</td><td>$seen</td></tr>";
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