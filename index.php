<?php
session_start();
ob_start();
include ('conn.php');

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
	
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.8); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5px auto; /* 15% from the top and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    /* Position it in the top right corner outside of the modal */
    position: absolute;
    right: 25px;
    top: 0; 
    color: red;
    font-size: 35px;
    font-weight: bold;
}

/* Close button on hover */
.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.9s;
    animation: animatezoom 0.9s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}
/* Bordered form */
form {
    border: 3px solid #f1f1f1;
}

/* Full-width inputs */


/* Set a style for all buttons */


/* Add a hover effect for buttons */
button:hover {
    opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
    width: 40%;
    border-radius: 50%;
}

/* Add padding to containers */
.container {
    padding: 16px;
}

/* The "Forgot password" text */
span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
        display: block;
        float: none;
    }
    .cancelbtn {
        width: 100%;
    }
}
		</style>

	<script type="text/javascript">
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


</script>
	</head>
<body>
	<div id="id01" class="modal" >
  

  <!-- Modal Content -->
 

 
  <form method="POST" class="modal-content animate" action="#" style="background-color:#1f1b30;margin:110px auto 0px auto;width:30%;padding:2%;border-radius:10px;">
  				<a href="index.php" class="close" onclick="document.getElementById('id01').style.display='none'" style="float:right;"><i class="fa fa-times"></i></a>
  				<h3 align="center" style="font-size:16px;margin-top:0px">Login Form</h3>
				<label>User Name: </label>
				<input type="text" autofocus class="form-control" name="uname" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>
				<br/>
				<label>Password: </label>
				<input type="password" class="form-control" name="psw" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/><br/>


				<input type="submit" value="Login" name="login" style="width:100%;" class="btn btn-success"/>
				
	</form>
	</div>
 	<?php

	if(isset($_POST['login'])){
		$queryNpfLogin = mysqli_query($conn, "SELECT * FROM npf_admin WHERE admin_uname='".$_POST['uname']."' && admin_pwd='".$_POST['psw']."'");

		$queryIgLogin = mysqli_query($conn, "SELECT * FROM ig WHERE uname='".$_POST['uname']."' && pwd='".$_POST['psw']."'");

		$queryCourtLogin = mysqli_query($conn, "SELECT * FROM court WHERE co_ad_uname='".$_POST['uname']."' && co_ad_pwd='".$_POST['psw']."'");

		$queryInsLogin = mysqli_query($conn, "SELECT * FROM npf WHERE access_uname='".$_POST['uname']."' && off_lname='".$_POST['psw']."' && off_level='INSPECTOR'");

		$querySarLogin = mysqli_query($conn, "SELECT * FROM npf WHERE access_uname='".$_POST['uname']."' && off_lname='".$_POST['psw']."' && off_level='SARS'");

		$queryConLogin = mysqli_query($conn, "SELECT * FROM npf WHERE access_uname='".$_POST['uname']."' && off_lname='".$_POST['psw']."' && off_level='CONSTABLE'");

		$querySerLogin = mysqli_query($conn, "SELECT * FROM npf WHERE access_uname='".$_POST['uname']."' && off_lname='".$_POST['psw']."' && off_level='SERGENT'");

		if(mysqli_num_rows($queryIgLogin) > 0){
			$_SESSION['ig'] = $_POST['uname'];
			header('refresh:1; url=ig.php');
		}elseif(mysqli_num_rows($queryNpfLogin) > 0){
			$_SESSION['npf_admin'] = $_POST['uname'];
			header('refresh:1; url=npf_admin.php');

		}elseif(mysqli_num_rows($queryCourtLogin) > 0){
			$_SESSION['court_admin'] = $_POST['uname'];
			header('refresh:1; url=court_admin.php');

		}elseif(mysqli_num_rows($queryInsLogin) > 0){
			$_SESSION['ins'] = $_POST['uname'];
			header('refresh:1; url=ins.php');

		}elseif(mysqli_num_rows($querySarLogin) > 0){
			$_SESSION['sars'] = $_POST['uname'];
			header('refresh:1; url=sars.php');

		}elseif(mysqli_num_rows($queryConLogin) > 0){
			$_SESSION['con'] = $_POST['uname'];
			header('refresh:1; url=const.php');

		}elseif(mysqli_num_rows($querySerLogin) > 0){
			$_SESSION['ser'] = $_POST['uname'];
			header('refresh:1; url=serg.php');

		}else{
			echo "<script type='text/javascript'>alert('Wrong Login Details!')</script>";
			header('refresh:1; url=index.php');
		}
	}

	?>

