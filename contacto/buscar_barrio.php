<?php
	include '../config.php';
	$idmuni=$_POST['mn'];
	if ($idmuni=="0" || $idmuni=="") {
?>
<option value="0">Barrios</option>
<?php
	}
	else{
		$buscar="SELECT * from barrios where munins_id=$idmuni order by nam_barr asc";
		$sql_buscar=$conexion->query($buscar) or die (mysqli_error());
		$numero=$sql_buscar->num_rows;
		if ($numero>0) {
			while ($br=$sql_buscar->fetch_assoc()) {
				$idObr=$br['id_barrio'];
				$nmObr=$br['nam_barr'];
?>
<option value="<?php echo $idObr ?>"><?php echo "$nmObr"; ?></option>
<?php
			}
		}
		else{
?>
<option value="0">Barrios no encontrados</option>
<?php
		}
	}
?>