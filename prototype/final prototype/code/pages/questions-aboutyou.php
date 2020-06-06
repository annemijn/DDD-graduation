<?php
		session_start();
		$titel = strtoupper(basename($_SERVER['PHP_SELF'], '.php'));
		$id = $_SESSION['id']; //store id of previous page
		
			if (isset($_POST['submit'])) //if customer clicks on submit
			{
				include('connect.php'); //connect to database
				
				$age = $_POST['age']; //create new variables of entered information
				$typeIncome = $_POST['typeIncome'];
				$netIncome = $_POST['netIncome'];
				$partner = $_POST['partner'];

				$sql = "UPDATE customerdata SET age='" . $age . "', typeIncome='" . $typeIncome . "', netIncome='" . $netIncome . "' WHERE id='" . $id . "'";  //insert variables in database where the id of the customer is the same
									
				if ($connection->query($sql) === TRUE) { //if it can connect to database, insert sql line into database
					$_SESSION['id'] = $id; //use id at the next page

					if($partner == 1){
				  		header("location: questions-aboutpartner.php"); //go to this page if customer has a partner
					}
					else{
						header("location: questions-situation.php");//go to this page if customer does not have a partner
					}
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
	            	<h2> Over jou</h2>
					<p>Leeftijd</p>				
						<input id="age" type="text" name="age" placeholder="Vul je leeftijd in" required>
						<p>Type inkomen</p>
						<label class="select">
							   <select class="input" name="typeIncome" required>
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
						<input id="netIncome" type="text" name="netIncome" placeholder="Vul bedrag in" required>
						<p>Heb je een partner?</p>
					<div class="radio-toolbar yesno">
						<label>
						  	<input type='radio' name='partner' value='1' required/>
						  	<img class="radioimages2" src="../images/ja.png">
						</label>

						<label>
						  	<input type='radio' name='partner' value='2'/>
							<img class="radioimages2" src="../images/nee.png">
						</label>
					</div>	
				</div>
			</div>					


			<div class="progress progress40">
				<p>40%</p>
				<div class="greenbalk greenbalk40"></div>
				<div class="whitebalk whitebalk40"></div>
			</div>
			<footer>
				<button type="submit" name="submit" class="btn add btn-primary">Verder</button>
			</form>
				<a href="questions-loan.php"><button name="back" class="btn-back back btn-primary">Terug</button></a>			
			</footer>
			
	</body>
</html>
