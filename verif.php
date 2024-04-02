<?php

function verif()
{
	$ret_arr = array();
	$ret_arr[] = 'fdsfds';
	if (strlen($_REQUEST['titre'])<=2){
		$ret_arr[] = 'titre';
	}
	if (strlen($_REQUEST['description'])<=5){
		$ret_arr[] = 'description';
	}
	return (object)$ret_arr;
}
print(json_encode(verif()));

?>