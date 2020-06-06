<?php
		session_start();
		$titel = strtoupper(basename($_SERVER['PHP_SELF'], '.php'));
		
		
			
			if (isset($_POST['submit'])) //if customer clicks on submit
			{
				include('connect.php'); //connect to database
				
				$loanPurpose = $_POST['loanPurpose']; //create new variables of entered information
				$loanAmount = $_POST['loanAmount'];

				$sql = "INSERT INTO customerdata (loanPurpose, loanAmount) VALUES ('$loanPurpose', '$loanAmount') "; //insert variables in database
									
				if ($connection->query($sql) === TRUE) { //if it can connect to database, insert sql line into database
					$id = $connection->insert_id; #store id
					$_SESSION['id'] = $id; //and use it at the next page
					header("location: questions-aboutyou.php"); //go to next page

				} else {
				  echo "Error: " . $sql . "<br>" . $connection->error; //if it cannot connect, show error
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
	            		<a href="../index.html"><img src="../images/logo.png"></a>
	            	</div>
	            	<div class="crossmark">
	            		<a href="../index.html"><img src="../images/crossmark.png"></a>
	            	</div>
	            </header>
	            <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post" name="myform">
	            <div class="container">
	            	<h2> Wat voor lening wil je?</h2>
					<p>Leendoel</p>
					<div class="radio-toolbar">
						<label>
						  	<input type='radio' name='loanPurpose' value='1' required>
						  	<img class="radioimages" src="../images/auto.png">
						</label>

						<label>
						  	<input type='radio' name='loanPurpose' value='2'>
							<img class="radioimages" src="../images/restschuld.png">
						</label>

						<label>
						  	<input type='radio' name='loanPurpose' value='3'>
							<img class="radioimages last" src="../images/verbouwing.png">
						</label>

						<label>
						  	<input type='radio' name='loanPurpose' value='4'>
							<img class="radioimages" src="../images/boot.png">
						</label>

						<label>
						  	<input type='radio' name='loanPurpose' value='5'>
							<img class="radioimages" src="../images/oversluiten.png">
						</label>

						<label>
						  	<input type='radio' name='loanPurpose' value='6'>
							<img class="radioimages last" src="../images/anders.png">
						</label>
					</div>
					<p>Leenbedrag</p>
					<input id="loanAmount" type="text" name="loanAmount" placeholder="Bijv € 25.000" required>		
				</div>	
			</div>	

			<div class="progress progress20">
				<p>20%</p>
				<div class="greenbalk greenbalk20"></div>
				<div class="whitebalk whitebalk20"></div>
			</div>
			<footer>
				<button type="submit" name="submit" class="btn add btn-primary">Verder</button>
			</form>
				<a href="../index.html"><button name="back" class="btn-back back btn-primary">Terug</button></a>			
			</footer>
	</body>
</html>
