<!DOCTYPE html>
<html>
	<?php
  include("Header.php"); 
  ?>
<body>
	<?php
  include("Header2023.php"); 
  ?>
  	<script src="js/FonctionIndex.js?v=1">

	</script>

	<?php
	$con = mysqli_connect('dxvv.myd.infomaniak.com', 'dxvv_christopheJ', 'er3z4aet1234');
if (!$con)
{
  die('Could not connect: ' . mysqli_error());
}
else
{
  
	mysqli_select_db($con ,'dxvv_jurachrono' );  
	$sql = "SELECT * FROM Course ORDER BY Date DESC";
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
			
			<div id="<?php echo "canvas". $val ["Nom_Course"].$Year?>">
			
		</div>
			<script>
				CssRace(
					<?php echo json_encode("canvas". $val ["Nom_Course"].$Year); ?>,
				 	<?php echo json_encode( $val ["Nom_Course"]); ?>,
				 	<?php echo json_encode(strftime ("%d",$timestamp)." ".strftime ("%B",$timestamp) );?>,
				  	<?php echo json_encode($val ["Lieu"]);?>,
				  	<?php echo json_encode( $chemin);?>)
			</script>
		<?php
		}
	}
}
	?>
	
</body>

</html>