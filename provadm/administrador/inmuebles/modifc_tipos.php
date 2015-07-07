<?php
	include '../../../config.php';
	$idR=$_POST['had'];
	$a=$_POST['a'];
	if ($idR=="" || $a=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE tipo_inmueble set nam_tp='$a' where id_tp=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>