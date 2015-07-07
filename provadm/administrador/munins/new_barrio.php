<?php
	include '../../../config.php';
	$a=$_POST['a'];//id muni
	$b=$_POST['b'];//nombre barr
	if ($a=="" || $a=="0" || $b=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from barrios where nam_barr='$b'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			echo "2";
		}
		else{
			$ingresar="INSERT into barrios(munins_id,nam_barr) values($a,'$b')";
			mysql_query($ingresar,$conexion) or die (mysql_error());
			echo "3";
		}
	}
?>