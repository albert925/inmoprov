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
		$idY=$_GET['py'];
		if ($idR=="" || $idY=="") {
			echo "<script type='text/javascript'>";
				echo "alert('id de imagen o proyecto no disponible');";
				echo "var pagina='../proyectos';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$sacarrut="SELECT * from images_py where id_img_py=$idR";
			$sql_rut=$conexion->query($sacarrut) or die (mysqli_error());
			while ($tr=$sql_rut->fetch_assoc()) {
				$borrut=$tr['rut_py'];
			}
			unlink("../../../".$borrut);
			$borrar="DELETE from images_py where id_img_py=$idR";
			$conexion->query($borrar) or die (mysqli_error());
			echo "<script type='text/javascript'>";
				echo "alert('Imagen borrado');";
				echo "var pagina='proyecto_images.php?py=$idY';";
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