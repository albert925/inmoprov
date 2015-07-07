<?php
	include '../config.php';
	$idR=$_GET['br'];
	$idB=$_GET['us'];
	if ($idR=="" || $idB=="") {
		echo "<script type='text/javascript'>";
			echo "alert('id de imagen o usuario no disponible');";
			echo "var pagina='../registro';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
	else{
		$sacarrut="SELECT * from images_imb where id_img_ib=$idR";
		$sql_rut=mysql_query($sacarrut,$conexion) or die (mysql_error());
		while ($tr=mysql_fetch_array($sql_rut)) {
			$rutborr=$tr['rut_ib'];
		}
		unlink("../".$rutborr);
		$borrar="DELETE from images_imb where id_img_ib=$idR";
		mysql_query($borrar,$conexion) or die (mysql_error());
		echo "<script type='text/javascript'>";
			echo "alert('Imagen borrado');";
			echo "var pagina='ind3x.php?us=$idB';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>