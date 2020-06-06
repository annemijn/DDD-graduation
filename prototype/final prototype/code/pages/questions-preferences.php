<?php
		session_start();
		$titel = strtoupper(basename($_SERVER['PHP_SELF'], '.php'));
		$id = $_SESSION['id'];//store id of previous page
		
			if (isset($_POST['submit']))//if customer clicks on submit
			{
				include('connect.php');//connect to database
				
				$functionalValue = $_POST['functionalValue'];//create new variables of entered information
				$socialValue = $_POST['socialValue'];
				$moneySaving = $_POST['moneySaving'];
				$productVariety = $_POST['productVariety'];
				$socialInteraction = $_POST['socialInteraction'];
				$consumptionValues = 0;
				$goals = 0;


				if($functionalValue == 1 && $socialValue == 1) #look at the values the customer entered in, to select the right consumption value
				{
					$consumptionValues = 3;
				}
				else{
					if($functionalValue == 1)
					{
						$consumptionValues = 1;
					}	
					if($socialValue == 1)
					{
						$consumptionValues = 2;
					}													
				}

				if($moneySaving == 1 && $productVariety == 1 && $socialInteraction == 1) #look at the values the customer entered in, to select the right goal
				{
					$goals = 7;
				}
				else{
					if($moneySaving == 1 && $productVariety == 1)
					{
						$goals = 6;
					}
					if($moneySaving == 1 && $socialInteraction == 1)
					{
						$goals = 5;
					}
					if($productVariety == 1 && $socialInteraction == 1)
					{
						$goals = 4;
					}
					else{
						if($moneySaving == 1)
						{
							$goals = 1;
						}	
						if($productVariety == 1)
						{
							$goals = 2;
						}	
						if($socialInteraction == 1)
						{
							$goals = 3;
						}																							
					}														
				}


				$sql = "UPDATE customerdata SET consumptionValues='" . $consumptionValues . "', goals='" . $goals . "'WHERE id='" . $id . "'"; //insert variables in database where the id of the customer is the same
									
				if ($connection->query($sql) === TRUE) {//if it can connect to database, insert sql line into database
					$_SESSION['id'] = $id;//use id at the next page
					header("location: results.php");  //go to next page						
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
	            	<h2>Jouw voorkeuren</h2>
	            	<p>Ik wil specifieke kenmerken en voorwaarden van leningen vergelijken.</p>
					<div class="radio-toolbar yesno">
						<label>
						  	<input type='radio' name='functionalValue' value='1'required>
						  	<img class="radioimages2" src="../images/ja.png">
						</label>

						<label>
						  	<input type='radio' name='functionalValue' value='0'>
							<img class="radioimages2" src="../images/nee.png">
						</label>
					</div>					
	            	<p>De mening van de financiële expert van Geld.nl is belangrijk voor mij.</p>
					<div class="radio-toolbar yesno">
						<label>
						  	<input type='radio' name='socialValue' value='1'required>
						  	<img class="radioimages2" src="../images/ja.png">
						</label>

						<label>
						  	<input type='radio' name='socialValue' value='0'>
							<img class="radioimages2" src="../images/nee.png">
						</label>
					</div>					
	            	<p>ik wil zo snel mogelijk mijn lening afbetalen om voordeliger uit te zijn.</p>
					<div class="radio-toolbar yesno">
						<label>
						  	<input type='radio' name='moneySaving' value='1'required>
						  	<img class="radioimages2" src="../images/ja.png">
						</label>

						<label>
						  	<input type='radio' name='moneySaving' value='0'>
							<img class="radioimages2" src="../images/nee.png">
						</label>
					</div>	
	            	<p>Ik wil zo veel mogelijk verschillende leningen vergelijken.</p>
					<div class="radio-toolbar yesno">
						<label>
						  	<input type='radio' name='productVariety' value='1'required>
						  	<img class="radioimages2" src="../images/ja.png">
						</label>

						<label>
						  	<input type='radio' name='productVariety' value='0'>
							<img class="radioimages2" src="../images/nee.png">
						</label>
					</div>	
	            	<p>Reviews over kredietverstrekkers zijn belangrijk voor mij.</p>
					<div class="radio-toolbar yesno">
						<label>
						  	<input type='radio' name='socialInteraction' value='1'required>
						  	<img class="radioimages2" src="../images/ja.png">
						</label>

						<label>
						  	<input type='radio' name='socialInteraction' value='0'>
							<img class="radioimages2" src="../images/nee.png">
						</label>
					</div>											
					
					
				</div>
			</div>					

			<div class="progress">
				<p>100%</p>
				<div class="greenbalk"></div>
				<div class="whitebalk"></div>
			</div>
			<footer>
				<button type="submit" name="submit" class="btn add btn-primary">Verder</button>
			</form>
				<a href="questions-aboutpartner.php"><button name="back" class="btn-back back btn-primary">Terug</button></a>			
			</footer>
			
	</body>
</html>
