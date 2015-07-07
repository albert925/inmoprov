<?php
	include '../../../config.php';
	$idR=$_POST['fid'];//id usuario
	$a=$_POST['a'];//nombre contacto
	$b=$_POST['b'];//Numero de contacto
	if ($idR=="" || $a=="" || $b=="") {
		echo "1";
	}
	else{
		$ingresar="INSERT into otros_cont(us_id,nam_cont,num_cont) values($idR,'$a','$b')";
		mysql_query($ingresar,$conexion) or die (mysql_error());
		echo "2";
	}
?>