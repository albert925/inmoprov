<?php
	include '../config.php';
	$a=$_POST['a'];//usuario
	$b=$_POST['b'];//contraseña
	if ($a=="" || $b=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from administrador where user_adm='$a' and pass_adm='$b'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			while ($ad=mysql_fetch_array($sql_existe)) {
				$idad=$ad['id_adm'];
			}
			session_start();
			$_SESSION['adm']=$idad;
			echo "3";
		}
		else{
			echo "2";
		}
	}
?>