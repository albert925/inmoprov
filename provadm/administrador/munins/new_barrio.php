<?php
	include '../../../config.php';
	$a=segcon($conexion,$_POST['a']);//id muni
	$b=segcon($conexion,$_POST['b']);//nombre barr
	if ($a=="" || $a=="0" || $b=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from barrios where nam_barr='$b'";
		$sql_existe=$conexion->query($existe) or die (mysqli_error());
		$numero=$sql_existe->num_rows;
		if ($numero>0) {
			echo "2";
		}
		else{
			$ingresar="INSERT into barrios(munins_id,nam_barr) values($a,'$b')";
			$conexion->query($ingresar) or die (mysqli_error());
			echo "3";
		}
	}
?>