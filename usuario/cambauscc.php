<?php
	include '../config.php';
	$idR=$_POST['fdd'];
	$ccR=$_POST['a'];
	if ($idR=="" || $ccR=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from usuarios where cc_us='$ccR'";
		$sql_existe=$conexion->query($existe) or die (mysqli_error());
		$numero=$sql_existe->num_rows;
		if ($numero>0) {
			echo "2";
		}
		else{
			$Modificar="UPDATE usuarios set cc_us='$ccR' where id_us=$idR";
			$conexion->query($Modificar) or die (mysqli_error());
			echo "3";
		}
	}
?>