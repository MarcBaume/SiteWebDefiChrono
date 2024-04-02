<?php
define("ADAY", (60*60*24));
if ((!isset($_POST["month"])) || (!isset($_POST["year"]))) {
	$nowArray = getdate();
	$month = $nowArray["mon"];
	$year = $nowArray["year"];
} else {
	$month = $_POST["month"];
	$year = $_POST["year"];
}
$start = mktime (12, 0, 0, $month, 1, $year);
$firstDayArray = getdate($start);
?>
<html>
<head>
<title><?php echo "Calendar: ".$firstDayArray["month"]." ".$firstDayArray["year"]; ?></title>
<head>
<body>
<h1>Selection d'un mois et d'une année</h1>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
<select name="month">
<?php
$months = Array("Janvier", "Février", "Mars", "Avril", "Mai",  "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
for ($x=1; $x <= count($months); $x++) {
	echo"<option value=\"$x\"";
	if ($x == $month) {
		echo " selected";
	}
	echo ">".$months[$x-1]."</option>";
}
?>
</select>
<select name="year">
<?php
for ($x=2012; $x<=2020; $x++) {
	echo "<option";
	if ($x == $year) {
		echo " selected";
	}
	echo ">$x</option>";
}
?>
</select>
<input type="submit" name="submit" value="Go!">
</form>
<br/>
<?php
$days = Array("Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam");
echo "<table border=\"1\" cellpadding=\"5\"><tr>\n";
foreach ($days as $day) {
	echo "<td style=\"background-color: #CCCCCC; text-align: center; width: 14%\">
	      <strong>$day</strong></td>\n";
}
for ($count=0; $count < (6*7); $count++) {
	$dayArray = getdate($start);
	if (($count % 7) == 0) {
		if ($dayArray["mon"] != $month) {
			break;
		} else {
			echo "</tr><tr>\n";
		}
	}
	if ($count < $firstDayArray["wday"] || $dayArray["mon"] != $month) {
		echo "<td>&nbsp;</td>\n";
	} else {
		echo "<td>".$dayArray["mday"]." &nbsp;&nbsp; </td>\n";
		$start += ADAY;
	}
}
echo "</tr></table>";
?>
</body>
</html>

