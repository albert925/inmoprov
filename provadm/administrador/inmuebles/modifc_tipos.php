<?php
	include '../../../config.php';
	$idR=segcon($conexion,$_POST['had']);
	$a=segcon($conexion,$_POST['a']);
	if ($idR=="" || $a=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE tipo_inmueble set nam_tp='$a' where id_tp=$idR";
		$conexion->query($modificar) or die (mysqli_error());
		echo "2";
	}
?>