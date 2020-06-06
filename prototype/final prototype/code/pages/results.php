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
        <?php

			$command = escapeshellcmd('algorithm.py'); //execute python file with algorithm
			$output = shell_exec($command);

			            
			session_start();
			$titel = strtoupper(basename($_SERVER['PHP_SELF'], '.php'));
			$id = $_SESSION['id'];//store id of previous page
			include('connect.php');//connect to database
			$loanpurpose = '';//create new variables of entered information and the executed algorithm
			$provider = '';
			$provider2 = '';
			$provider3 = '';
			$reviewscore = '';
			$typeloan = '';
			$expertlabel = false;
			$moneysaving = false;
			$socialinteraction = false;
			$productvariety = false;

			$sql="SELECT * FROM customerdata WHERE id=$id"; //select table customer data
			$result = mysqli_query($connection,$sql);
				if ($result->num_rows > 0) 
				{
							while($row = $result->fetch_assoc()) //if table is not empty, show data in the results
							{
								include('contentloan.php'); //in this file a lot of data ints have been converted to text and it looks at the preferences to show the labels.
								
								?>
				            <header>
				            	<div class="logo">
				            		<a href="delete.php?id=<?=$id?>"><img src="../images/logo.png"></a>
				            	</div>
				            	<div class="crossmark">
				            		<a href="delete.php?id=<?=$id?>"><img src="../images/crossmark.png"></a>
				            	</div>
				            </header>  
				            <div class="texttop3">
				            	<h2>Top 3 <span>leningen</span> voor jou</h2>								
								<p>Drie persoonlijke adviezen gebaseerd op jouw gegevens voor je leendoel "<?php echo $loanpurpose;?>" van € <?php echo $row['loanAmount'];?>.</p>
							</div>
			                <div class="containeradvice">
			                	<div class="firstadvice advice">
			                		<div class="number">1</div>
			                		<div class="containerlabels">
			                		<?php if ($expertlabel == true && $moneysaving == true && $row['lowestLoanDuration'] == $row['loanDuration'] && $socialinteraction == true && $row['highestReviewScore'] == $row['reviewScore']){ 		echo '<div class="label"><img src="../images/expert.png" class="iconlabel">Experts keuze!</div><div class="label lloanduration"><img src="../images/money.png" class="iconlabel">Kortste 			looptijd!</div><div class="label lreviewscore"><img src="../images/score.png" class="iconlabel">Hoogste review!</div>'; //create labels based on the data
			                				}
			                				else{ 
			                					if($moneysaving == true && $row['lowestLoanDuration'] == $row['loanDuration'] && $socialinteraction == true && $row['highestReviewScore'] == $row['reviewScore']){ 
			                						echo '<div class="label lloanduration"><img src="images/money.png" class="iconlabel">Kortste looptijd!</div><div class="label lreviewscore"><img src="images/score.png" class="iconlabel">Hoogste review!</div>';
			                					}			                					
			                					if($expertlabel == true && $moneysaving == true && $row['lowestLoanDuration'] == $row['loanDuration']){
			                						echo '<div class="label"><img src="../images/expert.png" class="iconlabel">Experts keuze!</div><div class="label lloanduration"><img src="../images/money.png" class="iconlabel">Kortste looptijd!</div>';
			                					}
			                					if($expertlabel == true && $socialinteraction == true && $row['highestReviewScore'] == $row['reviewScore']){
			                						echo '<div class="label"><img src="../images/expert.png" class="iconlabel">Experts keuze!</div><div class="label lreviewscore"><img src="../images/score.png" class="iconlabel">Hoogste review!</div>';
			                					}			                					
			                					else{ 
			                						if($moneysaving == true && $row['lowestLoanDuration'] == $row['loanDuration']){ 
			                							echo '<div class="label lloanduration"><img src="../images/money.png" class="iconlabel">Kortste looptijd!</div>';
			                						}
			                						if($socialinteraction == true && $row['highestReviewScore'] == $row['reviewScore']){ 
			                							echo '<div class="label lreviewscore"><img src="../images/score.png" class="iconlabel">Hoogste review!</div>';
			                						}
			                						if($expertlabel == true){ 
			                							echo '<div class="label"><img src="../images/expert.png" class="iconlabel">Experts keuze!</div>';
			                						} 
			                					} 
			                				}?>
			                			</div>
		                		
			                		<div class="containerblock">
				                		<div class="highlights">
					                		<div class="first border">
						                		<p>Rente</p>
					                            <h1><?php echo $row['interestRate'];//show predicted interest rate?>%</h1>
					                        </div>
				                        	<div class="first">
						                		<p>Maandbedrag</p>
					                            <h1>€ <?php echo $row['monthamount'];//show predicted month amount?></h1>
					                        </div>
				                    	</div>
				                        <div class="information">		                            
				                            <div class="specs">
				                            	<p>Aanbieder:</p>
				                            </div>
				                            <div class="outcome">
				                            	<div class="provider">
				                            		<p><span><?php echo $provider;//show the provider?></span></p>
				                            	</div>
					                             <div class="score">
					                             	<a href="#"><p><?php echo $row['reviewScore'];//show predicted review score?>%</p></a>
					                             	<img src="../images/star.png" class="star">
					                            </div>
					                        </div>
					                        	<div class="specs">
				                            		<p>Type lening:</p>
				                            	</div>
				                            	<div class="outcome">
					                            	<div class="provider">
														<p><span><?php echo $typeloan;//show the predicted type of loan?></span></p>
													</div>
												</div>
												<div class="specs">
				                            		<p>Looptijd:</p>
				                            	</div> 
				                            	<div class="outcome">
					                            	<div class="provider">
					                            		<p><span><?php echo $row['loanDuration'];//show the predicted loan duration?> maanden</span></p>
					                            	</div>
					                            </div>
				                          </div> 
				                      </div>
			                          <div class="blueblock"> 
			                          	<p><?php echo $row['persuasion'];//show the predicted personalized persuasive information?> klanten met hetzelfde leendoel hebben </br>ook gekozen voor <?php echo $provider;?>!</p>
			                          	<a href=apply.php?id=<?=$id?> target="_blank"><button type="submit" class="btn add btn-primary center">Aanvragen</button></a>
										<div class="vergelijk"><a href="compare.html" target="_blank">Vergelijken en meer informatie</a></div>	                     	                      
			                        </div>   		                                    
	                       		</div>

								<div class="advice">
									<div class="number">2</div>
									<div class="containerlabels">
									<?php if ($moneysaving == true && $row['lowestLoanDuration'] == $row['loanDuration2'] && $socialinteraction == true && $row['highestReviewScore'] == $row['reviewScore2']){ 
											echo '<div class="label lloanduration"><img src="../images/money.png" class="iconlabel">Kortste looptijd!</div><div class="label lreviewscore"><img src="../images/score.png" class="iconlabel">Hoogste review!</div>';
											} 
											else{ 
												if($moneysaving == true && $row['lowestLoanDuration'] == $row['loanDuration2']){
												 echo '<div class="label lloanduration"><img src="../images/money.png" class="iconlabel">Kortste looptijd!</div>';
												}
												if($socialinteraction == true && $row['highestReviewScore'] == $row['reviewScore2']){
												 echo '<div class="label lreviewscore"><img src="../images/score.png" class="iconlabel">Hoogste review!</div>';
												} 
											}?>
										</div>
			                		<div class="containerblock">
				                		<div class="highlights">
					                		<div class="first border">
						                		<p>Rente</p>
					                            <h1><?php echo $row['interestRate2'];?>%</h1>
					                        </div>
				                        	<div class="first">
						                		<p>Maandbedrag</p>
					                            <h1>€ <?php echo $row['monthamount2'];?></h1>
					                        </div>
				                    	</div>
				                        <div class="information">		                            
				                            <div class="specs">
				                            	<p>Aanbieder:</p>
				                            </div>
				                            <div class="outcome">
				                            	<div class="provider">
				                            		<p><span><?php echo $provider2;?></span></p>
				                            	</div>
					                             <div class="score">
					                             	<a href="#"><p><?php echo $row['reviewScore2'];?>%</p></a>
					                             	<img src="../images/star.png" class="star">
					                            </div>
					                        </div>
					                        	<div class="specs">
				                            		<p>Type lening:</p>
				                            	</div>
				                            	<div class="outcome">
					                            	<div class="provider">
														<p><span><?php echo $typeloan;?></span></p>
													</div>
												</div>
												<div class="specs">
				                            		<p>Looptijd:</p>
				                            	</div> 
				                            	<div class="outcome">
					                            	<div class="provider">
					                            		<p><span><?php echo $row['loanDuration2'];?> maanden</span></p>
					                            	</div>
					                            </div>
				                          </div> 
				                      </div>
			                          <div class="blueblock"> 
			                          	<p><?php echo $row['persuasion2'];?> klanten met hetzelfde leendoel hebben </br>ook gekozen voor <?php echo $provider2;?>!</p>
			                          	<a href=apply.php?id=<?=$id?> target="_blank"><button type="submit" class="btn add btn-primary center">Aanvragen</button></a>
										<div class="vergelijk"><a href="compare.html" target="_blank">Vergelijken en meer informatie</a></div>				                      
			                        </div>   		                                    
	                       		</div>	

								<div class="advice lastadvice">
									<div class="number">3</div>
									<div class="containerlabels">
									<?php if ($moneysaving == true && $row['lowestLoanDuration'] == $row['loanDuration3'] && $socialinteraction == true && $row['highestReviewScore'] == $row['reviewScore3']){ 
											echo '<div class="label lloanduration"><img src="../images/money.png" class="iconlabel">Kortste looptijd!</div><div class="label lreviewscore"><img src="../images/score.png" class="iconlabel">Hoogste review!</div>';
										} 
										else{ 
											if($moneysaving == true && $row['lowestLoanDuration'] == $row['loanDuration3'])
												{ echo '<div class="label lloanduration"><img src="../images/money.png" class="iconlabel">Kortste looptijd!</div>';
										}
										if($socialinteraction == true && $row['highestReviewScore'] == $row['reviewScore3']){
										 echo '<div class="label lreviewscore"><img src="../images/score.png" class="iconlabel">Hoogste review!</div>';
										} 
									}?>
								</div>
			                		<div class="containerblock">
				                		<div class="highlights">
					                		<div class="first border">
						                		<p>Rente</p>
					                            <h1><?php echo $row['interestRate3'];//show predicted interest rate?>%</h1>
					                        </div>
				                        	<div class="first">
						                		<p>Maandbedrag</p>
					                            <h1>€ <?php echo $row['monthamount3'];?></h1>
					                        </div>
				                    	</div>
				                        <div class="information">		                            
				                            <div class="specs">
				                            	<p>Aanbieder:</p>
				                            </div>
				                            <div class="outcome">
				                            	<div class="provider">
				                            		<p><span><?php echo $provider3;?></span></p>
				                            	</div>
					                             <div class="score">
					                             	<a href="#"><p><?php echo $row['reviewScore3'];?>%</p></a>
					                             	<img src="../images/star.png" class="star">
					                            </div>
					                        </div>
					                        	<div class="specs">
				                            		<p>Type lening:</p>
				                            	</div>
				                            	<div class="outcome">
					                            	<div class="provider">
														<p><span><?php echo $typeloan;?></span></p>
													</div>
												</div>
												<div class="specs">
				                            		<p>Looptijd:</p>
				                            	</div> 
				                            	<div class="outcome">
					                            	<div class="provider">
					                            		<p><span><?php echo $row['loanDuration3'];?> maanden</span></p>
					                            	</div>
					                            </div>
				                          </div> 
				                      </div>
			                          <div class="blueblock"> 
			                          	<p><?php echo $row['persuasion3'];?> klanten met hetzelfde leendoel hebben </br>ook gekozen voor <?php echo $provider3;?>!</p>
			                          	<a href=apply.php?id=<?=$id?> target="_blank"><button type="submit" class="btn add btn-primary center">Aanvragen</button></a>
										<div class="vergelijk"><a href="compare.html" target="_blank">Vergelijken en meer informatie</a></div>					                      
			                        </div>   		                                    
	                       		</div>                      				                       		
	                       	</div>	
	                       	<?php if($productvariety == true){ 
	                       		echo '<a href="more-loans.html" target="_blank"><button name="back" class="btn-back add moreloansbtn btn-primary">Meer leningen</button></a>';
	                       		}?>		                
			          <?php
							}
						}
						else
						{
							echo "er staat niets in het tabel";
						}

			?>       				
	
		</div>
	</body>
</html>