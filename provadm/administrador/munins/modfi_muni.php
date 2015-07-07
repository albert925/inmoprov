<?php
	include '../../../config.php';
	$idR=$_POST['fa'];
	$a=$_POST['a'];
	if ($idR=="" || $a=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE muni_nt_s set nam_nt='$a' where id_nt=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>