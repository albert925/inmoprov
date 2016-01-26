<?php
	include '../../../config.php';
	$idR=segcon($conexion,$_POST['fbd']);
	$esT=segcon($conexion,$_POST['a']);
	if ($idR=="" || $esT=="0" || $esT=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE inmuebles set estd_inm='$esT' where cod_inm=$idR";
		$conexion->query($modificar) or die (mysqli_error());
		echo "2";
	}
?>