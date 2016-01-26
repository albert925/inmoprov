<?php
	include '../config.php';
	$a=inpseg($conexion,$_POST['a']);//usuario
	$b=inpseg($conexion,$_POST['b']);//contraseña
	$salt = 'sanae-pequena-nina-7-years$/';
	if ($a=="" || $b=="") {
		echo "1";
	}
	else{
		$c = sha1(md5($salt.$b));
		$existe="SELECT * from administrador where user_adm='$a' and pass_adm='$c'";
		$sql_existe=$conexion->query($existe) or die (mysqli_error());
		$numero=$sql_existe->num_rows;
		if ($numero>0) {
			while ($ad=$sql_existe->fetch_assoc()) {
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