<?php include ('redir.php');?>
<div id="id02" class="modal" >
  

  <!-- Modal Content -->
 

 
  <form method="POST" class="modal-content animate" action="#" style="background-color:#1f1b30;margin:45px auto 0px auto;width:30%;padding:2%;border-radius:10px;">
  				<a href="index.php" class="close" onclick="document.getElementById('id02').style.display='none'" style="float:right;"><i class="fa fa-times"></i></a>
  				<h3 align="center" style="font-size:16px;margin-top:0px">Compliant Form</h3>
				<label>Full Name: </label>
				<input type="text" class="form-control" name="fname" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>
				<br/>
				<label>Address: </label>
				<textarea rows=3 class="form-control" name="addr" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"></textarea>
				<br/>
				<label>Compliant: </label>
				<textarea rows=3 class="form-control" name="comp" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"></textarea><br/>
				<label>Time: </label>
				<input type="text" class="form-control" name="tym" value="<?php echo date("H:i A  d / M / Y"); ?>" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/><br/>
				<label>Station Name: </label>
				<select  class="form-control" name="stat_name" style="background-color:#000;border-bottom:6px solid lightgreen;color:white;" required>
					<option class="form-control" selected="selected" value=""> -- Choose station name --</option>
					<?php
					$c_type = mysqli_query($conn, "SELECT pol_stat_name FROM npf_admin");
					while ($loop = mysqli_fetch_row($c_type)) {
						 $c = $loop[0];
						echo "<option class=\"form-control\" value=\"$c\">".$c."</option>";
					}

					?>

					
				</select>
				
				<br/>

				<input type="submit" value="Lodge Complaint" name="com" style="width:100%;" class="btn btn-success"/>
				
	</form>
 <?php
			
				if(isset($_POST['com'])){
					
					mysqli_query($conn, "INSERT INTO compliant (fname,addr,comp,tym,stat_name) VALUES ('".$_POST['fname']."','".$_POST['addr']."','".$_POST['comp']."','".$_POST['tym']."','".$_POST['stat_name']."')");
						echo "<script type='text/javascript'>alert('Your compliant has been sent successfully!')</script>";
					header('refresh:1; url=index.php');
				}		
			
			?>
</div>
<!-- beginning of nav -->
	<nav class="navbar navbar-inverse navbar-static-top" style="padding:1%;background-color:#000;border-bottom:5px solid lightgreen;height:100px;">
		<div style="float:left;height:50px;width:15px;border:1px solid lightgreen;background-color:lightgreen"></div>
		<div style="float:left;height:50px;width:15px;border:1px solid white;background-color:white"></div> 
		<div style="float:left;height:50px;width:15px;border:1px solid lightgreen;background-color:lightgreen"></div> 

		<h3 style="margin-left:5%;">POLICE JUDICIARY AND CIVILIAN PROFILING MANAGEMENT SYSTEM</h3>
	</nav>
<!-- end of nav -->
<!-- beginning of container -->
<div class="container" style="padding-top:0px;width:95%;background-image:url('img/px2.png');border:0px groove lightgreen;">
<div style="width:60%;border:0px solid lightgreen;">

	<a href="#" onclick="document.getElementById('id01').style.display='block'"><button class="btn btn-default" style="float:right;font-weight:bold;background-color:transparent;border-width:0px;color:lightgreen;"><i class="fa fa-user"></i> Login </button></a>

<!-- RESPONSE LINK
	<a href="#" onclick="document.getElementById('missing').style.display='none'; document.getElementById('res').style.display='block'" ><button class="btn btn-default" style="float:right;font-weight:bold;background-color:transparent;border-width:0px;color:lightgreen;"><i class="fa fa-reply"></i> Response &nbsp;&nbsp;&nbsp;|</button></a>  -->

 <a href="#" onclick="document.getElementById('id02').style.display='block'"><button class="btn btn-default" style="float:right;font-weight:bold;background-color:transparent;border-width:0px;color:lightgreen;"><i class="fa fa-users"></i> Compliant &nbsp;&nbsp;&nbsp;|</button></a>  

