<?php
	include '../../../config.php';
	$idmuni=$_POST['mn'];
	if ($idmuni=="0" || $idmuni=="") {
?>
<option value="0">Municipio no seleccionado</option>
<?php
	}
	else{
		$buscar="SELECT * from barrios where munins_id=$idmuni order by nam_barr asc";
		$sql_buscar=mysql_query($buscar,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_buscar);
		if ($numero>0) {
			while ($br=mysql_fetch_array($sql_buscar)) {
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