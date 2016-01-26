<?php
	include 'config.php';
	$idR=$_GET['di'];
	$codiR=$_GET['alg'];
	if ($idR=="" || $codiR=="") {
		$der=1;
	}
	else{
		$existe="SELECT * from usuarios where id_us=$idR and cod_reg_us='$codiR'";
		$sql_existe=$conexion->query($existe) or die (mysqli_error());
		$numero=$sql_existe->num_rows;
		if ($numero>0) {
			$modificar="UPDATE usuarios set estd_us='1',cod_reg_us='000' where id_us=$idR";
			$conexion->query($modificar) or die (mysqli_error());
			$der=2;
		}
		else{
			$der=1;
		}
	}
	echo "<script type='text/javascript'>";
		echo "var pagina='regicompl.php?es=$der';";
		echo "document.location.href=pagina;";
	echo "</script>";
?>