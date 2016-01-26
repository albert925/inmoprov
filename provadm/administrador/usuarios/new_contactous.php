<?php
	include '../../../config.php';
	$idR=segcon($conexion,$_POST['fid']);//id usuario
	$a=segcon($conexion,$_POST['a']);//nombre contacto
	$b=segcon($conexion,$_POST['b']);//Numero de contacto
	if ($idR=="" || $a=="" || $b=="") {
		echo "1";
	}
	else{
		$ingresar="INSERT into otros_cont(us_id,nam_cont,num_cont) values($idR,'$a','$b')";
		$conexion->query($ingresar) or die (mysqli_error());
		echo "2";
	}
?>