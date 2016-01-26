<?php
	include '../../../config.php';
	$a=$_POST['pa'];
	if ($a=="") {
		echo "";
	}
	else{
?>
<a href="#"><?php echo "$a"; ?></a>
<?php
		$buscar="SELECT * from usuarios where nom_ap_us like '%$a%'";
		$sql_buscar=$conexion->query($buscar) or die (mysqli_error());
		$numero=$sql_buscar->num_rows;
		while ($bus=$sql_buscar->fetch_assoc()) {
			$idbs=$bus['id_us'];
			$nmbs=$bus['nom_ap_us'];
?>
<a href="ind3x.php?us=<?php echo $idbs ?>"><?php echo "$nmbs"; ?></a>
<?php
		}
	}
?>