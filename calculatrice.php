<?php 
$a = $_REQUEST['a'];
$b = $_REQUEST['b'];

switch ($_REQUEST['operation'])
{
	case 'addition':
	$resultat = $a+$b;
	break;
		case 'soustraction':
	$resultat = $a-$b;
	break;
}
print("Resultat : ".$resultat);


?>