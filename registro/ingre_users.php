<?php
	include '../config.php';
	$a=inpseg($conexion,$_POST['a']);//usuario
	$b=inpseg($conexion,$_POST['b']);//contraseña
	if ($a=="" || $b=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from usuarios where cor_us='$a' and pass_us='$b'";
		$sql_existe=$conexion->query($existe) or die (mysqli_error());
		$numero=$sql_existe->num_rows;
		if ($numero>0) {
			$activado="SELECT * from usuarios where cor_us='$a' and estd_us='1'";
			$sql_act=$conexion->query($activado) or die (mysqli_error());
			$numacti=$sql_act->num_rows;
			if ($numacti>0) {
				while ($us=$sql_existe->fetch_assoc()) {
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