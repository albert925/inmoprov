<?php
	include '../config.php';
	$a=$_POST['a'];//usuario
	$b=$_POST['b'];//contraseña
	if ($a=="" || $b=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from usuarios where cor_us='$a' and pass_us='$b'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			$activado="SELECT * from usuarios where cor_us='$a' and estd_us='1'";
			$sql_act=mysql_query($activado,$conexion) or die (mysql_error());
			$numacti=mysql_num_rows($sql_act);
			if ($numacti>0) {
				while ($us=mysql_fetch_array($sql_existe)) {
					$idus=$us['id_us'];
				}
				session_start();
				$_SESSION['us']=$idus;
				echo "4";
			}
			else{
				echo "3";
			}
		}
		else{
			echo "2";
		}
	}
?>