
<div id="menu_vertical">
<li>

   </li>
   <script type="text/javascript">

function checkForm(f) {
	f.submit();
	
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
					<tr id="<?php echo "RowRace5".$IdRace ?>" onClick="ClickRows()"  style="Width : 25%">
						<td>
						<span class="dot">
							<i class="fa fa-globe" style= "font-size: 20px;margin:5px;color: #4095f5;"></i>
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
					<tr id="<?php echo "RowRace4".$IdRace ?>" onClick="ClickRowsInformation()" style="Width : 25%">
						<td>
							<span class="dot">
								<i class="fa fa-info" style= "font-size: 20px;margin:5px; margin-left: 10px; color: #4095f5;"></i>
							</span>
						</td>
						<td>
							<p>informations </p>
						</td>
					</tr>
				</table>

</td>
				<?php
				if ( $today < $val ["DATE_END_INSCRIPTION"] )
				{
				?>
				<Td>
					<table>
						<tr id="<?php echo "RowRace3".$IdRace ?>" onClick="ClickRowsForm()"  style="Width : 25%">
						<td>
							<span class="dot">
								<i class="fa fa-wpforms" style= "font-size: 20px;margin:5px;color: #4095f5;"></i>
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
				else
				{?>
			<td>
					<table>
					<tr id="<?php echo "RowRace2".$IdRace ?>" onClick="ClickRowsResultat()"  style="Width : 25%">
						<td>
							<span class="dot">
								<i class="fa fa-trophy" style= "font-size: 20px;margin:5px;color: #4095f5;"></i>
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
			?>
				<td>
				<table>
					<tr id="<?php echo "RowRace".$IdRace ?>" onClick="ClickRowsListe()"  style="Width : 25%">
					<td>
						<span class="dot">
							<i class="fa fa-list" style= "font-size: 20px;margin:5px;color: #4095f5;"></i>
						</span>
					</td>
					<td>
						<p >liste de départ </p>
					</td>
				</table>
				</td>
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
	elmnt.action = "FormulaireV2.php";
		elmnt.submit();
	}
	function ClickRowsResultat(elmnt )
    {  
	elmnt = document.getElementById("Menu");
	elmnt.action = "ResultatV2.php";
		elmnt.submit();
	}
	function ClickRowsInformation(elmnt)
    {  
	elmnt = document.getElementById("Menu");
	elmnt.action = "Information.php";
		elmnt.submit();
	}
	

</script>	