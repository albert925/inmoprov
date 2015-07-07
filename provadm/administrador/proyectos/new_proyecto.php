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
		$a=$_POST['nampy'];
		$b=$_POST['latpy'];
		$c=$_POST['logpy'];
		$d=$_POST['txpy'];
		$hoy=date("Y-m-d");
		if ($a=="") {
			echo "<script type='text/javascript'>";
				echo "alert('nombre de proyecto en blanco');";
				echo "var pagina='../proyectos';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$ingresar="INSERT into proyectos(nam_py,text_py,fec_py,estd_py,lat_py,log_py) 
				values('$a','$d','$hoy','1','$b','$c')";
			mysql_query($ingresar,$conexion) or die (mysql_error());
			echo "<script type='text/javascript'>";
				echo "alert('Proyecto ingresado');";
				echo "var pagina='images_proyecto.php';";
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