<?php
	include '../../config.php';
	$idR=$_POST['fb'];
	$conact=$_POST['b'];
	$connew=$_POST['c'];
	function passcifr($pass)
	{
		$salt = 'sanae-pequena-nina-7-years$/';
		$c = sha1(md5($salt.$pass));
		return $c;
	}
	if ($idR=="" || $conact=="" || $connew=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from administrador where id_adm=$idR and pass_adm='".passcifr($conact)."'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			$modificar="UPDATE administrador set pass_adm='".passcifr($connew)."' where id_adm=$idR";
			mysql_query($modificar,$conexion) or die (mysql_error());
			echo "3";
		}
		else{
			echo "2";
		}
	}
?>