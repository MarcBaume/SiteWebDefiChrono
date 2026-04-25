
<script type="text/javascript">
function dec2Hex(dec) {
    return Math.abs(dec).toString(16);
}
function getPixel(url, x, y) {
  var img = new Image();
  img.src = url;
  var canvas = document.createElement('canvas');
  var context = canvas.getContext('2d');
  context.drawImage(img, 0, 0);
  imageData =  context.getImageData(x, y, 1, 1);

   var r = dec2Hex( imageData.data[0]);
var g = dec2Hex(imageData.data[ 1]);
var b =dec2Hex( imageData.data[2]);

return ("#"+r+g+b);

}

function getURL( ValueFind, IDElement) {

		if (window.location.href.search(ValueFind)>-1)
		{
		//	document.getElementById(IDElement).style.backgroundColor = "#1e8ac2";
			//document.getElementById(IDElement).style.color = "white";
			document.getElementById(IDElement).classList.add("dotDisplayed");
			document.getElementById(IDElement).classList.remove("dot");

		}
		else
		{
		//	document.getElementById(IDElement).style.backgroundColor = "transparent";
			//document.getElementById(IDElement).style.color = " #3d6ca4";
			document.getElementById(IDElement).classList.add("dot");
			document.getElementById(IDElement).classList.remove("dotDisplayed");
		}
		
    }
function getURL2( ValueFind,  ValueFind2,IDElement) {

if (window.location.href.search(ValueFind)>-1 && window.location.href.search(ValueFind2)>-1)
{
//	document.getElementById(IDElement).style.backgroundColor = "#1e8ac2";
	//document.getElementById(IDElement).style.color = "white";
	document.getElementById(IDElement).classList.add("dotDisplayed");
	document.getElementById(IDElement).classList.remove("dot");

}
else
{
//	document.getElementById(IDElement).style.backgroundColor = "transparent";
	//document.getElementById(IDElement).style.color = " #3d6ca4";
	document.getElementById(IDElement).classList.add("dot");
	document.getElementById(IDElement).classList.remove("dotDisplayed");
}

}
function getOrURL2( ValueFind,  ValueFind2,IDElement) {

if (window.location.href.search(ValueFind)>-1 || window.location.href.search(ValueFind2)>-1)
{
//	document.getElementById(IDElement).style.backgroundColor = "#1e8ac2";
	//document.getElementById(IDElement).style.color = "white";
	document.getElementById(IDElement).classList.add("dotDisplayed");
	document.getElementById(IDElement).classList.remove("dot");

}
else
{
//	document.getElementById(IDElement).style.backgroundColor = "transparent";
	//document.getElementById(IDElement).style.color = " #3d6ca4";
	document.getElementById(IDElement).classList.add("dot");
	document.getElementById(IDElement).classList.remove("dotDisplayed");
}

}
</script>

	 <!--- Couverture --->
