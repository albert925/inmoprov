<?php
	include '../../../config.php';
	$idR=segcon($conexion,$_POST['fb']);
	$esR=segcon($conexion,$_POST['es']);
	if ($idR=="" || $esR=="0" || $esR=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE usuarios set estd_us='$esR' where id_us=$idR";
		$conexion->query($modificar) or die (mysqli_error());
		echo "2";
	}
?>