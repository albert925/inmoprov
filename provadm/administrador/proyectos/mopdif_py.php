<?php
	include '../../../config.php';
	session_start();
	if (isset($_SESSION['adm'])) {
		$idradd=$_SESSION['adm'];
		$datadm="SELECT * from administrador where id_adm=$idradd";
		$sql_adm=mysql_query($datadm,$conexion) or die (mysql_error());
		while ($ad=mysql_fetch_array($sql_adm)) {
			$usad=$ad['user_adm'];
			$tpad=$ad['tp_adm'];
		}
		$idR=$_GET['py'];
		if ($idR=="") {
			echo "<script type='text/javascript'>";
				echo "alert('id de proyecto no disponible');";
				echo "var pagina='../proyectos';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$datos="SELECT * from proyectos where id_py=$idR";
			$sql_datos=mysql_query($datos,$conexion) or die (mysql_error());
			while ($dt=mysql_fetch_array($sql_datos)) {
				$idy=$dt['id_py'];
				$nmy=$dt['nam_py'];
				$lgy=$dt['lug_py'];
				$pcy=$dt['prec_py'];
				$txy=$dt['text_py'];
				$fey=$dt['fec_py'];
				$esy=$dt['estd_py'];
				$lty=$dt['lat_py'];
				$lgy=$dt['log_py'];
			}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Administra usuarios" />
	<meta name="keywords" content="Todos los usuarios" />
	<title>Datos <?php echo "$nmy"; ?>|Inmobiliaria Provase</title>
	<link rel="icon" href="../../../imagenes/icon.png" />
	<link rel="stylesheet" href="../../../css/normalize.css" />
	<link rel="stylesheet" href="../../../css/iconos/style.css" />
	<link rel="stylesheet" href="../../../css/style.css" />
	<link rel="stylesheet" href="../../../css/admin.css" />
	<script src="../../../js/jquery_2_1_1.js"></script>
	<script src="../../../js/scripag.js"></script>
	<script src="../../../js/scriadmin.js"></script>
	<script src="../../../js/proyectos.js"></script>
	<script src="../../../ckeditor/ckeditor.js"></script>
</head>
<body>
	<header>
		<figure id="logo">
			<a href="../">
				<img src="../../../imagenes/logo.png" alt="logo" />
			</a>
		</figure>
	</header>
	<article id="menuybusc">
		<nav id="mnP">
			<ul>
				<li><a href="../munins">Municipios y Barrios</a></li>
				<li><a href="../usuarios">Usuarios</a></li>
				<li><a href="../inmuebles">Inmuebles</a></li>
				<li><a class="sel" href="../proyectos">Proyectos</a></li>
				<li><a href="../"><?php echo "$usad"; ?></a></li>
				<li><a href="../../../cerrar">Salir</a></li>
			</ul>
		</nav>
		<div id="boton_mov"><span class="icon-menu"></span></div>
		<article id="buscador">
			<div><span class="icon-search"></span></div>
		</article>
	</article>
	<nav id="mnB">
		<a href="../proyectos">Ver Proyectos</a>
		<a href="images_proyecto.php">Nuevo imagen proyecto</a>
	</nav>
	<section>
		<h1><?php echo "$nmy"; ?></h1>
		<article id="automargen">
			<form action="modifc_proyecto.php" method="post" class="columninput">
				<input type="text" id="pyid" name="pyid" value="<?php echo $idR ?>" required style="display:none;" />
				<label>*<b>Nombre proyecto</b></label>
				<input type="text" id="nampy" name="nampy" value="<?php echo $nmy ?>" required />
				<label><b>Ubicacion Google maps</b></label>
				<article class="foofform">
					<div>
						<label><b>Latitud (positivo)</b></label>
						<input type="text" id="latpy" name="latpy" value="<?php echo $lty ?>" placeholder="7.858777" />
					</div>
					<div>
						<label><b>Longitud (negativo)</b></label>
						<input type="text" id="logpy" name="logpy" value="<?php echo $lgy ?>" placeholder="-7.565456" />
					</div>
				</article>
				<label><b>Descripción</b></label>
				<textarea id="txpy" name="txpy"><?php echo "$txy"; ?></textarea>
				<script>
					CKEDITOR.replace('txpy');
				</script>
				<div id="txA"></div>
				<input type="submit" id="nvpy" value="Modificar" />
			</form>
		</article>
	</section>
	<footer>
		<article class="flexfoot">
			<article id="contfo">
				<h2>CONTACTO DETALLES</h2>
				<article>
					<div><span class="icon-location"></span>Av. 1E # 11-142 Barrio Caobos</div>
					<div>Colombia - Cúcuta</div>
					<div>
						<span class="icon-phone"></span>
						314 394 1701 - 315 827 4399
					</div>
					<div>
						<span class="icon-old-phone"></span>
						583 0897/98 - 573 0190 - 571 22 62
					</div>
					<div><span class="icon-mail"></span> Info@inmobiliariaprovase.com.co</div>
				</article>
			</article>
			<article id="mapagoogle">
				<article id="map_canvas" class="mapas"></article>
			</article>
		</article>
		<article class="finfoot">
			CONAXPORT © 2015 &nbsp;&nbsp;todos los derechos reservados &nbsp;- &nbsp;PBX (5) 841 733 &nbsp;&nbsp;Cúcuta - Colombia &nbsp;&nbsp;
			<a href="http://conaxport.com/" target="_blank">www.conaxport.com</a>
		</article>
	</footer>
	<script src="http://www.google.com/jsapi"></script>
	<script src="../../../js/colmapa.js"></script>
</body>
</html>
<?php
		}
	}
	else{
		echo "<script type='text/javascript'>";
			echo "var pagina='../../errroadm.html';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>