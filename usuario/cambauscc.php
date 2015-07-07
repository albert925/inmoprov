<?php
	include '../config.php';
	$idR=$_POST['fdd'];
	$ccR=$_POST['a'];
	if ($idR=="" || $ccR=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from usuarios where cc_us='$ccR'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			echo "2";
		}
		else{
			$Modificar="UPDATE usuarios set cc_us='$ccR' where id_us=$idR";
			mysql_query($Modificar,$conexion) or die (mysql_error());
			echo "3";
		}
	}
?>