<?php
if (strlen($ANNEE_COURSE ) > 0 )
{
?>
<div class="PopupV2" style="display:none;"  id="popUPResult" >
<?php
$sqlResult = 'SELECT * FROM Course  WHERE KeyNomCourse=\''.$course ["KeyNomCourse"].'\'' ; 
$resultResult = mysqli_query($con,$sqlResult);
if ($resultResult && mysqli_num_rows($resultResult) > 0) 
{?>
  
<table>
  <?php
/**************************************************************************************************************33
* 
* 					HIstorique des courses
* 
*******************************************************************************************************************/

	  // output data of each row
  while($courseResult = mysqli_fetch_assoc($resultResult)) 
  {
	  $DateResult =  date_parse($courseResult['Date']);	
	  $NomCourse = $courseResult['Nom_Course'];
	  // si année différentes de l'année en cours
	  if ($DateResult['year']<> $ANNEE_COURSE)
	  {
		  ?>
		  <tr  >
		  <td>
			  <div style= "margin:5px;background: #00b4ff;padding:5px">
			  <i class="fa fa-trophy" style= "font-size: 24px;margin:5px;color: white;"></i>
		  <?php
		  // Multi étape 
		  if (intval($courseResult['nbr_etape'])>1)
		  {
			  if ($DateResult['year']> 2022)
			  {
				  
				  ?>
				  <a href="<?php echo "Resultat2023.php?&NbrEtape=".$courseResult['nbr_etape']."&DateCourse=".$courseResult['Date']."&NomCourse=".$NomCourse?>" style= "font-size: 16px;margin:5px;color: black;" ><? echo $DateResult['year'];?></a>
				  <?php
			  }
			  else   if ($DateResult['year']> 2021)
			  {
				  
				  ?>
				  <a href="<?php echo "ResultatV4.php?&NbrEtape=".$courseResult['nbr_etape']."&DateCourse=".$courseResult['Date']."&NomCourse=".$NomCourse?>" style= "font-size: 16px;margin:5px;color: black;" ><? echo $DateResult['year'];?></a>
				  <?php
			  }
			  else
			  {
				  ?>
				  <a href="<?php echo "informati	ons.php?&NbrEtape=".$courseResult['nbr_etape']."&DateCourse=".$courseResult['Date']."&NomCourse=".$NomCourse?>" style= "font-size: 16px;margin:5px;color: black;" ><? echo $DateResult['year'];?></a>
					  <?php
			  }
		  }
		  // Selon l'année affichage des résultats
		  else if ($DateResult['year']> 2021)
		  {
			  
			  ?>
			  <a href="<?php echo "ResultatV4.php?Etape=0&NbrEtape=".$courseResult['nbr_etape']."&DateCourse=".$courseResult['Date']."&NomCourse=".$NomCourse?>" style= "font-size: 16px;margin:5px;color: black;"><?	echo $DateResult['year'];?></a>
			  <?
		  }
		  else
		  {
			  ?>
			  <a href="<?php echo "ResultatV3.php?Etape=0&NbrEtape=".$courseResult['nbr_etape']."&DateCourse=".$courseResult['Date']."&NomCourse=".$NomCourse?>" style= "font-size: 16px;margin:5px;color: black;"><?	echo  $DateResult['year'];?></a>
				  <?php
		  }
		  ?>
		  </div>
		  </td>
		  </tr><?php
	  }
  }
  ?>
  </table>

<?php
}
/**************************************************************************************************************33
* 
* En tête de la course
* 
*******************************************************************************************************************/
?>

</div>

 	<table  style="width:100%;Padding:0px;"  class="HeaderRace">
		<tr style="width:100%">
			<td style="width:80%" >
			<table>
				<tr>
					<td>
					
			<?php
				$chemin= 'courses/'.$NOM_COURSE. $ANNEE_COURSE."/info/images/logo.jpg";
				if (file_exists($chemin)) {
					?>
					<border  >
					<?php
					echo '<img id="BorderLogo" src="'.$chemin.'" alt=""  style="max-height:60px;max-width:100%;margin:5px;" /></a>'; 
					?>
					</border>
					<script>
						console.log("10px solid "+ getPixel(<?php echo json_encode($chemin) ?>, 1, 1));
					document.getElementById("BorderLogo").style.border  = "5px solid "+ getPixel(<?php echo json_encode($chemin) ?>, 1, 1);
					document.getElementById("BorderLogo").style.borderRadius = "10px";
					</script>
<?php
				}
				?>
					</td>
					<td>
						<a  style="vertical-align:middle">
			<!--	<i class="fa fa-calendar" style= "color :#3D6CA4;font-size: 25px;margin-right:10px;"></i> --> <?php  echo $NOM_COURSE. ' ' . $ANNEE_COURSE ?>
						</a>
					</td>
				</tr>
			</table>
			</td>
			<td style="width:20%" style="width:30px;">
				<span class="dot" style="background: #BCDDFD;margin:0px" >
					<table  onClick="VisiblePopUPHisto()">
						<tr>
							<td style="width:30px">
								<i class="fa fa-trophy" style= "font-size: 18px;margin:0px;margin-right: 9px;"></i>
							</td>
							<td style="padding-left: 10px;font-size: 12px;font-weight :normal">
								Anciennes éditions 
							</td>
						</tr>
					</table>
				</span>
			</td>
		</tr>
	</table>

<div  class="menu_vertical"  id= "Header" style="margin-top:10px; z-index:1040;" >

 	<form method="get" id="Menu" >
				
		<input type="hidden" name="Etape" id="Etape" value= 0 />
		<input type="hidden" name="NbrEtape" id="NbrEtape" value= '<?php echo  $Nbr_etape ?>' />
		<input type="hidden" name="DateCourse" id="DateCourse" tabindex="10"  size="60"  value= '<?php echo $DateCourse ?>' />
		<input type="hidden" name="NomCourse" id="NomCourse" tabindex="10"  size="60"  value= '<?php echo $NOM_COURSE ?>' />				

	<Table   style="width:100%;"  >
	<tr>
	<?php

			if (strlen($Site ) > 0 )
			{
			?>
			<td class="ColMenuInfo"  onClick="ClickRows()" onmouseover="" style="cursor: pointer;">
				<span class="dot" id="<?php echo "RowRace5".$IdRace ?>">
					<table>
						<tr  >
							<td style="width:30px">
								<i class="fa fa-globe" style= "font-size: 35px;margin:0px;margin-left: 9px;"></i>
							
							</td>
							<td style="padding-left: 10px;">
								Site 
							</td>
						</tr>
						<script>
							getURL( "Site","<?php echo "RowRace5".$IdRace ?>" ) ;
						</script>
					</table>
				</span>
			</td>

			<?php
			}
			?>
        	<td class="ColMenuInfo" onClick="ClickRowsInformation()" onmouseover="" style="cursor: pointer;" >  
				<span class="dot" id="<?php echo "RowRace4".$IdRace ?>">
					<table>
						<tr >
							<td style="width:30px">
								<i class="fa fa-info" style= "font-size: 35px;margin:0px; margin-left: 15px;"></i>
							</td>
							<td style="padding-left: 10px;">
								Informations
							</td>
						</tr>
						<script>
							getURL( "informations","<?php echo "RowRace4".$IdRace ?>" ) ;
						</script>
					</table>
				</span>
</td>
				<?php
				if ( $course["xNoListeDepart"] == False)
				{
				?>
					<td class="ColMenuInfo"  onClick="ClickRowsListe()" onmouseover="" style="cursor: pointer;">
						<span class="dot" id="<?php echo "RowRace".$IdRace ?>">
							<table>
							
								<tr   >
									<td style="width:30px">
										
											<i class="fa fa-list" style= "font-size: 30px;margin:2px;"></i>
									
									</td>
									<td style="padding-left: 10px;">
										Liste de départ
									</td>
								</tr>
								<script>
									getURL( "liste2023","<?php echo "RowRace".$IdRace ?>" ) ;
								</script>
							</table>
						</span>
					</td>
					<?php
				}
				
				if ( $today < $course ["DATE_END_INSCRIPTION"]  && !$course ["InscriptionExtern"] )
				{
				?>
				<Td class="ColMenuInfo"   onClick="ClickRowsForm()" onmouseover="" style="cursor: pointer;">
					<span class="dot"  id="<?php echo "RowRace3".$IdRace ?>">
						<table>
						
							<tr>
							<td style="width:30px">
								
									<i class="fa fa-wpforms" style= "font-size: 25px;margin:8px;"></i>
							
							</td>
							<td style="padding-left: 10px;">
								Inscription
							</td>
						</tr>
						<script>
							getURL( "formulaire","<?php echo "RowRace3".$IdRace ?>" ) ;
						</script>
					</table>
					</span>
						
				</td>
				<?php
				}
			
				if ($today >$course ["Date"])
				{?>
				<td class="ColMenuInfo" onClick="ClickRowsResultat()" onmouseover="" style="cursor: pointer;">
					<span class="dot"  id="<?php echo "RowRace2".$IdRace ?>">
						<table>
							<tr   >
								<td style="width:30px">
								
										<i class="fa fa-trophy" style= "font-size: 35px;margin:2px;"></i>
								
								
								</td>
								<td style="padding-left: 10px;">
									Résultats
								</td>
							</tr>
							<script>
								getOrURL2( "Resultat","Live","<?php echo "RowRace2".$IdRace ?>" ) ;
							</script>		
						</table>
					</span>
				</td>
				<?php
				}
				$chemin= 'courses/'.$NOM_COURSE. $ANNEE_COURSE."/info/Photos";
				if (file_exists($chemin)) {
					?>
					<td class="ColMenuInfo" onClick="ClickRowsPhotos()" onmouseover="" style="cursor: pointer;">
					<span class="dot"  id="<?php echo "RowRace6".$IdRace ?>">
						<table>
							<tr   >
								<td style="width:30px">
								
										<i class="fa fa-camera" style= "font-size: 35px;margin:2px;"></i>
								
								
								</td>
								<td style="padding-left: 10px;">
									Photos
								</td>
							</tr>
							<script>
								getURL( "Photos","<?php echo "RowRace6".$IdRace ?>" ) ;
							</script>		
						</table>
					</span>
				</td>
					<?php
				}
				
			}
		?>
		</tr>		
				</table>
		</form>

	</div>	
