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
		$sql_buscar=mysql_query($buscar,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_buscar);
		while ($bus=mysql_fetch_array($sql_buscar)) {
			$idbs=$bus['id_us'];
			$nmbs=$bus['nom_ap_us'];
?>
<a href="ind3x.php?us=<?php echo $idbs ?>"><?php echo "$nmbs"; ?></a>
<?php
		}
	}
?>