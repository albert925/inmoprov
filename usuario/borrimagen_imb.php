<?php
	include '../config.php';
	$idR=$_GET['br'];
	$idB=$_GET['ib'];
	if ($idR=="" || $idB=="") {
		echo "<script type='text/javascript'>";
			echo "alert('id de imagen o inmueble no disponible');";
			echo "var pagina='inmuebles.php';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
	else{
		$sacarrut="SELECT * from images_imb where id_img_ib=$idR";
		$sql_rut=$conexion->query($sacarrut) or die (mysqli_error());
		while ($tr=$sql_rut->fetch_assoc()) {
			$rutborr=$tr['rut_ib'];
		}
		unlink("../".$rutborr);
		$borrar="DELETE from images_imb where id_img_ib=$idR";
		$conexion->query($borrar) or die (mysqli_error());
		echo "<script type='text/javascript'>";
			echo "alert('Imagen borrado');";
			echo "var pagina='inmueble_images.php?ib=$idB';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>