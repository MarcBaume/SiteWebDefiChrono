<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV6.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>

    <body>

<?php

  include("Header2023.php"); 
  ?>
<div id="corps">

<?php

 session_start();
	
/*if(isset($_SESSION['screen_width']) AND isset($_SESSION['screen_height']))
{
	if  ($_SESSION['screen_width'] > 480 )
	{	
		include("AffConnectionLogin.php"); 
	}
	else
	{
		include("menuSmartPhone.php"); 
	}
} 
else if(isset($_REQUEST['width']) AND isset($_REQUEST['height'])) 
{
    $_SESSION['screen_width'] = $_REQUEST['width'];
    $_SESSION['screen_height'] = $_REQUEST['height'];
    header('Location: ' . $_SERVER['PHP_SELF']);
} 
else 
{
    echo '<script type="text/javascript">window.location = "' . $_SERVER['PHP_SELF'] . '?width="+screen.width+"&height="+screen.height;</script>';
}*/

$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}
else
{
  
	  mysqli_select_db($con ,'dxvv_jurachrono' );

	  
	?>
<div>
	<table>
		<th width= 100%></th>

		   <?php

	//mysqli_select_db($con,$row['Database']);

	$sql = "SELECT * FROM Course ORDER BY Date DESC";
	$result = mysqli_query($con,$sql);
	if ($result && mysqli_num_rows($result) > 0) 
	{
		// output data of each row
		while($val = mysqli_fetch_assoc($result)) 
		{
			if($val['ModeAdmin'] == 0 || $_SESSION['Niveau'] == 2)
			{
				$Date =  date_parse($val ["Date"]);
				$Year = $Date['year']; 
		
				$Month = $Date['month']; 
				$Day = $Date['day']; 
				$SiteWeb = $val ["Site"];
				$timestamp = strtotime($val ["Date"]);
				if ($YearBuffer <> $Year)
				{
					// Creat a row with the Year 
					$YearBuffer = $Year;
					?>
					
					 <tr    >
						<td> <p style="color:white;margin:5px; padding:20px; font-size:24px;background: rgba(36, 174,232, 1);  font-weight:bold;"> <?php echo $Year?> </p></td>
					 </tr>
				<?php
				}
				if ($MonthBuffer <> $Month)
				{
					// Creat a row with the Year 
					$MonthBuffer = $Month;
					?>
					
					 <tr >
						<td ><p style="color:black; margin:5px;padding:15px; font-size:24px; font-weight:bold; "><?php echo  strftime ("%B",$timestamp)?> </p></td>
					 </tr>

				<?php
				}
				
											$IdRace =  $val ["ID"]  ;
		
				?>
					<form method="get"  name="<?php echo "Formulaire".$IdRace  ?>" id="<?php echo "Formulaire".$IdRace  ?>">
										
						<input type="hidden" name="NbrEtape"  value= '<?php echo $val ["nbr_etape"] ?>' />
						<input type="hidden" name="DateCourse"  tabindex="10"  size="60"  value= '<?php echo $val ["Date"] ?>' />
						<input type="hidden" name="Etape" value= 1 />
						<input type="hidden" name="NomCourse" tabindex="10"  size="60"  value= '<?php echo $val ["Nom_Course"] ?>' />
						<input type="hidden" name="ID"  tabindex="10"  size="60"  value= '<?php echo $val ["ID"] ?>' />						
		
					<tr id="<?php echo "RowRace".$IdRace ?>" onmouseover="" style="cursor: pointer;"  onClick="ClickRows( event, <?php echo $IdRace ?>)">
						<td >
							<table width = 100% >
							
							<th width= 15%></th>
							<th width= 15%></th>
							<th width= 30%></th>
							<th width= 35%></th>
							<th width= 5%></th>
							<tr>	
								<td ><?
								if ($val ["Type"] == "Bike")
								{
								?>
									<center> <img src="images/Bike.png" style="width:60px"> </img></center>
									
									<?
									
								}
								else if ($val ["Type"] == "Multi")
								{?>
										<center> <img src="images/Multi.png" style="width:60px"> </img></center> <?
									
									
								}
								else
								{
									if (intval(	$val ["nbr_etape"])== 4)
									{?>
										<table>
										<tr>
											<td>
												<center> <img src="images/Coureur.png" style="width:60px"> </img></center> 
											<td>
												<center> <img src="images/Coureur.png" style="width:60px"> </img></center>
											</td>
										</tr>
										<tr>
											<td>
												<center> <img src="images/Coureur.png" style="width:60px"> </img></center> 
											<td>
												<center> <img src="images/Coureur.png" style="width:60px"> </img></center>
											</td>
										</tr>
										</table>
									<?}
									else
									{?>
										<center> <img src="images/Coureur.png" style="width:60px"> </img></center> <?
									}
							
								}
								
								?>
								</td>						
								<td ><?
					
								 if (intval(	$val ["nbr_etape"])<2 || $val ["JuraDefi"])
									{?>
									
									<center> <h3 style="background-color: transparent;font-size:24px;"><?php echo $Day ?></h3> </center>
									<?
									}
									else
									{
										// Affichage Date Etape 1?>
										<center> <h4 style="background-color: transparent;font-size:12px;"><?php echo strftime ("%d",$timestamp)." ".strftime ("%B",$timestamp) ?></h4> </center>
										<!-- Affichage Date Etape 2 -->
										<?$timestamp2 = strtotime($val ["DateEtape2"]);?>
										<center> <h4 style="background-color: transparent;font-size:12px;"><?php echo strftime ("%d",$timestamp2)." ".strftime ("%B",$timestamp2) ?></h4> </center>
										
									<?
										if (intval(	$val ["nbr_etape"])>2)
										{
										?>
										<!-- Affichage Date Etape 3 -->
											<?$timestamp3 = strtotime($val ["DateEtape3"]);?>
											<center> <h4 style="background-color: transparent;font-size:12px;"><?php echo strftime ("%d",$timestamp3)." ".strftime ("%B",$timestamp3) ?></h4> </center>
									<?
										}
										if (intval(	$val ["nbr_etape"])>3)
										{
										?>
										<!-- Affichage Date Etape 4 -->
											<?$timestamp4 = strtotime($val ["DateEtape4"]);?>
											<center> <h4 style="background-color: transparent;font-size:12px;"><?php echo strftime ("%d",$timestamp4)." ".strftime ("%B",$timestamp4) ?></h4> </center>
									<?
										}
                                        if (intval(	$val ["nbr_etape"])>4)
										{
										?>
										<!-- Affichage Date Etape 4 -->
											<?$timestamp4 = strtotime($val ["DateEtape5"]);?>
											<center> <h4 style="background-color: transparent;font-size:12px;"><?php echo strftime ("%d",$timestamp4)." ".strftime ("%B",$timestamp4) ?></h4> </center>
									<?
										}
									}
									?>
								</td>
								 <td>  
								<?php
									$chemin= 'courses/'.$val ["Nom_Course"].$Year."/info/images/logo.jpg";
									if (file_exists($chemin)) {
										echo '<img src="'.$chemin.'" alt=""  style="max-height:90px;max-width:100%;" /></a>'; 
	 
									}
									?>
								</td>
								<Td style="padding: 10px">
									<b style="background-color: transparent;font-size:24px">
										<?php echo $val ["Nom_Course"]; ?>
                                </b>
                                    <?php 
									if ( $val ["JuraDefi"])
									{
										?>
									<p>	<?PHP echo  $val ["Lieu"];?> </p>
									<?
									}
									else if (intval(	$val ["nbr_etape"])>1)
									{?>
										<p><?PHP echo "Course de ".  $val ["nbr_etape"]. " étapes / ". $val ["Lieu"];?> </p>
									<?}
									else
									{ ?>
										<p><?PHP echo  $val ["Lieu"];?> </p>
									<?
									} ?>
								</td>
								
								<td>

								<span class="dot2" id="<?php echo "Icons".$IdRace  ?>">
									 <i  style="vertical-align: middle;font-size:24px;"  class="fa fa-plus"></i>
								 </span>

								 <span style=" visibility: collapse;"  class="dot2" id="<?php echo "IconsMinus".$IdRace  ?>">
									  <i  style="vertical-align:middle;font-size:24px"  class="fa fa-minus" ></i>
								</span>
								</td>
							</tr>
							</Table>
						</td>
					</tr>   
					<tr style="visibility: collapse;display :none ;" id="<?php echo "Infos".$IdRace  ?>"  style="visibility: collapse">
						<td>
							<table width = 100%>
							<th width= 20%></th>
							<th width= 60%></th>

									<?
							
										if ( $today < $val ["DATE_END_INSCRIPTION"] && !$val ["InscriptionExtern"]  )
										{
										
											?>
										
											<?
											if ( $today > $val ["DateStartInscription"]  || $_SESSION['Niveau'] == 2)
											{
										?>
								
											<tr onClick="ViewRegistration(<?php echo $IdRace ?>)" onmouseover="" style="cursor: pointer;">
												<td>
												</td>
												<td>
													<span class="dot">
														<i class="fa fa-wpforms"  style= "font-size: 24px;margin:8px;margin-left:10px;color: #4095f5;"></i>
												
											
													    inscription
                                                    </span>
												</td>
											</tr>
										
									<?	
											}
											else
											{
											?>
												<tr>
													<td>
													</td>
													<td>
														<span class="dot">
															<i class="fa fa-wpforms"  style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
														
													
														    inscription pas encore ouverte
                                                        </span>
													</td>
												</tr>
												<?
											}
										}
									
									if ($today >= $val ["Date"] )
									{
										 if ( intval($val ["nbr_etape"])>1) 
										{
											if ($today >$val ["Date"] )
											{?>
											<tr onClick="ViewResult(<?php echo $IdRace ?>,1,<?php echo  intval($Year) ?>)" onmouseover="" style="cursor: pointer;">
												<td>
												</td>
												<td>
													<span class="dot">
														<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
													
										
													    Résultats étape 1
                                                    </span>
												</td>
											</tr>
											<?									
											}
											if ( intval($val ["nbr_etape"])>1 && $today >$val ["DateEtape2"] )
											{?>
											<tr onClick="ViewResult(<?php echo $IdRace ?>,2,<?php echo  intval($Year) ?>)" onmouseover="" style="cursor: pointer;">
												<td>
												</td>
												<td>
													<span class="dot">
														<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
									
													    Résultats étape 2
                                                    </span>
												</td>	
											</tr>
											<?
												if ( intval($val ["nbr_etape"])>2 && $today >$val ["DateEtape3"] )
												{?>
												<tr onClick="ViewResult(<?php echo $IdRace ?>,3,<?php echo  intval($Year) ?>)" onmouseover="" style="cursor: pointer;">
													<td>
													</td>
													<td>
														<span class="dot">
														    <i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
														    Résultats étape 3
                                                        </span>
													</td>	
												</tr>
												<?
												}
												if ( intval($val ["nbr_etape"])>3 && $today >$val ["DateEtape4"] )
												{?>
												<tr onClick="ViewResult(<?php echo $IdRace ?>,4,<?php echo  intval($Year) ?>)" onmouseover="" style="cursor: pointer;">
													<td>
													</td>
													<td>
															<span class="dot">
														<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>

														Résultats étape 4
                                                        </span>
													</td>	
												</tr>
												<?
												}
												if (intval($val ["nbr_etape"])>4 && $today >$val ["DateEtape5"] )
												{
													?>
												<tr onClick="ViewResult(<?php echo $IdRace ?>,5,<?php echo  intval($Year) ?>)" onmouseover="" style="cursor: pointer;">
													<td>
													</td>
													<td>
														<span class="dot">
														<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
														Résultats étape 5
                                                        </span>
													</td>	
												</tr>
												<?
												}
												if ( intval($val ["nbr_etape"])>1 && $today >$val ["DateEtape2"] )
												{
											?>
											<tr onClick="ViewResult(<?php echo $IdRace ?>,99,<?php echo  intval($Year) ?>)" onmouseover="" style="cursor: pointer;">
												<td>
												</td>
												<td>
													<span class="dot">
														<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
													    Résultats général
                                                    </span>
												</td>
											</tr>
											<?			
												}						
											}
										}
										else
										{
											
											if ($today >$val ["Date"] )
											{?>
											<tr onClick="ViewResult(<?php echo $IdRace ?>,0,<?php echo  intval($Year) ?>)" onmouseover="" style="cursor: pointer;">
												<td>
												</td>
												<td>
														<span class="dot">
														<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
													
						
													    Résultats
                                                    </span>
												</td>

											</tr>
											<?
											}
										}
									}
								if (!$val ["InscriptionExtern"]  && $val ["xNoListeDepart"] == false  )
								{
							
		?>	
								<tr onClick="ViewList(<?php echo $IdRace ?>)" onmouseover="" style="cursor: pointer;">
				
									<td>
									</td>
									<td>
										<span class="dot">
											<i class="fa fa-list" style= "font-size: 22px;margin:9px;color: #4095f5;"></i>
											liste de départ 
										</span>
									</td>
								
								</tr>
								<?
								}
									?>
									
								<tr onClick="ViewInfo(<?php echo $IdRace ?>)" onmouseover="" style="cursor: pointer;">
				
									<td>
									</td>
									<td>
										<span class="dot">
											<i class="fa fa-info" style= "font-size: 22px;margin:9px;margin-left:15px;color: #4095f5;"></i>
											Informations 
										</span>
									</td>
								
								</tr>
							</table>
						</td>
					</tr>
				</Form>	
			<?php
			}
		}
	}?>
	</table>	
</div>	
<?php
 }

