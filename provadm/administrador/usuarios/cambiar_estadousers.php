<?php
	include '../../../config.php';
	$idR=$_POST['fb'];
	$esR=$_POST['es'];
	if ($idR=="" || $esR=="0" || $esR=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE usuarios set estd_us='$esR' where id_us=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>