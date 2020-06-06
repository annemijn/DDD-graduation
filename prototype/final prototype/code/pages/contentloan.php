<?php
if($row['loanPurpose'] == 1) //show the loan purpose text
								{
									$loanpurpose = 'auto';
								}								
								if($row['loanPurpose'] == 2)
								{
									$loanpurpose = 'restschuld hypotheek';
								}	
								if($row['loanPurpose'] == 3)
								{
									$loanpurpose = 'verbouwing';
								}
								if($row['loanPurpose'] == 4)
								{
									$loanpurpose = 'boot';
								}
								if($row['loanPurpose'] == 5)
								{
									$loanpurpose = 'lening oversluiten';
								}
								if($row['loanPurpose'] == 6)
								{
									$loanpurpose = 'anders';
								}	

								if($row['reviewScore'] == 76) #show the provider based on the review score
								{
									$provider = 'BNP Paribas';
								}			
								if($row['reviewScore'] == 79)
								{
									$provider = 'DEFAM';
								}
								if($row['reviewScore'] == 87)
								{
									$provider = 'Findio';
								}
								if($row['reviewScore'] == 77)
								{
									$provider = 'Freo';
								}
								if($row['reviewScore'] == 74)
								{
									$provider = 'Interbank';
								}	
								if($row['reviewScore'] == 90)
								{
									$provider = 'Lender & Spender';
								}	
								if($row['reviewScore'] == 78)
								{
									$provider = 'Nationale Nederlanden';
								}	
								if($row['reviewScore'] == 79)
								{
									$provider = 'Qander';
								}	


								if($row['reviewScore2'] == 76)
								{
									$provider2 = 'BNP Paribas';
								}			
								if($row['reviewScore2'] == 79)
								{
									$provider2 = 'DEFAM';
								}
								if($row['reviewScore2'] == 87)
								{
									$provider2 = 'Findio';
								}
								if($row['reviewScore2'] == 77)
								{
									$provider2 = 'Freo';
								}
								if($row['reviewScore2'] == 74)
								{
									$provider2 = 'Interbank';
								}	
								if($row['reviewScore2'] == 90)
								{
									$provider2 = 'Lender & Spender';
								}	
								if($row['reviewScore2'] == 78)
								{
									$provider2 = 'Nationale Nederlanden';
								}	
								if($row['reviewScore2'] == 79)
								{
									$provider2 = 'Qander';
								}									


								if($row['reviewScore3'] == 76)
								{
									$provider3 = 'BNP Paribas';
								}			
								if($row['reviewScore3'] == 79)
								{
									$provider3 = 'DEFAM';
								}
								if($row['reviewScore3'] == 87)
								{
									$provider3 = 'Findio';
								}
								if($row['reviewScore2'] == 77)
								{
									$provider3 = 'Freo';
								}
								if($row['reviewScore3'] == 74)
								{
									$provider3 = 'Interbank';
								}	
								if($row['reviewScore3'] == 90)
								{
									$provider3 = 'Lender & Spender';
								}	
								if($row['reviewScore3'] == 78)
								{
									$provider3 = 'Nationale Nederlanden';
								}	
								if($row['reviewScore3'] == 79)
								{
									$provider3 = 'Qander';
								}		

								if($row['typeLoan'] == 1) #show the type of loan text
								{
									$typeloan = 'Persoonlijke lening';
								}

								if($row['consumptionValues'] == 2 || $row['consumptionValues'] == 3) #show the labels if preferences are true
								{
									$expertlabel = true;
								}
								if($row['goals'] == 1 || $row['goals'] == 5 || $row['goals'] == 6 || $row['goals'] == 7)
								{
									$moneysaving = true;
								}
								if($row['goals'] == 3 || $row['goals'] == 4 || $row['goals'] == 5 || $row['goals'] == 7)
								{
									$socialinteraction = true;
								}
								if($row['goals'] == 2 || $row['goals'] == 6 || $row['goals'] == 4 || $row['goals'] == 7)
								{
									$productvariety = true;
								}								
								?>