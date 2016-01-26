<?php
	include '../../../config.php';
	$idR=segcon($conexion,$_POST['fb']);
	$a=segcon($conexion,$_POST['a']);//sel muni
	$b=segcon($conexion,$_POST['b']);//nom barr
	if ($idR=="" || $a=="0" || $a=="" || $b=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE barrios set munins_id=$a,nam_barr='$b' where id_barrio=$idR";
		$conexion->query($modificar) or die (mysqli_error());
		echo "2";
	}
?>