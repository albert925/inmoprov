<?php
	include '../../config.php';
	$idR=$_POST['fa'];
	$a=$_POST['a'];
	if ($idR=="" || $a=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from administrador where user_adm='$a'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			echo "2";
		}
		else{
			$modificar="UPDATE administrador set user_adm='$a' where id_adm=$idR";
			mysql_query($modificar,$conexion) or die (mysql_error());
			echo "3";
		}
	}
?>