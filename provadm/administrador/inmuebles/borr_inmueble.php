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
				echo "alert('id de inmueble no disponible');";
				echo "var pagina='../inmuebles';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$sacarrut="SELECT * from images_imb where ib_id=$idR";
			$sql_rut=$conexion->query($sacarrut) or die (mysqli_error());
			while ($tr=$sql_rut->fetch_assoc()) {
				$idimg=$tr['id_img_ib'];
				$rutborr=$tr['rut_ib'];
				unlink("../../../".$rutborr);
				$borrarimages="DELETE from images_imb where id_img_ib=$idimg";
				$conexion->query($borrarimages) or die (mysqli_error());
			}
			$borrar="DELETE from inmuebles where cod_inm=$idR";
			$conexion->query($borrar) or die (mysqli_error());
			echo "<script type='text/javascript'>";
				echo "alert('Inmueble borrado con sus imagenes');";
				echo "var pagina='../inmuebles';";
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