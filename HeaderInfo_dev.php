
<div id="menu_vertical">
<li>

   </li>
   <script type="text/javascript">
function getURL( ValueFind, IDElement) {
		if (window.location.href.search(ValueFind)>-1)
		{
			document.getElementById(IDElement).style.backgroundColor = "#11539e";
		}
		else
		{
			document.getElementById(IDElement).style.backgroundColor = "transparent";
		}
       
    }
</script>
<?php
 
if ( strlen($_POST['DateCourse'])>0)
{
$DateCourse =  $_POST['DateCourse'];
$Date =  date_parse($_POST['DateCourse']);
$ANNEE_COURSE = $Date['year']; 
$Month = $Date['month']; 
$Day = $Date['day']; 

//$ANNEE_COURSE = $_POST['annee_course'];
$NOM_COURSE = $_POST["NomCourse"];
$Nbr_etape =  $_POST["NbrEtape"] ;

}
else if  ( strlen($_GET['DateCourse'])>0)
{
$DateCourse =  $_GET['DateCourse'];
$Date =  date_parse($_GET['DateCourse']);
$ANNEE_COURSE = $Date['year']; 
$Month = $Date['month']; 
$Day = $Date['day']; 

//$ANNEE_COURSE = $_GET['annee_course'];
$NOM_COURSE = $_GET["NomCourse"];
$Nbr_etape =  $_GET["NbrEtape"] ;

}

