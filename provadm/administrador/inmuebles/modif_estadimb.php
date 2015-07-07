<?php
	include '../../../config.php';
	$idR=$_POST['fbd'];
	$esT=$_POST['a'];
	if ($idR=="" || $esT=="0" || $esT=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE inmuebles set estd_inm='$esT' where cod_inm=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>