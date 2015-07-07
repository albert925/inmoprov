<?php
	include 'config.php';
	$idR=$_GET['di'];
	$codiR=$_GET['alg'];
	if ($idR=="" || $codiR=="") {
		$der=1;
	}
	else{
		$existe="SELECT * from usuarios where id_us=$idR and cod_reg_us='$codiR'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			$modificar="UPDATE usuarios set estd_us='1',cod_reg_us='000' where id_us=$idR";
			mysql_query($modificar,$conexion) or die (mysql_error());
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