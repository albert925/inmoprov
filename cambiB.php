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
			$sacar_corract="SELECT * from usuarios where id_us=$idR";
			$sql_corac=$conexion->query($sacar_corract) or die (mysqli_error());
			while ($ss=$sql_corac->fetch_assoc()) {
				$nomus=$ss['nom_ap_us'];
				$aas=$ss['cor_us'];
				$corrAct=$ss['corrfm_us'];
			}
			$modificar="UPDATE usuarios set cor_us='$corrAct',corrfm_us='$ass',cod_reg_us='000' where id_us=$idR";
			$conexion->query($modificar) or die (mysqli_error());
			$der=2;
		}
		else{
			$der=1;
		}
	}
	echo "<script type='text/javascript'>";
		echo "var pagina='corBcompl.php?es=$der';";
		echo "document.location.href=pagina;";
	echo "</script>";
?>