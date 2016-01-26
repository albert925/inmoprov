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
		$idR=segcon($conexion,$_POST['pyid']);
		$a=segcon($conexion,$_POST['nampy']);
		$b=segcon($conexion,$_POST['latpy']);
		$c=segcon($conexion,$_POST['logpy']);
		$d=$_POST['txpy'];
		$hoy=date("Y-m-d");
		if ($idR=="" || $a=="") {
			echo "<script type='text/javascript'>";
				echo "alert('id o nombre de proyecto en blanco');";
				echo "var pagina='../proyectos';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$modificar="UPDATE proyectos set nam_py='$a',text_py='$d',lat_py='$b',
				log_py='$c' where id_py=$idR";
			$conexion->query($modificar) or die (mysqli_error());
			echo "<script type='text/javascript'>";
				echo "alert('Proyecto modificado');";
				echo "var pagina='mopdif_py.php?py=$idR';";
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