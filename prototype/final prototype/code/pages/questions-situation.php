<?php
		session_start();
		$titel = strtoupper(basename($_SERVER['PHP_SELF'], '.php'));
		$id = $_SESSION['id'];//store id of previous page
		
			if (isset($_POST['submit'])) //if customer clicks on submit
			{
				include('connect.php');//connect to database
				
				$children = $_POST['children'];//create new variables of entered information
				$province = $_POST['province'];
				$sql = "UPDATE customerdata SET children='" . $children . "', province='" . $province . "'WHERE id='" . $id . "'"; //insert variables in database where the id of the customer is the same
									
				if ($connection->query($sql) === TRUE) { //if it can connect to database, insert sql line into database
					$_SESSION['id'] = $id;//use id at the next page
					header("location: questions-preferences.php");  //go to next page
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
	            	<h2> Over jouw situatie</h2>
	            		<p>Heb je kinderen die jonger zijn dan 21 jaar en waarvoor je financieel verantwoordelijk bent?</p>
					<div class="radio-toolbar yesno">
						<label>
						  	<input type='radio' name='children' value='1'required>
						  	<img class="radioimages2" src="../images/ja.png">
						</label>

						<label>
						  	<input type='radio' name='children' value='2'>
							<img class="radioimages2" src="../images/nee.png">
						</label>
					</div>	
					<p>Provincie</p>
						<label class="select">
							   <select class="input" name="province" required>
								   <option value="">Maak een keuze</option>
								    <option value="1">Noord-Holland</option>
								    <option value="2">Zuid-Holland</option>
								    <option value="3">Flevoland</option>
								    <option value="4">Noord-Brabant</option>
								    <option value="5">Limburg</option>
								    <option value="6">Friesland</option>
								    <option value="7">Overijssel</option>
								    <option value="8">Zeeland</option>
								    <option value="9">Gelderland</option>
								    <option value="10">Groningen</option>
								    <option value="11">Utrecht</option>
								    <option value="12">Drenthe</option>
								</select> 
							</label>	

				</div>
			</div>					

			<div class="progress progress80">
				<p>80%</p>
				<div class="greenbalk greenbalk80"></div>
				<div class="whitebalk whitebalk80"></div>
			</div>
			<footer>
				<button type="submit" name="submit" class="btn add btn-primary">Verder</button>
			</form>
				<a href="questions-aboutpartner.php"><button name="back" class="btn-back back btn-primary">Terug</button></a>			
			</footer>
			
	</body>
</html>
