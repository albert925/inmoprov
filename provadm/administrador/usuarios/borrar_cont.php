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
		$idus=$_GET['us'];
		if ($idR=="" || $idus=="") {
			echo "<script type='text/javascript'>";
				echo "alert('id de contacto o usuario no disponible');";
				echo "var pagina='../usuarios';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$borrarcont="DELETE from otros_cont where id_cont=$idR";
			mysql_query($borrarcont,$conexion) or die (mysql_error());
			echo "<script type='text/javascript'>";
				echo "alert('Contacto borrado');";
				echo "var pagina='users_contacto.php?us=$idus';";
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