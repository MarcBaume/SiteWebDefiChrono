<!DOCTYPE html>
<html>
<head>
	<meta property="og:description" content="chronométrage, chrono, jura, franches-montagnes, Jura défi, course à pied, Sport, Jura défi chrono" />  
	<title>Défi Chrono</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=yes">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" title="defaut" media="screen" href="styleV2.css" type="text/css"/>
<!--	<link rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" href="style-mobilV2.css" /> -->
</head>

    <body>

<?php
  include("Header.php"); 
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
				
				 <tr style="background: #4095f5;"   >
					<td><center> <p style="color:white;margin:5px; font-size:16px; font-weight:bold;"> <?php echo $Year?> </p></center></td>
				 </tr>
			<?php
			}
			if ($MonthBuffer <> $Month)
			{
				// Creat a row with the Year 
				$MonthBuffer = $Month;
				?>
				
				 <tr style="background: #7adbf7;"  >
					<td ><center><p style="color:black; margin:5px; font-size:16px; font-weight:bold; "><?php echo  strftime ("%B",$timestamp)?> </p></center></td>
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
	
				<tr id="<?php echo "RowRace".$IdRace ?>" onClick="ClickRows( event, <?php echo $IdRace ?>)">
					<td >
						<table width = 100% >
						
						<th width= 8%></th>
						<th width= 8%></th>
						<th width= 15%></th>
						<th width= 35%></th>
						<th width= 23%></th>
						<th width= 5%></th>
						<tr>	
							<td ><?
							if ($val ["Type"] == "Bike")
							{
							?>
								<center> <img src="images/Bike.png" style="width:40px"> </img></center>
								
								<?
								
							}
							else if ($val ["Type"] == "Multi")
							{?>
									<center> <img src="images/Multi.png" style="width:60px"> </img></center> <?
								
								
							}
							else
							{?>
									<center> <img src="images/Coureur.png" style="width:40px"> </img></center> <?
							}
							
								?>
							</td>						
							<td >
								<center> <h3><?php echo $Day ?></h3> </center>
							</td>
							 <td>  
							<?php
								$chemin= 'courses/'.$val ["Nom_Course"].$Year."/info/images/logo.jpg";
								if (file_exists($chemin)) {
									echo '<img src="'.$chemin.'" alt=""  WIDTH=100px /></a>'; 
 
								}
								?>
							</td>
							<Td style="padding: 10px">
								<h3>
									<?php echo $val ["Nom_Course"]; ?>
								</h3>
							</td>
							<td><?PHP echo  $val ["Lieu"];?> </td>
							<td>
							<span class="dot2" id="<?php echo "Icons".$IdRace  ?>">
								 <i  style="  margin:3.2px;"  class="fa fa-plus"></i>
							 </span>
							 <span style=" visibility: collapse;"  class="dot2" id="<?php echo "IconsMinus".$IdRace  ?>">
								  <i  style="  margin:3.2px;"  class="fa fa-minus" ></i>
							</span>
							</td>
						</tr>
						</Table>
					</td>
				</tr>   
				<tr style="visibility: collapse" id="<?php echo "Infos".$IdRace  ?>"  style="visibility: collapse">
					<td>
						<table width = 100%>
						<th width= 20%></th>
						<th width= 20%></th>
						<th width= 40%></th>
						<th width= 20%></th>

								<?
								if ($today <$val ["Date"] )
								{
									if ( $today < $val ["DATE_END_INSCRIPTION"] )
									{
									
									?>
							
									<tr onClick="ViewRegistration(<?php echo $IdRace ?>)">
										<td>
										</td>
										<td>
											<span class="dot">
												<i class="fa fa-wpforms"  style= "font-size: 20px;margin:5px;color: #4095f5;"></i>
											</span>
										</td>
										<td>
											</i><p>inscription</p>
										</td>
									</tr>
									
								<?	
									}
								}
								 if ( intval($val ["nbr_etape"])>1) 
								{
									if ($today >$val ["Date"] )
									{?>
									<tr onClick="ViewResult(<?php echo $IdRace ?>,1)">
										<td>
										</td>
										<td>
												<span class="dot">
												<i class="fa fa-trophy" style= "font-size: 20px;margin:5px;color: #4095f5;"></i>
											</span>
										</td>
										<td>
											</i><p>Résultats étape 1</p>
										</td>
									</tr>
									<?									
									}
									if ( intval($val ["nbr_etape"])>1 && $today >$val ["DateEtape2"] )
									{?>
									<tr onClick="ViewResult(<?php echo $IdRace ?>,2)">
										<td>
										</td>
										<td>
												<span class="dot">
												<i class="fa fa-trophy" style= "font-size: 20px;margin:5px;color: #4095f5;"></i>
											</span>
										</td>
										<td>
											</i><p>Résultats étape 2</p>
										</td>	
									</tr>
									<?
										if ( intval($val ["nbr_etape"])>2 && $today >$val ["DateEtape3"] )
										{?>
										<tr onClick="ViewResult(<?php echo $IdRace ?>,3)">
											<td>
											</td>
											<td>
												<span class="dot">
												<i class="fa fa-trophy" style= "font-size: 20px;margin:5px;color: #4095f5;"></i>
											</span>
											</td>
											<td>
												</i><p>Résultats étape 3</p>
											</td>	
										</tr>
										<?
										}
										if ( intval($val ["nbr_etape"])>3 && $today >$val ["DateEtape4"] )
										{?>
										<tr onClick="ViewResult(<?php echo $IdRace ?>,4)">
											<td>
											</td>
											<td>
													<span class="dot">
												<i class="fa fa-trophy" style= "font-size: 20px;margin:5px;color: #4095f5;"></i>
											</span>
											</td>
											<td>
												</i><p>Résultats étape 4</p>
											</td>	
										</tr>
										<?
										}
										if (intval($val ["nbr_etape"])>4 && $today >$val ["DateEtape5"] )
										{
											?>
										<tr onClick="ViewResult(<?php echo $IdRace ?>,5)">
											<td>
											</td>
											<td>
													<span class="dot">
												<i class="fa fa-trophy" style= "font-size: 20px;margin:5px;color: #4095f5;"></i>
											</span>
											</td>
											<td>
												</i><p>Résultats étape 5</p>
											</td>	
										</tr>
										<?
										}
									?>
									<tr onClick="ViewResult(<?php echo $IdRace ?>,99)">
										<td>
										</td>
										<td>
												<span class="dot">
												<i class="fa fa-trophy" style= "font-size: 20px;margin:5px;color: #4095f5;"></i>
											</span>
										</td>
										<td>
											</i><p>Résultats général</p>
										</td>
									</tr>
									<?									
									}
								}
								else
								{
									
									if ($today >$val ["Date"] )
									{?>
									<tr onClick="ViewResult(<?php echo $IdRace ?>,0)">
										<td>
										</td>
										<td>
												<span class="dot">
												<i class="fa fa-trophy" style= "font-size: 20px;margin:5px;color: #4095f5;"></i>
											</span>
										</td>
										<td>
											</i><p>Résultats</p>
										</td>
									</tr>
									<?
									}
								}
								?>
									<?
							if (!$val ["InscriptionExtern"] )
{
	?>	
							<tr onClick="ViewList(<?php echo $IdRace ?>)">
			
								<td>
								</td>
								<td>
									<span class="dot">
												<i class="fa fa-list" style= "font-size: 20px;margin:5px;color: #4095f5;"></i>
											</span>
								</td>
								<td>
									
										<p >liste de départ </p>
									
								</td>
							
							</tr>
							<?
}
								?>
						</table>
					</td>
				</tr>
			</Form>	
		<?php
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

		function ClickRows(event, id)
    {  
	
	
		if (	document.getElementById("Infos"+id).style.visibility == "visible")
		{
			document.getElementById("RowRace"+id).style.backgroundColor = "#ffffff" ;
		document.getElementById("IconsMinus"+id).style.visibility = "collapse" ;
		document.getElementById("Icons"+id).style.visibility = "visible" ;
		document.getElementById("Infos"+id).style.visibility = "collapse" ;
		}
		else
		{
			document.getElementById("RowRace"+id).style.backgroundColor = "#c9efff" ;
			document.getElementById("IconsMinus"+id).style.visibility = "visible" ;
		document.getElementById("Icons"+id).style.visibility = "collapse" ;
			document.getElementById("Infos"+id).style.visibility = "visible" ;
		}
	event.stopPropagation(); 
		
    }
	
	function ViewRegistration(id)
	{
		elmnt = document.getElementById("Formulaire"+id);
		elmnt.action = "formulaireV2.php"
		elmnt.submit();
	}
	function ViewList(id)
	{
			elmnt = document.getElementById("Formulaire"+id);
		elmnt.action = "listeV2.php"
			elmnt.submit();
	}
	function ViewResult(id, NumEtape )
	{
			elmnt = document.getElementById("Formulaire"+id);
			elmnt.elements['Etape'].value = NumEtape ;
			elmnt.action = "ResultatV2.php"
			elmnt.submit();
	}
</script>	