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
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Administra usuarios" />
	<meta name="keywords" content="Todos los usuarios" />
	<title>Administrar proyectos|Inmobiliaria Provase</title>
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
		<a id="btD" href="#">Nuevo Proyecto</a>
		<a href="images_proyecto.php">Nuevo imagen proyecto</a>
	</nav>
	<section>
		<h1>Proyectos</h1>
		<article id="cjD" class="tdscajaocl">
			<article id="automargen">
				<form action="new_proyecto.php" method="post" class="columninput">
					<label>*<b>Nombre proyecto</b></label>
					<input type="text" id="nampy" name="nampy" required />
					<label><b>Ubicacion Google maps</b></label>
					<article class="foofform">
						<div>
							<label><b>Latitud (positivo)</b></label>
							<input type="text" id="latpy" name="latpy" placeholder="7.858777" />
						</div>
						<div>
							<label><b>Longitud (negativo)</b></label>
							<input type="text" id="logpy" name="logpy" placeholder="-7.565456" />
						</div>
					</article>
					<label><b>Descripción</b></label>
					<textarea id="txpy" name="txpy"></textarea>
					<script>
						CKEDITOR.replace('txpy');
					</script>
					<div id="txA"></div>
					<input type="submit" id="nvpy" value="Ingresar" />
				</form>
			</article>
		</article>
		<article id="automargen" class="flxB">
			<?php
				error_reporting(E_ALL ^ E_NOTICE);
				$tamno_pagina=15;
				$pagina= $_GET['pagina'];
				if (!$pagina) {
					$inicio=0;
					$pagina=1;
				}
				else{
					$inicio= ($pagina - 1)*$tamno_pagina;
				}
				$ssql="SELECT * from proyectos order by id_py desc";
				$rs=mysql_query($ssql,$conexion) or die (mysql_error());
				$num_total_registros= mysql_num_rows($rs);
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from proyectos order by id_py desc limit $inicio, $tamno_pagina";
				$impsql=mysql_query($gsql,$conexion) or die (mysql_error());
				while ($gh=mysql_fetch_array($impsql)) {
					$idy=$gh['id_py'];
					$nmy=$gh['nam_py'];
					$lgy=$gh['lug_py'];
					$pcy=$gh['prec_py'];
					$txy=$gh['text_py'];
					$fey=$gh['fec_py'];
					$esy=$gh['estd_py'];
					$lty=$gh['lat_py'];
					$lgy=$gh['log_py'];
					$primerimg="SELECT * from images_py where py_id=$idy order by id_img_py asc limit 1";
					$sql_primerimg=mysql_query($primerimg,$conexion) or die (mysql_error());
					$numeropy=mysql_num_rows($sql_primerimg);
					if ($numeropy>0) {
						while ($ggm=mysql_fetch_array($sql_primerimg)) {
							$idimagen=$ggm['id_img_py'];
							$rutpy=$ggm['rut_py'];
						}
					}
					else{
						$idimagen=0;
						$rutpy="imagenes/predeterminado.jpg";
					}
			?>
			<figure>
				<h2><?php echo "$nmy"; ?></h2>
				<img src="../../../<?php echo $rutpy ?>" alt="<?php echo $nmy ?>" />
				<figcaption class="columninput">
					<a id="esa" href="mopdif_py.php?py=<?php echo $idy ?>">Modificar</a>
					<a id="esa" href="proyecto_images.php?py=<?php echo $idy ?>">Imágenes</a>
					<a class="dell" href="borr_py.php?br=<?php echo $idy ?>">Borrar</a>
				</figcaption>
			</figure>
			<?php
				}
			?>
		</article>
		<article id="automargen">
			<br />
			<b>Páginas: </b>
			<?php
				//muestro los distintos indices de las paginas
				if ($total_paginas>1) {
					for ($i=1; $i <=$total_paginas ; $i++) { 
						if ($pagina==$i) {
							//si muestro el indice del la pagina actual, no coloco enlace
				?>
					<b><?php echo $pagina." "; ?></b>
				<?php
						}
						else{
							//si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 
				?>
							<a href="index.php?pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

				<?php
						}
					}
				}
			?>
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
	else{
		echo "<script type='text/javascript'>";
			echo "var pagina='../../errroadm.html';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>