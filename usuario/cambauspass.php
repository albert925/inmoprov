<?php
	include '../config.php';
	$idR=$_POST['fcd'];
	$conac=$_POST['a'];
	$connew=$_POST['b'];
	if ($idR=="" || $conac=="" || $connew=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from usuarios where id_us=$idR and pass_us='$conac'";
		$sql_existe=$conexion->query($existe) or die (mysqli_error());
		$numero=$sql_existe->num_rows;
		if ($numero>0) {
			$Modificar="UPDATE usuarios set pass_us='$connew' where id_us=$idR";
			$conexion->query($Modificar) or die (mysqli_error());
			echo "3";
		}
		else{
			echo "2";
		}
	}
?>