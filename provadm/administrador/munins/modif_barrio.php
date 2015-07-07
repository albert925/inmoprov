<?php
	include '../../../config.php';
	$idR=$_POST['fb'];
	$a=$_POST['a'];//sel muni
	$b=$_POST['b'];//nom barr
	if ($idR=="" || $a=="0" || $a=="" || $b=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE barrios set munins_id=$a,nam_barr='$b' where id_barrio=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>