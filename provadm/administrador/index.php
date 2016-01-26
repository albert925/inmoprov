<?php
	include '../../config.php';
	session_start();
	if (isset($_SESSION['adm'])) {
		$idradd=$_SESSION['adm'];
		$datadm="SELECT * from administrador where id_adm=$idradd";
		$sql_adm=$conexion->query($datadm) or die (mysqli_error());
		while ($ad=$sql_adm->fetch_assoc()) {
			$usad=$ad['user_adm'];
			$tpad=$ad['tp_adm'];
		}
		//num_rows
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Datos de administrador" />
	<meta name="keywords" content="<?php echo $usad ?>" />
	<title>Administrador <?php echo "$usad"; ?>|Inmobiliaria Provase</title>
	<link rel="icon" href="../../imagenes/icon.png" />
	<link rel="stylesheet" href="../../css/normalize.css" />
	<link rel="stylesheet" href="../../css/iconos/style.css" />
	<link rel="stylesheet" href="../../css/style.css" />
	<link rel="stylesheet" href="../../css/admin.css" />
	<script src="../../js/jquery_2_1_1.js"></script>
	<script src="../../js/scripag.js"></script>
	<script src="../../js/admin.js"></script>
</head>
<body>
	<header>
		<figure id="logo">
			<a href="">
				<img src="../../imagenes/logo.png" alt="logo" />
			</a>
		</figure>
	</header>
	<article id="menuybusc">
		<nav id="mnP">
			<ul>
				<li><a href="munins">Municipios y Barrios</a></li>
				<li><a href="usuarios">Usuarios</a></li>
				<li><a href="inmuebles">Inmuebles</a></li>
				<li><a href="proyectos">Proyectos</a></li>
				<li><a class="sel" href=""><?php echo "$usad"; ?></a></li>
				<li><a href="../../cerrar">Salir</a></li>
			</ul>
		</nav>
		<div id="boton_mov"><span class="icon-menu"></span></div>
		<article id="buscador">
			<div><span class="icon-search"></span></div>
		</article>
	</article>
	<section>
		<h1>Administrador <?php echo "$usad"; ?></h1>
		<article class="flxA">
			<article class="columninput">
				<h2>Modificar Usuario</h2>
				<input type="text" id="usfad" value="<?php echo $usad ?>" />
				<div id="txB"></div>
				<input type="submit" value="Modificar" id="cambA" data-adm="<?php echo $idradd ?>" />
			</article>
			<article class="columninput">
				<h2>Modificar Contraseña</h2>
				<label for="pasac">*<b>Contraseña actual</b></label>
				<input type="password" id="pasac" />
				<label for="pasna">*<b>Contraseña nueva</b></label>
				<input type="password" id="pasna" />
				<label for="pasnb">*<b>Repite la contraseña nueva</b></label>
				<input type="password" id="pasnb" />
				<div id="txC"></div>
				<input type="submit" value="Modificar" id="cambB" data-adm="<?php echo $idradd ?>" />
			</article>
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
	<script src="../../js/colmapa.js"></script>
</body>
</html>
<?php
	}
	else{
		echo "<script type='text/javascript'>";
			echo "var pagina='../errroadm.html';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>