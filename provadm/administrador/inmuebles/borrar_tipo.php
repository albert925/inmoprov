<?php
	include '../../../config.php';
	session_start();
	if (isset($_SESSION['adm'])) {
		$idradd=$_SESSION['adm'];
		$datadm="SELECT * from administrador where id_adm=$idradd";
		$sql_adm=$conexion->query($datadm) or die (mysqli_error());
		while ($ad=$sql_adm->fetch_assoc()) {
			$usad=$ad['user_adm'];
			$tpad=$ad['tp_adm'];
		}
		//num_rows
		$idR=$_GET['br'];
		if ($idR=="") {
			echo "<script type='text/javascript'>";
				echo "alert('id tipo no disponible');";
				echo "var pagina='tipos_inmuebles.php';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$borrar="DELETE from tipo_inmueble where id_tp=$idR";
			$conexion->query($borrar) or die (mysqli_error());
			echo "<script type='text/javascript'>";
				echo "alert('Tipo inmueble borrado con su relaciones');";
				echo "var pagina='tipos_inmuebles.php';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
	}
	else{
		echo "<script type='text/javascript'>";
			echo "var pagina='../../errroadm.html';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>