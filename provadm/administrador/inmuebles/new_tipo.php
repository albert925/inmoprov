<?php
	include '../../../config.php';
	$a=segcon($conexion,$_POST['a']);//nombre tipo
	if ($a=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from tipo_inmueble where nam_tp='$a'";
		$sql_existe=$conexion->query($existe) or die (mysqli_error());
		$numero=$sql_existe->num_rows;
		if ($numero>0) {
			echo "2";
		}
		else{
			$ingresar="INSERT into tipo_inmueble(nam_tp) values('$a')";
			$conexion->query($ingresar) or die (mysqli_error());
			echo "3";
		}
	}
?>