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
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			$Modificar="UPDATE usuarios set pass_us='$connew' where id_us=$idR";
			mysql_query($Modificar,$conexion) or die (mysql_error());
			echo "3";
		}
		else{
			echo "2";
		}
	}
?>