<script type="text/javascript">
function ClickRows( )
    {  

		var site =  <?php echo json_encode($Site ); ?>;
		if (site.indexOf("http")>-1)
		{
			window.open(site, '_blank');
		}
		else
		{			
			window.open('http://www.'+site , '_blank');
		}
	}
	function ClickRowsListe(elmnt )
    {  
	elmnt = document.getElementById("Menu");
	elmnt.action = "liste2023.php";
		elmnt.submit();
	}
	function ClickRowsForm(elmnt )
    {  
	elmnt = document.getElementById("Menu");
	if (<?php echo json_encode($ANNEE_COURSE); ?> > 2022)
		{
			elmnt.action = "formulaire2023.php";
		}
	else if (<?php echo json_encode($ANNEE_COURSE); ?> > 2021)
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
	if ( <?php echo json_encode($ANNEE_COURSE ); ?> > 2019 &&  <?php echo json_encode($Nbr_etape ); ?> >10 )
	{
		elmnt.action = "Live.php";
	}
	else
	{
		elmnt.action = "Resultat2023.php";
	}

		elmnt.submit();
	}

	function ClickRowsPhotos(elmnt )
    {  
	elmnt = document.getElementById("Menu");
	
		elmnt.action = "Photos.php";

		elmnt.submit();
	}
	function ClickRowsInformation(elmnt)
    {  
		elmnt = document.getElementById("Menu");
		elmnt.action = "informations.php";
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
				elmnt.action = "Resultat2023.php"
			}
			elmnt.submit();
	}

  	  // Calcul grandeur des colonne pour arrivée au 100%
        ChangeStyleCol();
function ChangeStyleCol()
{
 var TabArr =   document.getElementsByClassName("ColMenuInfo");
    console.log(TabArr);
    for (var i = 0; i < TabArr.length; i++) 
    {
        // Selon la longueur du tableau la dimension des column va auguementer
        TabArr[i].style.width = (90 /TabArr.length)+"%";
    }
}

function VisiblePopUPHisto() { 

	console.log(document.getElementById("popUPResult"))
 if (document.getElementById("popUPResult").style.display != "block") 
 {
;
	document.getElementById("popUPResult").style.display = "block";
}
 else
 {
	console.log("Close");
	document.getElementById("popUPResult").style.display = "none";
}

};
</script>	
</div>