<!DOCTYPE html>
<html>
	<?php
  include("Header.php"); 
  ?>
<body>
	<?php
  include("Header2023.php"); 
  ?>
    <script>
	function ChoiceRace(idRace)
	{
		var Form =	document.getElementById("FormChoiceCourse");
		var inuptID =	document.getElementById("IdRace");
		inuptID.value = idRace;
		console.log( "FormChoiceCourse" + idRace )
		console.log(Form )
		Form.submit();
	}
  </script>
  <form method="get" action="informations2023.php" name="FormChoiceCourse" id="FormChoiceCourse">					
		<input type="hidden" name="IdRace" id="IdRace" />
  </form>
				

<!--<form> 
	<Input style="border:83E1FF 1px solid; border-radius: 15px; font-size:24px" type="texte"></input>
</form>-->
	<?php
	include("MysqlConnect.php");
	$sql = "SELECT * FROM Course  WHERE DateEndIndex >= NOW() ORDER BY DateEndIndex ASC ";
	$result = mysqli_query($con,$sql);
	if ($result && mysqli_num_rows($result) > 0) 
	{
		// output data of each row
		while($val = mysqli_fetch_assoc($result)) 
		{
			
			$timestamp = strtotime($val ["Date"]);
			$Date =  date_parse($val ["Date"]);
			$Year = $Date['year']; 
			$Month = $Date['month']; 
			$Day = $Date['day']; 
			$chemin= 'courses/'.$val ["Nom_Course"].$Year."/info/images";?>
				
					<!-- Bloque de course -->
					<div style="width:90%;
							cursor: pointer;
							border: 0px solid #406CA4;
							display: flex;
							flex-direction: column;
							margin: auto;
							margin-top: 40px;
							box-shadow:  0 4px 8px 0 rgba(6, 32, 65, 0.2), 0 6px 20px 0 rgba(6, 32, 65, 0.19);
							border-radius : 10px;"
							onclick="ChoiceRace(<?php echo $val['ID']?>)">
						<!-- Ligne de titre -->
						<div style="background-color:#406CA4;
								width:100%;
								display: flex; 
								border-bottom: 3px solid #406CA4;
								background-color:#406CA4;
								height:50px; 
								align-items: center;">
							<div style="width:50px;display:flex; align-items:center;
							 background-color:#406CA4;border-radius : 10px" >
							 <?php if ($val ["Type"] == "Bia" )
							 {?>
								<img style="border-radius : 20px" src="images/Defi_BiathlonV2.svg"></img>
							 <?}
							 elseif ($val ["Type"] == "multi")
							 {?>
							 <img style="border-radius : 20px"  src="images/Defi_MultiV2.svg"></img>
							<?}
							elseif ($val ["Type"] == "Bike")
							{?>
								<img style="border-radius : 20px"  src="images/Defi_VeloV2.svg"></img>
							<?php
							}
							elseif ($val ["Type"] == "Triathlon")
							{?>
								<img style="border-radius : 20px"  src="images/Defi_TriathlonV2.svg"></img>
							<?php
							}
							else
							{?>
								<img style="border-radius : 20px"  src="images/Defi_CoureurV2.svg"></img>
							<?php
							}?>
							</div>
							<div style="color : #fff;
								display: flex;
								height:100%;
								 align-items: center;
								 font-size: 26px; 
								 margin-left:20px;"><?php echo $val ["Nom_Course"]?>
							</div>
						</div>
						<!-- Content -->
						<div  style="display: flex;" >
							<?php if (file_exists($chemin."/couvertureAccueil.jpg"))
							{?>
							<img style="width:200px;height:200px;margin:10px; border-radius : 10px" src='<?php echo  $chemin."/couvertureAccueil.jpg"?>'></img>
							<?php
							}
							else
							{?>
								<img style="width:200px;margin:10px; border-radius : 10px" src='<?php echo  $chemin."/logo.jpg"?>'></img>
							
							<?php
							}?>
						<div style="width:100% ;display: flex;justify-content: space-evenly;flex-wrap: wrap ">	
							<!-- info date et heure etc-->
							<div style="display: flex;  flex-direction: column;justify-content: space-around;flex-wrap: wrap ">
								<div  style="display: flex;align-items: center">
									<img style="margin:10px;height:30px" src="images/Defi_Calendar.svg"></img>
									<div style="display: flex;
												font-size: 22px;
												height:100%;
								 				align-items: center;"><?php echo strftime ("%d",$timestamp)." ".strftime ("%B",$timestamp)." ".strftime ("%Y",$timestamp)?>
									</div>
								</div>
								<div style="display: flex;align-items: center">
									<img style="margin:10px;height:30px" src="images/Defi_loc_bleu.svg"></img>
									<div style="display: flex;
									font-size: 22px;
								height:100%;
								 align-items: center;"><?php echo $val ["Lieu"]?></div>
								</div>
							</div>
							<!-- Informatipons course -->
							<div style="display: flex;
							font-size: 22px;
								height:100%;
								 align-items: center;">
								<?php echo $val ["PresentationAccueil"]?>
							</div>
						</div>
					</div>
				</div>	
			</div>

		<?php
		}
	}
