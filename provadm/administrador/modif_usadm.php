<?php
	include '../../config.php';
	$idR=$_POST['fa'];
	$a=$_POST['a'];
	if ($idR=="" || $a=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from administrador where user_adm='$a'";
		$sql_existe=$conexion->query($existe) or die (mysqli_error());
		$numero=$sql_existe->num_rows;
		if ($numero>0) {
			echo "2";
		}
		else{
			$modificar="UPDATE administrador set user_adm='$a' where id_adm=$idR";
			$conexion->query($modificar) or die (mysqli_error());
			echo "3";
		}
	}
?>