<?php
	include '../../../config.php';
	$a=$_POST['a'];//nombre tipo
	if ($a=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from tipo_inmueble where nam_tp='$a'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			echo "2";
		}
		else{
			$ingresar="INSERT into tipo_inmueble(nam_tp) values('$a')";
			mysql_query($ingresar,$conexion) or die (mysql_error());
			echo "3";
		}
	}
?>