if (strlen($ANNEE_COURSE ) > 0 )
{

/*************************** CONNECTION AVEC LA BASE DE DONNEES ***********************************/
  $con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
   if (!$con)
  {
		die('Could not connect: ' . mysql_error());
  }
  else
  {
		mysqli_select_db($con ,'dxvv_jurachrono' );
		// ***************************************** AFFICHAGE BASE de Donnée ***************************************
		$sql = 'SELECT * FROM Course  WHERE Nom_course=\''.$NOM_COURSE.'\'AND Date=\''.$DateCourse.'\'OR DateEtape2=\''.$DateCourse.'\'OR DateEtape3=\''.$DateCourse.'\'OR DateEtape4=\''.$DateCourse.'\'OR DateEtape5=\''.$DateCourse.'\'' ; 
		$result = mysqli_query($con,$sql);
		if ($result && mysqli_num_rows($result) > 0) 
		{
			
			// output data of each row
			while($val1 = mysqli_fetch_assoc($result)) 
			{
				$Site = $val1['Site'];
				$val = $val1;
			}
		}
	}

 session_start();
 
 ?>
 	<form method="get" id="Menu" >
	
			
				<input type="hidden" name="Etape" id="Etape" value= 0 />
				
				<input type="hidden" name="NbrEtape" id="NbrEtape" value= '<?php echo  $Nbr_etape ?>' />
				<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $DateCourse ?>' />
				<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $NOM_COURSE ?>' />				
	
	
	<Table>
	<tr>
	<?

			if (strlen($Site ) > 0 )
			{
			?>
			<td>
				<table>
					<tr id="<?php echo "RowRace5".$IdRace ?>" onClick="ClickRows()" onmouseover="" style="cursor: pointer;" style="Width : 25%">
						<td>
						<span class="dot">
							<i class="fa fa-globe" style= "font-size: 25px;margin:7px;margin-left: 9px;color: #4095f5;"></i>
						</span>
						
						</td>
						<td>
							<p>Site </p>
						</td>
					</tr>
				</table>
				</td>
			<?php
			}
			?>
	<td>
				<table>
					<tr id="<?php echo "RowRace4".$IdRace ?>" onClick="ClickRowsInformation()" onmouseover="" style="cursor: pointer;" style="Width : 25%">
						<td>
							<span class="dot">
								<i class="fa fa-info" style= "font-size: 25px;margin:8px; margin-left: 15px; color: #4095f5;"></i>
							</span>
						</td>
						<td>
							<p>Informations </p>
						</td>
					</tr>
				</table>

</td>
				<?php
				if ( $val["xNoListeDepart"] == False)
				{
				?>
					<td>
						<table>
							<tr id="<?php echo "RowRace".$IdRace ?>" onClick="ClickRowsListe()" onmouseover="" style="cursor: pointer;"  style="Width : 25%">
							<td>
								<span class="dot">
									<i class="fa fa-list" style= "font-size: 22px;margin:9px;color: #4095f5;"></i>
								</span>
							</td>
							<td>
								<p >Liste de départ </p>
							</td>
						</table>
					</td>
					<?
				}
				
				if ( $today < $val ["DATE_END_INSCRIPTION"] && !$val ["InscriptionExtern"])
				{
				?>
				<Td>
					<table>
						<tr id="<?php echo "RowRace3".$IdRace ?>" onClick="ClickRowsForm()" onmouseover="" style="cursor: pointer;" style="Width : 25%">
						<td>
							<span class="dot">
								<i class="fa fa-wpforms" style= "font-size: 25px;margin:8px;color: #4095f5;"></i>
							</span>
						
						</td>
						<td>
							<p >Inscription </p>
						</td>
					</tr>
				</table>
				</td>
				<?php
				}
	//			else !! inscription toujours possible si la première étape est réalisé
	//			{
					if ($Nbr_etape < 2 )
					{
						if ($today >$val ["Date"])
						{?>
						<td>
							<table>
								<tr id="<?php echo "RowRace2".$IdRace ?>" onClick="ClickRowsResultat()" onmouseover="" style="cursor: pointer;"  style="Width : 25%">
									<td>
										<span class="dot">
											<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
										</span>
									
									</td>
									<td>
										<p >Résultats </p>
									</td>
								</tr>
							</table>
						</td>
						<?php
						}
					}
					else
					{
						?>
						<tr>
						<?
						if ($today >$val ["Date"] )
						{?>
							<td>
								<table>
									<tr onClick="ViewResult(1,<?php echo  intval($ANNEE_COURSE) ?>)" onmouseover="" style="cursor: pointer;">
									<td>
											<span class="dot">
											<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
										</span>
									</td>
									<td>
										<?php
										if ($val["JuraDefi"] ==1 && $ANNEE_COURSE ==2021)
										{ ?>
												<p>Roller</p>
										<?
										}
										else
										{
										?>
										<p>Etape 1</p>
										<?
										}?>
									</td>
									</tr>
								</table>
							</td>
						<?									
						}
						if ( intval($val ["nbr_etape"])>1 && $today >$val ["DateEtape2"] )
						{?>
							<td>
								<table>
									<tr onClick="ViewResult(2,<?php echo  intval($ANNEE_COURSE) ?>)" onmouseover="" style="cursor: pointer;">
									<td>
											<span class="dot">
											<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
										</span>
									</td>
									<td>
									<?php
										if ($val["JuraDefi"] ==1 && $ANNEE_COURSE ==2021)
										{ ?>
												<p>Course à pied</p>
										<?
										}
										else
										{
										?>
										<p>Etape 2</p>
										<?
										}?>
									</td>
									</tr>
								</table>
							</td>
						<?
						}
						if ( intval($val ["nbr_etape"])>2 && $today >$val ["DateEtape3"] )
						{?>
							<td>
								<table>
									<tr onClick="ViewResult(3,<?php echo  intval($ANNEE_COURSE) ?>)" onmouseover="" style="cursor: pointer;">
									<td>
											<span class="dot">
											<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
										</span>
									</td>
									<td> <?
									if ($val["JuraDefi"] ==1 && $ANNEE_COURSE ==2021)
										{ ?>
												<p>Vélo</p>
										<?
										}
										else
										{
										?>
										<p>Etape 3</p>
										<?
										}?>
									</td>
									</tr>
								</table>
							</td>
						<?
						}
						if ( intval($val ["nbr_etape"])>3 && $today >$val ["DateEtape4"] )
						{?>
							<td>
								<table>
									<tr onClick="ViewResult(4,<?php echo  intval($ANNEE_COURSE) ?>)" onmouseover="" style="cursor: pointer;">
									<td>
											<span class="dot">
											<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
										</span>
									</td>
									<td><?
									if ($val["JuraDefi"] ==1 && $ANNEE_COURSE ==2021)
										{ ?>
												<p>VTT</p>
										<?
										}
										else
										{
										?>
										<p>Etape 4</p>
										<?}?>
									</td>
									</tr>
								</table>
							</td>
						<?
						}
						if (intval($val ["nbr_etape"])>4 && $today >$val ["DateEtape5"] )
						{
							?>
							<td>
								<table>
									<tr onClick="ViewResult(5,<?php echo  intval($ANNEE_COURSE) ?>)" onmouseover="" style="cursor: pointer;">
									<td>
											<span class="dot">
											<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
										</span>
									</td>
									<td>
										<p>Etape 5</p>
									</td>
									</tr>
								</table>
							</td>
						<?
						}	
						if ( intval($val ["nbr_etape"])>1 && $today >$val ["DateEtape2"] )
						{?>
							<td>
								<table>
									<tr onClick="ViewResult(99,<?php echo  intval($ANNEE_COURSE) ?>)" onmouseover="" style="cursor: pointer;">
									<td>
											<span class="dot">
											<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #4095f5;"></i>
										</span>
									</td>
									<td>
										<p>Général</p>
									</td>
									</tr>
								</table>
							</td>
						<?
						}	
						?>
										
						<?
				//	}
			}
		?>
		</tr>		
				</table>
		</form>
		</div>	
	<?php
		
}	

	?>
	 <!--- Couverture --->
