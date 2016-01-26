<?php
	include '../../../config.php';
	$idR=segcon($conexion,$_POST['fa']);
	$a=segcon($conexion,$_POST['a']);
	if ($idR=="" || $a=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE muni_nt_s set nam_nt='$a' where id_nt=$idR";
		$conexion->query($modificar) or die (mysqli_error());
		echo "2";
	}
?>