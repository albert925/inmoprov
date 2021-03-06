<?php
	include '../../../config.php';
	include '../../../fecha_format.php';
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
		$mH=date("m");
		$yH=date("Y");
		$arrestado=["Seleccione","Activado","Desactivado"];
		function nomDepart($dato,$serv)
		{
			$nomdtp="SELECT * from departamentos where id_depart='$dato'";
			$sql_depart=$serv->query($nomdtp) or die (mysqli_error());
			$numdepar=$sql_depart->num_rows;
			if ($numdepar>0) {
				while ($dpt=$sql_depart->fetch_assoc()) {
					$nmdp=$dpt['nam_depart'];
				}
			}
			else{
				$nmdp="No selecionado";
			}
			return $nmdp;
		}
		function nomMuni($dato,$serv)
		{
			$sqlmn="SELECT * from municipios where id_municipio='$dato'";
			$sql_rtmn=$serv->query($sqlmn) or die (mysqli_error());
			$nummuni=$sql_rtmn->num_rows;
			if ($nummuni>0) {
				while ($mn=$sql_rtmn->fetch_assoc()) {
					$nmmnm=$mn['nam_muni'];
				}
			}
			else{
				$nmmnm="No selecionado";
			}
			return $nmmnm;
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Administra usuarios" />
	<meta name="keywords" content="Todos los usuarios" />
	<title>Administrar Inmuebles|Inmobiliaria Provase</title>
	<link rel="icon" href="../../../imagenes/icon.png" />
	<link rel="stylesheet" href="../../../css/normalize.css" />
	<link rel="stylesheet" href="../../../css/iconos/style.css" />
	<link rel="stylesheet" href="../../../css/style.css" />
	<link rel="stylesheet" href="../../../css/admin.css" />
	<script src="../../../js/jquery_2_1_1.js"></script>
	<script src="../../../js/scripag.js"></script>
	<script src="../../../js/scriadmin.js"></script>
	<script src="../../../js/adminmuebles.js"></script>
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
				<li><a class="sel" href="../inmuebles">Inmuebles</a></li>
				<li><a href="../proyectos">Proyectos</a></li>
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
		<a href="../inmuebles">Ver Inmuebles</a>
		<a href="images_inmueble.php">Imagenes de Inmuebles</a>
		<a href="tipos_inmuebles.php">Tipos de Inmuebles</a>
	</nav>
	<section>
		<h1>Tipos de Inmuebles</h1>
		<article id="automargen">
			<form action="#" method="post" class="columninput">
				<label>*<b>Nuevo Tipo</b></label>
				<input type="text" id="nwmtp" />
				<div id="txA"></div>
				<input type="submit" id="nvtpsimb" value="Ingresar" />
			</form>
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
				$ssql="SELECT * from tipo_inmueble order by nam_tp asc";
				$rs=$conexion->query($ssql) or die (mysqli_error());
				$num_total_registros= $rs->num_rows;
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from tipo_inmueble order by nam_tp asc limit $inicio, $tamno_pagina";
				$impsql=$conexion->query($gsql) or die (mysqli_error());
				while ($gh=$impsql->fetch_assoc()) {
					$idtp=$gh['id_tp'];
					$nmtp=$gh['nam_tp'];
			?>
			<article class="columninput">
				<input type="text" id="nmmf_<?php echo $idtp ?>" value="<?php echo $nmtp ?>" />
				<div id="txB_<?php echo $idtp ?>"></div>
				<input type="submit" value="Modificar" class="moftipo" data-id="<?php echo $idtp ?>" />
				<a href="borrar_tipo.php?br=<?php echo $idtp ?>" class="dell">Borrar</a>
			</article>
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
							<a href="tipos_inmuebles.php?pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

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