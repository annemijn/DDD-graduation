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
        <?php
            
				session_start();
				$titel = strtoupper(basename($_SERVER['PHP_SELF'], '.php'));
				$id = $_SESSION['id'];//store id of previous page
				
					if (isset($_POST['submit'])) //if customer clicks on submit
					{
						include('connect.php');//connect to database
						
											
						if ($connection->query($sql) === TRUE) {//if it can connect to database, insert sql line into database
							$_SESSION['id'] = $id;//use id at the next page

						} else {
						  echo "Error: " . $sql . "<br>" . $connection->error;//if it cannot connect, show error
						}							

					$connection->close();
				}
            ?>	
	    <div class="container2">
	        <header>
	        	<div class="logo">
	        		<a href="../index.html" ><img src="../images/logo-white.png" alt="Geld.nl"></a>
	        	</div>        	
	        </header>  
	        <div class="text-loan compare">
	        	<h1>Wil je dat jouw gegevens anoniem worden opgeslagen?</h1>
	        	<h3>Hiermee kunnen we andere klanten helpen om een nog beter persoonlijk advies te geven. Jouw gegevens worden niet gebruikt voor andere doeleinden en kunnen niet meer gebruikt worden om jou te identificeren. </h3>
	        <div class="buttons">
	        	<a href="apply.html"><button name="back" class="btn moreloansbtn applybtn btn-primary">Ja</button></a>
	        	<a href="apply-delete.php?id=<?=$id?>"><button name="back" class="btn-back moreloansbtn applybtn btn-primary">Nee</button></a>
	        </div>	        	
	        </div>
	</body>
</html>