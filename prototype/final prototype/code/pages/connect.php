<?php
$servername= "localhost";
$username= "root";
$password= "";
$database= "loans";
$connection = mysqli_connect($servername,$username,$password,$database); //connect to database
	if(!$connection)
	{
		echo "Connection failed! <br>";
	}
?>
