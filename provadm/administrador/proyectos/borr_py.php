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
				echo "alert('id de proyecto no disponible');";
				echo "var pagina='../proyectos';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$sacarrut="SELECT * from images_py where py_id=$idR";
			$sql_rut=mysql_query($sacarrut,$conexion) or die (mysql_error());
			while ($tr=mysql_fetch_array($sql_rut)) {
				$idigs=$tr['id_img_py'];
				$borrut=$tr['rut_py'];
				unlink("../../../".$borrut);
				$borrtaimages="DELETE from images_py where id_img_py=$idigs";
				mysql_query($borrtaimages,$conexion) or die (mysql_error());
			}
			$borrar="DELETE from proyectos where id_py=$idR";
			mysql_query($borrar,$conexion) or die (mysql_error());
			echo "<script type='text/javascript'>";
				echo "alert('Proyecto borrado');";
				echo "var pagina='../proyectos';";
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