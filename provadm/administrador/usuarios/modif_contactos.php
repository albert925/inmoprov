<?php
	include '../../../config.php';
	$idR=$_POST['fcd'];
	$a=$_POST['a'];
	$b=$_POST['b'];
	if ($idR=="" || $a=="" || $b=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE otros_cont set nam_cont='$a',num_cont='$b' where id_cont=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>