?>	
</div>	      
    </body>    

</html>
<script type="text/javascript">
console.log(window.screen.availWidth);
console.log(window.screen.availHeight);

	function ClickRows(event, id)
    {  
		if (	document.getElementById("Infos"+id).style.display == "")
		{
			document.getElementById("RowRace"+id).style.backgroundColor = "#ffffff" ;
			document.getElementById("IconsMinus"+id).style.visibility = "collapse" ;
			document.getElementById("Icons"+id).style.visibility = "visible" ;
			document.getElementById("Infos"+id).style.visibility = "collapse" ;
			document.getElementById("Infos"+id).style.display = "none";
		}
		else
		{
			document.getElementById("RowRace"+id).style.backgroundColor = "#c9efff" ;
			document.getElementById("IconsMinus"+id).style.visibility = "visible" ;
			document.getElementById("Icons"+id).style.visibility = "collapse" ;
			document.getElementById("Infos"+id).style.visibility = "visible" ;
			document.getElementById("Infos"+id).style.display = "";
		}
	event.stopPropagation(); 
		
    }
	
	function ViewRegistration(id)
	{
		elmnt = document.getElementById("Formulaire"+id);
        // Depuis 2023
		if (id >105 )
		{
			elmnt.action = "formulaire2023.php";
		}
		// Depuis 2022
		else if (id >89 )
		{
			elmnt.action = "formulaireV3.php";
		}
		else
		{
			elmnt.action = "formulaireV2.php"
		}
	
		elmnt.submit();
	}
	
	function ViewInfo(id)
	{
		elmnt = document.getElementById("Formulaire"+id);
          // Depuis 2023
		if (id >105 )
		{
			elmnt.action = "informations2023.php";
		}
		// depuis 2022
		else if (id >89 )
		{
			elmnt.action = "informations2022.php";
		}
		else
		{
			elmnt.action = "informations.php"
		}
		elmnt.submit();
	}
	
	function ViewList(id)
	{
		elmnt = document.getElementById("Formulaire"+id);
                  // Depuis 2023
		if (id >105 )
		{
			elmnt.action = "liste2023.php";
		}
        else
        {
            elmnt.action = "listeV2.php"
        }
		
		elmnt.submit();
	}
	function ViewResult(id, NumEtape , Annee )
	{

			elmnt = document.getElementById("Formulaire"+id);
			elmnt.elements['Etape'].value = NumEtape ;

            if (id >105 )
		    {
			elmnt.action = "Resultat2023.php";
		    }
             else if ((Annee > 2019 && NumEtape >10 )|| Annee > 2021)
			{
				elmnt.action = "ResultatV4.php"
			}
			else
			{
				elmnt.action = "ResultatV3.php"
			}
			elmnt.submit();
	}
</script>	