<?php
	include '../../config.php';
	$idR=$_POST['fb'];
	$conact=$_POST['b'];
	$connew=$_POST['c'];
	if ($idR=="" || $conact=="" || $connew=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from administrador where id_adm=$idR and pass_adm='$conact'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			$modificar="UPDATE administrador set pass_adm='$connew' where id_adm=$idR";
			mysql_query($modificar,$conexion) or die (mysql_error());
			echo "3";
		}
		else{
			echo "2";
		}
	}
?>