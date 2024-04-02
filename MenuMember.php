  <div id="menu_vertical">
	<li>
	<?php 
	if (isset($_SESSION['Course']))
	{
		$Link= "../formulaire2.php?Nbretape=".$_SESSION['Nbretape']."&date_course=".$_SESSION['DateCourse']."&nom_course=" .$_SESSION['Course'];
		
	}
	if (isset($_SESSION['Login']) && strlen($_SESSION['Login']) > 1)
	{
	?>

	<a href="../Pannier.php">Panier</a>
<? 
	}
if  (isset($_SESSION['Login']))
	{?>
	<a href="../Deconnect.php">Deconnect</a>
<?	}


if (isset($_SESSION['Login']) && strlen($_SESSION['Login']) > 1)
{?>
<a href="membres.php">Profil</a>
<?}?>
   </li>
</div>