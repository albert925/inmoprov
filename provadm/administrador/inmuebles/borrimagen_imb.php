<?php
	include '../../../config.php';
	session_start();
	if (isset($_SESSION['adm'])) {
		$idradd=$_SESSION['adm'];
		$datadm="SELECT * from administrador where id_adm=$idradd";
		$sql_adm=mysql_query($datadm,$conexion) or die (mysql_error());
		while ($ad=mysql_fetch_array($sql_adm)) {
			$usad=$ad['user_adm'];
			$tpad=$ad['tp_adm'];
		}
		$idR=$_GET['br'];
		$idB=$_GET['ib'];
		if ($idR=="" || $idB=="") {
			echo "<script type='text/javascript'>";
				echo "alert('id de imagen o inmueble no disponible');";
				echo "var pagina='../inmuebles';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$sacarrut="SELECT * from images_imb where id_img_ib=$idR";
			$sql_rut=mysql_query($sacarrut,$conexion) or die (mysql_error());
			while ($tr=mysql_fetch_array($sql_rut)) {
				$rutborr=$tr['rut_ib'];
			}
			unlink("../../../".$rutborr);
			$borrar="DELETE from images_imb where id_img_ib=$idR";
			mysql_query($borrar,$conexion) or die (mysql_error());
			echo "<script type='text/javascript'>";
				echo "alert('Imagen borrado');";
				echo "var pagina='inmueble_images.php?ib=$idB';";
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