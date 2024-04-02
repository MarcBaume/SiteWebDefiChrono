
<div id="menu_vertical"  id= "Header" style="position: fixed ; position: absolut; margin-top: 100px;z-index:1040;" >
<li>

   </li>
  
   <script type="text/javascript">
function getURL( ValueFind, IDElement) {

		if (window.location.href.search(ValueFind)>-1)
		{
			document.getElementById(IDElement).style.backgroundColor = "#1e8ac2";
			document.getElementById(IDElement).style.color = "white";
		}
		else
		{
			document.getElementById(IDElement).style.backgroundColor = "transparent";
			document.getElementById(IDElement).style.color = "black";
		}
       
    }
function getURL2( ValueFind,  ValueFind2,IDElement) {

if (window.location.href.search(ValueFind)>-1 && window.location.href.search(ValueFind2)>-1)
{
	document.getElementById(IDElement).style.backgroundColor = "#1e8ac2";
	document.getElementById(IDElement).style.color = "white";
}
else
{
	document.getElementById(IDElement).style.backgroundColor = "transparent";
	document.getElementById(IDElement).style.color = "black";
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
	
	
	<Table  style="width:100%;">
	<tr>
	<?

			if (strlen($Site ) > 0 )
			{
			?>
			<td class="ColMenuInfo" id="<?php echo "RowRace5".$IdRace ?>">
				<table>
					<tr  onClick="ClickRows()" onmouseover="" style="cursor: pointer;" style="Width : 25%">
						<td>
						<span class="dot">
							<i class="fa fa-globe" style= "font-size: 25px;margin:7px;margin-left: 9px;color: #3d6ca4;"></i>
						</span>
						
						</td>
						<td>
							Site 
						</td>
					</tr>
                    <script>
                        getURL( "Site","<?php echo "RowRace5".$IdRace ?>" ) ;
                     </script>
				</table>
				</td>
			<?php
			}
			?>
        	<td class="ColMenuInfo"  id="<?php echo "RowRace4".$IdRace ?>">  
				<table>
					<tr onClick="ClickRowsInformation()" onmouseover="" style="cursor: pointer;" style="Width : 25%">
						<td>
							<span class="dot">
								<i class="fa fa-info" style= "font-size: 25px;margin:8px; margin-left: 15px; color: #3d6ca4;"></i>
							</span>
						</td>
						<td>
							Informations
						</td>
					</tr>
                    <script>
                        getURL( "informations","<?php echo "RowRace4".$IdRace ?>" ) ;
                     </script>
				</table>

</td>
				<?php
				if ( $val["xNoListeDepart"] == False)
				{
				?>
					<td class="ColMenuInfo" id="<?php echo "RowRace".$IdRace ?>">
						<table>
							<tr  onClick="ClickRowsListe()" onmouseover="" style="cursor: pointer;"  style="Width : 25%">
								<td>
									<span class="dot">
										<i class="fa fa-list" style= "font-size: 22px;margin:9px;color: #3d6ca4;"></i>
									</span>
								</td>
								<td>
									Liste de départ
								</td>
							</tr>
							<script>
								getURL( "liste","<?php echo "RowRace".$IdRace ?>" ) ;
							</script>
						</table>
					</td>
					<?
				}
				
				if ( $today < $val ["DATE_END_INSCRIPTION"]  && !$val ["InscriptionExtern"] )
				{
				?>
				<Td class="ColMenuInfo" id="<?php echo "RowRace3".$IdRace ?>">
					<table>
						<tr  onClick="ClickRowsForm()" onmouseover="" style="cursor: pointer;" style="Width : 25%">
						<td>
							<span class="dot">
								<i class="fa fa-wpforms" style= "font-size: 25px;margin:8px;color: #3d6ca4;"></i>
							</span>
						
						</td>
						<td>
							Inscription
						</td>
					</tr>
					<script>
						getURL( "formulaire","<?php echo "RowRace3".$IdRace ?>" ) ;
					</script>
				</table>
				</td>
				<?php
				}
					if ($Nbr_etape < 2 )
					{
						if ($today >$val ["Date"])
						{?>
						<td class="ColMenuInfo" id="<?php echo "RowRace2".$IdRace ?>">
							<table>
								<tr  onClick="ClickRowsResultat()" onmouseover="" style="cursor: pointer;"  style="Width : 25%">
									<td>
										<span class="dot">
											<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #3d6ca4;"></i>
										</span>
									
									</td>
									<td>
										Résultats
									</td>
								</tr>
								<script>
									getURL2( "Resultat","Etape=0","<?php echo "RowRace2".$IdRace ?>" ) ;
								</script>		
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
							<td class="ColMenuInfo" id="<?php echo "RowResult1".$IdRace ?>">
								<table>
									<tr  onClick="ViewResult(1,<?php echo  intval($ANNEE_COURSE) ?>)" onmouseover="" style="cursor: pointer;">
									<td>
											<span class="dot">
											<i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #3d6ca4;"></i>
										</span>
									</td>
									<td>
										<?php
										if ($val["JuraDefi"] ==1 && $ANNEE_COURSE ==2021)
										{ ?>
												Roller
										<?
										}
										else
										{
										?>
										Etape 1
										<?
										}?>
									</td>
									</tr>
									<script>
										getURL2( "Resultat","Etape=1","<?php echo "RowResult1".$IdRace ?>" ) ;
									</script>		
								</table>
							</td>
						<?									
						}
                        if ( intval($val ["nbr_etape"])>1 && $today >$val ["DateEtape2"] )
                        {?>
                            <td class="ColMenuInfo"  id="<?php echo "RowResult2".$IdRace ?>">
                                <table>
                                    <tr  onClick="ViewResult(2,<?php echo  intval($ANNEE_COURSE) ?>)" onmouseover="" style="cursor: pointer;">
                                    <td>
                                            <span class="dot">
                                            <i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #3d6ca4;"></i>
                                        </span>
                                    </td>
                                    <td>
                                    <?php
                                        if ($val["JuraDefi"] ==1 && $ANNEE_COURSE ==2021)
                                        { ?>
                                               Course à pied
                                        <?
                                        }
                                        else
                                        {
                                        ?>
                                        Etape 2
                                        <?
                                        }?>
                                    </td>
                                    </tr>
									<script>
										getURL2( "Resultat","Etape=2","<?php echo "RowResult2".$IdRace ?>" ) ;
									</script>	
                                </table>
                            </td>
                        <?
                        }
                        if ( intval($val ["nbr_etape"])>2 && $today >$val ["DateEtape3"] )
                        {?>
                            <td class="ColMenuInfo"  id="<?php echo "RowResult3".$IdRace ?>">
                                <table>
                                    <tr onClick="ViewResult(3,<?php echo  intval($ANNEE_COURSE) ?>)" onmouseover="" style="cursor: pointer;">
                                    <td>
                                            <span class="dot">
                                            <i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #3d6ca4;"></i>
                                        </span>
                                    </td>
                                    <td> <?
                                    if ($val["JuraDefi"] ==1 && $ANNEE_COURSE ==2021)
                                        { ?>
                                                Vélo
                                        <?
                                        }
                                        else
                                        {
                                        ?>
                                        Etape 3
                                        <?
                                        }?>
                                    </td>
                                    </tr>
									<script>
										getURL2( "Resultat","Etape=3","<?php echo "RowResult3".$IdRace ?>" ) ;
									</script>
                                </table>
                            </td>
                        <?
                        }
                    if ( intval($val ["nbr_etape"])>3 && $today >$val ["DateEtape4"] )
                    {?>
                        <td class="ColMenuInfo"  id="<?php echo "RowResult4".$IdRace ?>" >
                            <table>
                                <tr onClick="ViewResult(4,<?php echo  intval($ANNEE_COURSE) ?>)" onmouseover="" style="cursor: pointer;">
                                <td>
                                        <span class="dot">
                                        <i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #3d6ca4;"></i>
                                    </span>
                                </td>
                                <td><?
                                if ($val["JuraDefi"] ==1 && $ANNEE_COURSE ==2021)
                                    { ?>
                                            VTT
                                    <?
                                    }
                                    else
                                    {
                                    ?>
                                    Etape 4
                                    <?}?>
                                </td>
								<script>
										getURL2( "Resultat","Etape=4","<?php echo "RowResult4".$IdRace ?>" ) ;
									</script>
                                </tr>
                            </table>
                        </td>
                    <?
                    }
                    if (intval($val ["nbr_etape"])>4 && $today >$val ["DateEtape5"] )
                    {
                        ?>
                        <td class="ColMenuInfo" id="<?php echo "RowResult5".$IdRace ?>">
                            <table>
                                <tr  onClick="ViewResult(5,<?php echo  intval($ANNEE_COURSE) ?>)" onmouseover="" style="cursor: pointer;">
                                <td>
                                        <span class="dot">
                                        <i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #3d6ca4;"></i>
                                    </span>
                                </td>
                                <td>
                                    Etape 5
                                </td>
                                </tr>
								<script>
										getURL2( "Resultat","Etape=5","<?php echo "RowResult5".$IdRace ?>" ) ;
								</script>
                            </table>
                        </td>
                    <?
                    }	
                    if ( intval($val ["nbr_etape"])>1 && $today >$val ["DateEtape2"] )
                    {?>
                        <td class="ColMenuInfo">
                            <table>
                                <tr id="<?php echo "RowResult99".$IdRace ?>" onClick="ViewResult(99,<?php echo  intval($ANNEE_COURSE) ?>)" onmouseover="" style="cursor: pointer;">
                                <td>
                                        <span class="dot">
                                        <i class="fa fa-trophy" style= "font-size: 20px;margin:9px;color: #3d6ca4;"></i>
                                    </span>
                                </td>
                                <td>
                                    Général
                                </td>
                                </tr>
								<script>
										getURL2( "Resultat","Etape=99","<?php echo "RowResult99".$IdRace ?>" ) ;
								</script>
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
	if ( <?php echo json_encode($ANNEE_COURSE ); ?> > 2019 &&  <?php echo json_encode($Nbr_etape ); ?> >10 )
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

  	  // Calcul grandeur des colonne pour arrivée au 100%
        ChangeStyleCol();
function ChangeStyleCol()
{
 var TabArr =   document.getElementsByClassName("ColMenuInfo");
    console.log(TabArr);
    for (var i = 0; i < TabArr.length; i++) 
    {
        // Selon la longueur du tableau la dimension des column va auguementer
        TabArr[i].style.width = (100 /TabArr.length)+"%";
    }
}
</script>	
</div>