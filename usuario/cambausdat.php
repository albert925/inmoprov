<?php
	include '../config.php';
	$idR=$_POST['fad'];//id us
	$a=$_POST['a'];//nombre y apellidos
	$c=$_POST['c'];//telefono
	$d=$_POST['d'];//celular
	$e=$_POST['e'];//departemanteo id
	$f=$_POST['f'];//municipio id
	$g=$_POST['g'];//direccion
	if ($idR=="" || $a=="") {
		echo "1";
	}
	else{
		$modificar="UPDATE usuarios set nom_ap_us='$a',tel_us='$c',mov_us='$d',depart_id=$e,
			muni_id=$f,direc_us='$g' where id_us=$idR";
		mysql_query($modificar,$conexion) or die (mysql_error());
		echo "2";
	}
?>