<?php
	include '../../../config.php';
	$idR=segcon($conexion,$_POST['fcd']);
	$a=segcon($conexion,$_POST['a']);
	$b=segcon($conexion,$_POST['b']);
	if ($idR=="" || $a=="" || $b=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE otros_cont set nam_cont='$a',num_cont='$b' where id_cont=$idR";
		$conexion->query($modificar) or die (mysqli_error());
		echo "2";
	}
?>