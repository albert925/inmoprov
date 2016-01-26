<?php
	include '../config.php';
	$idDP=$_POST['dp'];
	if ($idDP=="0" || $idDP=="") {
?>
<option value="0">Departamento no selecionado</option>
<?php
	}
	else{
		$buscar="SELECT * from municipios where depart_id=$idDP order by nam_muni asc";
		$sql_buscar=$conexion->query($buscar) or die (mysqli_error());
		$numero=$sql_buscar->num_rows;
		if ($numero>0) {
			while ($mnd=$sql_buscar->fetch_assoc()) {
				$idmd=$mnd['id_municipio'];
				$nmmd=$mnd['nam_muni'];
?>
<option value="<?php echo $idmd ?>"><?php echo "$nmmd"; ?></option>
<?php
			}
		}
		else{
?>
<option value="0">Municipio no encotrado</option>
<?php
		}
	}
?>