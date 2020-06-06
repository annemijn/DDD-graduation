<!DOCTYPE html> 
<html>
	<head>
		<title>Geld.nl- Persoonlijk leningadvies</title>
		<link rel="stylesheet" type="text/css" href="../css/stylesheet.css" media="screen" />
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
	</head>
	<div class="geld-lenen-banner">
		<img src="../images/banner-geld-lenen.png" alt="Let op! Geld lenen kost geld">
	</div>
	<body class="home">
	    <div class="container2">
	        <header>
	        	<div class="logo">
	        		<a href="../index.html" ><img src="../images/logo-white.png" alt="Geld.nl"></a>
	        	</div>        	
	        </header>  
	        <div class="text-loan text-delete">
			<?php
			include('connect.php');//connect to database

			// check for primary id of the record-set in url
			if(isset($_GET['id'])){

				// retrieve id from url
				$id = (int)$_GET['id'];

				// sql delete query
				$query = "DELETE FROM customerdata WHERE id =" . $id;
			}else{
				echo 'No id set';
			}

			//query execution
			$result = mysqli_query($connection,$query);

			//display message to user 
			if($result){
				echo '<h1>Je gegevens zijn <span>succesvol</span> verwijderd.</h1>';
			}else{
				echo 'User data couldn\'t be deleted';
			}
			?>	        	
	        	<h3>Je word nu doorverwezen naar Geld.nl om je aanvraag af te ronden.</h3>
	        </div>
	        <img class="image-apply delete-apply" src="../images/apply.png">
	    </div>
	</body>
</html>

