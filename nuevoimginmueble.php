<?php
	include 'config.php';
	session_start();
	if (isset($_SESSION['adm'])) {
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$idR=$_POST['idib'];
			//-------------------------------------------
			$fotAcosmodT=$_FILES['imgib']['name'];
			$tipfotA=$_FILES['imgib']['type'];
		 	$almfotA=$_FILES['imgib']['tmp_name'];
		 	$tamfotA=$_FILES['imgib']['size'];
		 	$erorfotA=$_FILES['imgib']['error'];
			//----------------------------------------
			if ($idR=="" || $fotAcosmodT=="") {
				echo "1";
			}
			else{
				if ($erorfotA>0) {
					echo "2";
				}
				else{
					$maAximo = 100204000;
					if ($tamfotA<=$maAximo*1024) {
						$ruta="imagenes/inmuebles/".$fotAcosmodT;
						if (file_exists($ruta)) {
							echo "Una imagen tiene el mismo nombre";
						}
						else{
							$size=getimagesize($almfotA);
							$anchoimagen=$size[0];
							$altoimagen=$size[1];
							$anchodetermindo=1200;
							$altodeterminad=1088;
							if ($anchoimagen!=$anchodetermindo && $altoimagen!=$altodeterminad) {
								echo "Resolucion de imagen no permitida debe ser 1200 x 1088";
							}
							else{
								$subiendo=@move_uploaded_file($almfotA, $ruta);
								if ($subiendo) {
									//marca de agua
									$marcadeagua="imagenes/marca_agua.png";
									$trozosimagenorig=explode(".",$ruta);
									$extensionimagenorig=$trozosimagenorig[count($trozosimagenorig)-1];
									if (preg_match("/jpg|jpeg|JPG|JPEG/", $extensionimagenorig)) {
										$imgm=imagecreatefromjpeg($ruta);
									}
									if (preg_match("/png|PNG/", $extensionimagenorig)) {
										$imgm=imagecreatefrompng($ruta);
									}
									if (preg_match("/gif|GIF/", $extensionimagenorig)) {
										$imgm=imagecreatefromgif($ruta);
									}
									//declaramos el fondo como transparente	
									//imagealphablending($ruta, true);
									//Creamos la imagen de la marca de agua
									$marcadeagua= imagecreatefrompng($marcadeagua);
									//hallamos las dimensiones de ambas imágnes para linearlas
									$xmarcaagua= imagesx($marcadeagua);
									$ymarcaagua= imagesy($marcadeagua);
									$ximagen= imagesx($imgm);
									$yimagen=imagesy($imgm);
									//Copiamos la marca de agua encima de la imagen (alineada abajo a la derecha)
									//centro ($ximagen-$xmarcaagua)/2, ($yimagen-$ymarcaagua)/2
									imagecopy($imgm, $marcadeagua, $ximagen-$xmarcaagua-20, $yimagen-$ymarcaagua-20,
									 0, 0, $xmarcaagua, $ymarcaagua);
									////Guardamos la imagen sustituyendo a la original, en este caso con calidad 100
									imagejpeg($imgm,$ruta);
									//Eliminamos de memoria las imágenes que habíamos creado
									imagedestroy($imgm);
									imagedestroy($marcadeagua);
									$ddf="INSERT into images_imb(ib_id,rut_ib) values($idR,'$ruta')";
									$conexion->query($ddf) or die (mysqli_error());
									echo "5";
								}
								else{
									echo "4";
								}
							}
						}
					}
					else{
						echo "3";
					}
				}
			}
		}
		else{
			echo "error";
		}
	}
	else{
		echo "sesion caducada";
	}
?>