<div style="clear:both;"></div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<h4>FIRST INFORMATION REPORT</h4>
			<form method="POST" action="#" style="border:none;">
				<label>Victim Name: </label>
				<input type="text" class="form-control" name="vic_name" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Information About Victim: </label>
				<textarea rows=3 class="form-control" name="com" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"></textarea>
				

				<label>Complaint Type: </label>
				<label>Crime Type Handled: </label>
				
				<select  class="form-control" name="com_type" style="background-color:#000;border-bottom:6px solid lightgreen;color:white;" required>
					<option class="form-control" selected="selected" value=""> -- Choose complaint type --</option>
					<?php
					$c_type = mysqli_query($conn, "SELECT crime_name FROM crime_type ORDER BY crime_name");
					while ($loop = mysqli_fetch_row($c_type)) {
						 $c = $loop[0];
						echo "<option class=\"form-control\" value=\"$c\">".$c."</option>";
					}

					?>

					
				</select>
				
				

				<label>Complainant Full Name: </label>
				<input type="text" class="form-control" name="com_fname" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"/>

				<label>Complainant Address: </label>
				<textarea rows=3 class="form-control" name="com_addr" required style="background-color:#000;border-bottom:6px solid lightgreen;color:white;"></textarea><br/>

				<input type="submit" value="Send" name="fir" style="" class="btn btn-success"/>
			</form>

			<?php
			
				if(isset($_POST['fir'])){
					
					mysqli_query($conn, "INSERT INTO fir (vic_name,com,com_type,com_fname,com_addr) VALUES ('".$_POST['vic_name']."','".$_POST['com']."','".$_POST['com_type']."','".$_POST['com_fname']."','".$_POST['com_addr']."')");
						echo "<h3 align='center' style='color:lightgreen;'><i class='fa fa-check-circle'></i> Your first information report has been sent successfully!</h3>";
					header('refresh:2; url=index.php');
				}		
			
			?>
		</div>
		<div class="col-lg-6" align="center" id="missing">
			<script language="JavaScript">
		// preload shutter audio clip
		var shutter = new Audio();
		shutter.autoplay = false;
		shutter.src = navigator.userAgent.match(/Firefox/) ? 'sound.ogg' : 'd/sound.mp3';
		
		function take_snapshot() {
			// play sound effect
			shutter.play();
			
			
		}
	</script>
			<h4>MISSING PERSONS</h4>
			<!-- <img src="img/a.jpg" onMOuseOver="take_snapshot()"/><img src="img/q.jpg" onMOuseOver="take_snapshot()"/><img src="img/s.jpg" onMOuseOver="take_snapshot()"/> -->
			<!--<i class="fa fa-music" onClick="take_snapshot()" style="cursor:pointer;"></i>-->
			<div class="col-lg-12">
		
		<?php
		$queryview = mysqli_query($conn, "SELECT * FROM missing");
		if ($queryview->num_rows < 1) {
			echo "<b style='color:red;'> No records found </b>";
		}
		else
		{	
			
			while ($loopview = $queryview->fetch_array()) {
				
				$img = $loopview['img'];
				echo "<img src='$img' class='col-lg-4' onMOuseOver='take_snapshot()'/>";
				
				}
			
		}
		?>
	</div>
			<hr/>

			<h4>MOST WANTED LIST</h4>
	<div class="col-lg-12">
		<?php
		$queryview = mysqli_query($conn, "SELECT * FROM most_wanted");
		if ($queryview->num_rows < 1) {
			echo "<b style='color:red;'> No records found </b>";
		}
		else
		{	
			
			while ($loopview = $queryview->fetch_array()) {
				
				$img = $loopview['img'];
				echo "<img src='$img' class='col-lg-4' onMOuseOver='take_snapshot()'/>";
				
				}
			
		}
		?>
	</div>
		</div>

		<div class="col-lg-6" id="res" style="display:none;overflow:auto;height:400px;">
			<!-- <h4>Response</h4>
			<div style="border-bottom:3px solid lightgreen;">
				<i class="fa fa-caret-right"></i> Full name<br/>
			<p style="background-image:url('img/px2.png');padding:2%;">there is a kinda situation going on here and we need the attantion<Br/>there is a kinda situation going on here and we need the attantion<Br/>there is a kinda situation going on here and we need the attantion</p>
			<small><?php echo date("H:i A  d / M / Y");?></small>
			</div> -->
			
			

		</div>

	</div>
</div>

<hr/>
Nathaniel Nosa | Police Profiling &copy; 2019
</div><!-- end of container -->

</body>
</html>