<?php
	$chemin= 'courses/'.$NOM_COURSE.$ANNEE_COURSE."/info/images/couverture.jpg";
	if (file_exists($chemin)) {
		echo '<img src="'.$chemin.'" alt=""  WIDTH=100% /></a>'; 
 }
 
?>

      
<script type="text/javascript">

		function ClickRows( )
    {  

		window.open('http://www.'+ <?php echo json_encode($Site ); ?> , '_blank');
	}
	function ClickRowsListe(elmnt )
    {  
	elmnt = document.getElementById("Menu");
	elmnt.action = "listeV2.php";
		elmnt.submit();
	}
	function ClickRowsForm(elmnt )
    {  
	elmnt = document.getElementById("Menu");
		if (<?php echo json_encode($ANNEE_COURSE); ?> > 2021)
		{
			elmnt.action = "formulaireV3.php";
		}
		else
		{
			elmnt.action = "formulaireV2.php";
		}
		elmnt.submit();
	}
	function ClickRowsResultat(elmnt )
    {  
	elmnt = document.getElementById("Menu");
	if ( (<?php echo json_encode($ANNEE_COURSE ); ?> > 2019 &&  <?php echo json_encode($Nbr_etape ); ?> >10) || <?php echo json_encode($ANNEE_COURSE ); ?> > 2021)
	{
		elmnt.action = "ResultatV4.php";
	}
	else
	{
		elmnt.action = "ResultatV3.php";
	}

		elmnt.submit();
	}
	function ClickRowsInformation(elmnt)
    {  
		elmnt = document.getElementById("Menu");
		if (<?php echo json_encode($ANNEE_COURSE); ?> > 2021)
		{
			elmnt.action = "informations2022.php";
		}
		else
		{
			elmnt.action = "informations.php";
		}

		elmnt.submit();
	}
	function ViewResult( NumEtape , Annee )
	{
			elmnt = document.getElementById("Menu");
			elmnt.elements['Etape'].value = NumEtape ;
			if ((Annee > 2019 && NumEtape >10 )||Annee > 2021 )
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