/**********************************************************************************************
 * 
 *  Ancienne éditions
 *
 * 
 ***********************************************************************************************/
?>
<center>
<div class="title" style="margin: 20px;padding:20px; font-size:28px;">Anciennes évenements </div>
</center>
<?php

    $sql = "SELECT * FROM Course  WHERE Date < NOW() ORDER BY Date DESC ";
	$result = mysqli_query($con,$sql);
	if ($result && mysqli_num_rows($result) > 0) 
	{
		// output data of each row
		while($val = mysqli_fetch_assoc($result)) 
		{
			
			$timestamp = strtotime($val ["Date"]);
			$Date =  date_parse($val ["Date"]);
			$Year = $Date['year']; 
			$Month = $Date['month']; 
			$Day = $Date['day']; 
			$chemin= 'courses/'.$val ["Nom_Course"].$Year."/info/images";?>
				
					<!-- Bloque de course -->
					<div style="width:90%;
							cursor: pointer;
							border: 0px solid #406CA4;
							display: flex;
							flex-direction: column;
							margin: auto;
							margin-top: 40px;
							box-shadow:  0 4px 8px 0 rgba(6, 32, 65, 0.2), 0 6px 20px 0 rgba(6, 32, 65, 0.19);
							border-radius : 10px;"
							onclick="ChoiceRace(<?php echo $val['ID']?>)">
						<!-- Ligne de titre -->
						<div style="background-color:#406CA4;
								width:100%;
								display: flex; 
								border-bottom: 3px solid #406CA4;
								background-color:#406CA4;
								height:50px; 
								align-items: center;">
							<div style="width:50px;display:flex; align-items:center;
							 background-color:#406CA4;border-radius : 10px" >
							 <?php if ($val ["Type"] == "Bia" )
							 {?>
								<img style="border-radius : 20px" src="images/Defi_BiathlonV2.svg"></img>
							 <?}
							 elseif ($val ["Type"] == "multi")
							 {?>
							 <img style="border-radius : 20px"  src="images/Defi_MultiV2.svg"></img>
							<?}
							elseif ($val ["Type"] == "Bike")
							{?>
								<img style="border-radius : 20px"  src="images/Defi_VeloV2.svg"></img>
							<?php
							}
							elseif ($val ["Type"] == "Triathlon")
							{?>
								<img style="border-radius : 20px"  src="images/Defi_TriathlonV2.svg"></img>
							<?php
							}
							else
							{?>
								<img style="border-radius : 20px"  src="images/Defi_CoureurV2.svg"></img>
							<?php
							}?>
							</div>
							<div style="color : #fff;
								display: flex;
								height:100%;
								 align-items: center;
								 font-size: 26px; 
								 margin-left:20px;"><?php echo $val ["Nom_Course"]?>
							</div>
						</div>
						<!-- Content -->
						<div  style="display: flex;" >
							<?php if (file_exists($chemin."/couvertureAccueil.jpg"))
							{?>
							<img style="width:200px;height:200px;margin:10px; border-radius : 10px" src='<?php echo  $chemin."/couvertureAccueil.jpg"?>'></img>
							<?php
							}
							else
							{?>
								<img style="width:200px;margin:10px; border-radius : 10px" src='<?php echo  $chemin."/logo.jpg"?>'></img>
							
							<?php
							}?>
						<div style="width:100% ;display: flex;justify-content: space-evenly;flex-wrap: wrap ">	
							<!-- info date et heure etc-->
							<div style="display: flex;  flex-direction: column;justify-content: space-around;flex-wrap: wrap ">
								<div  style="display: flex;align-items: center">
									<img style="margin:10px;height:30px" src="images/Defi_Calendar.svg"></img>
									<div style="display: flex;
												font-size: 22px;
												height:100%;
								 				align-items: center;"><?php echo strftime ("%d",$timestamp)." ".strftime ("%B",$timestamp)." ".strftime ("%Y",$timestamp)?>
									</div>
								</div>
								<div style="display: flex;align-items: center">
									<img style="margin:10px;height:30px" src="images/Defi_loc_bleu.svg"></img>
									<div style="display: flex;
									font-size: 22px;
								height:100%;
								 align-items: center;"><?php echo $val ["Lieu"]?></div>
								</div>
							</div>
							<!-- Informatipons course -->
							<div style="display: flex;
							font-size: 22px;
								height:100%;
								 align-items: center;">
								<?php echo $val ["PresentationAccueil"]?>
							</div>
						</div>
					</div>
				</div>	
			</div>

		<?php
		}
	}
	?>
	
</body>

</html>