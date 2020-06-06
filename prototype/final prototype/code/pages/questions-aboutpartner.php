<?php
		session_start();
		$titel = strtoupper(basename($_SERVER['PHP_SELF'], '.php'));
		$id = $_SESSION['id']; //store id of previous page
		
			if (isset($_POST['submit'])) //if customer clicks on submit
			{
				include('connect.php');  //connect to database
				
				$agePartner = $_POST['agePartner']; //create new variables of entered information
				$typeIncomePartner = $_POST['typeIncomePartner'];
				$netIncomePartner = $_POST['netIncomePartner'];

				$sql = "UPDATE customerdata SET agePartner='" . $agePartner . "', typeIncomePartner='" . $typeIncomePartner . "', netIncomePartner='" . $netIncomePartner . "' WHERE id='" . $id . "'";//insert variables in database where the id of the customer is the same
									
				if ($connection->query($sql) === TRUE) { //if it can connect to database, insert sql line into database
					$_SESSION['id'] = $id;//use id at the next page
				  	header("location: questions-situation.php"); //go to next page
				} else {
				  	echo "Error: " . $sql . "<br>" . $connection->error;//if it cannot connect, show error
				}							
			$connection->close();
		}
    ?>	
<!DOCTYPE html> 
<html class="progress-html">
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
	<body>
            <div class="container2">
	            <header>
	            	<div class="logo">
	            		<a href="delete.php?id=<?=$id?>"><img src="../images/logo.png"></a>
	            	</div>
	            	<div class="crossmark">
	            		<a href="delete.php?id=<?=$id?>"><img src="../images/crossmark.png"></a>
	            	</div>
	            </header> 	
			<form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post" name="myform">
	            <div class="container">
	            	<h2> Over jouw partner</h2>
	            		<p>Leeftijd partner</p>
						<input id="agePartner" type="text" name="agePartner" placeholder="vul leeftijd van je partner in" required>							
						<p>Type inkomen partner</p>
						<label class="select">
							   <select class="input" name="typeIncomePartner" required>
								   <option value="">Maak een keuze</option>
								    <option value="1">Loondienst</option>
								    <option value="2">Eigen bedrijf</option>
								    <option value="3">Pensioen</option>
								    <option value="4">Uitkering</option>
								    <option value="5">Uitzendwerk</option>
								    <option value="6">Geen</option>
								    <option value="7">Anders</option>
								</select> 
							</label>						
						<p>Netto-inkomen per maand</p>
						<input id="netIncomePartner" type="text" name="netIncomePartner" placeholder="Vul bedrag in" required>											
				</div>
			</div>					

			<div class="progress progress60">
				<p>60%</p>
				<div class="greenbalk greenbalk60"></div>
				<div class="whitebalk whitebalk60"></div>
			</div>
			<footer>
				<button type="submit" name="submit" class="btn add btn-primary">Verder</button>
			</form>
				<a href="questions-aboutyou.php"><button name="back" class="btn-back back btn-primary">Terug</button></a>			
			</footer>
			
	</body>
</html>
