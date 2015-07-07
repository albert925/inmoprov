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
		if ($idR=="") {
			echo "<script type='text/javascript'>";
				echo "alert('id de inmueble no disponible');";
				echo "var pagina='../inmuebles';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$sacarrut="SELECT * from images_imb where ib_id=$idR";
			$sql_rut=mysql_query($sacarrut,$conexion) or die (mysql_error());
			while ($tr=mysql_fetch_array($sql_rut)) {
				$idimg=$tr['id_img_ib'];
				$rutborr=$tr['rut_ib'];
				unlink("../../../".$rutborr);
				$borrarimages="DELETE from images_imb where id_img_ib=$idimg";
				mysql_query($borrarimages,$conexion) or die (mysql_error());
			}
			$borrar="DELETE from inmuebles where cod_inm=$idR";
			mysql_query($borrar,$conexion) or die (mysql_error());
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