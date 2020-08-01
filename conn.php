<?php

$conn = mysqli_connect('localhost','root','');

if ($conn == true) 
{
mysqli_select_db($conn, 'police');
}
else
{
	die(mysqli_error());
}
?>