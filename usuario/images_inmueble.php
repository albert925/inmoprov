<?php
	include '../config.php';
	session_start();
	if (isset($_SESSION['us'])) {
		$rcusus=$_SESSION['us'];
		$datosusers="SELECT * from usuarios where id_us=$rcusus";
		$sql_dtus=mysql_query($datosusers,$conexion) or die (mysql_error());
		while ($us=mysql_fetch_array($sql_dtus)) {
			$idus=$us['id_us'];
			$ccus=$us['cc_us'];
			$nmus=$us['nom_ap_us'];
			$crus=$us['cor_us'];
			$tlus=$us['tel_us'];
			$mvus=$us['mov_us'];
			$dpus=$us['depart_id'];
			$mnus=$us['muni_id'];
			$drus=$us['direc_us'];
			$esus=$us['estd_us'];
			$fius=$us['fecr_us'];
		}
		$nomP=split(" ", $nmus);
		function Nomtipos($dato,$serv)
		{
			$sacarnombtp="SELECT * from tipo_inmueble where id_tp=$dato";
			$sql_sacartipo=mysql_query($sacarnombtp,$serv)  or die (mysql_error());
			while ($wtp=mysql_fetch_array($sql_sacartipo)) {
				$namwtp=$wtp['nam_tp'];
			}
			return $namwtp;
		}
		function NomMunici($dato,$serv)
		{
			$sacarnommunic="SELECT * from muni_nt_s where id_nt='$dato'";
			$sql_sacarmuni=mysql_query($sacarnommunic,$serv) or die (mysql_error());
			$nummuni=mysql_num_rows($sql_sacarmuni);
			if ($nummuni>0) {
				while ($wmn=mysql_fetch_array($sql_sacarmuni)) {
					$namwm=$wmn['nam_nt'];
				}
			}
			else{
				$namwm="No selecionado";
			}
			return $namwm;
		}
		function NomBarr($dato,$serv)
		{
			$sacarnombarr="SELECT * from barrios where id_barrio='$dato'";
			$sql_sacbarr=mysql_query($sacarnombarr,$serv) or die (mysql_error());
			$numbarrio=mysql_num_rows($sql_sacbarr);
			if ($numbarrio>0) {
				while ($brw=mysql_fetch_array($sql_sacbarr)) {
					$nambarw=$brw['nam_barr'];
				}
			}
			else{
				$nambarw="No selecionado";
			}
			return $nambarw;
		}
		$arrestado=["Seleccione","Arriendo","Venta","Arrendado","Vendido"];
		$arrestadobb=["Seleccione","Arrendar","Venta","Arrendado","Vendido"];
	?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Datos de inmuebles <?php echo $nmus ?>" />
	<meta name="keywords" content="TOdos los inmuebles de usuarios" />
	<title>Inmuebles de <?php echo "$nmus"; ?>|Inmobiliaria Provase</title>
	<link rel="icon" href="../imagenes/icon.png" />
	<link rel="stylesheet" href="../css/normalize.css" />
	<link rel="stylesheet" href="../css/iconos/style.css" />
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" href="../css/users.css" />
	<script src="../js/jquery_2_1_1.js"></script>
	<script src="../js/scripag.js"></script>
	<script src="../js/scriadmin.js"></script>
	<script src="../js/usuarious.js"></script>
	<script src="../ckeditor/ckeditor.js"></script>
</head>
<body>
	<header id="automargen">
		<figure id="logo">
			<a href="../">
				<img src="../imagenes/logo.png" alt="logo" />
			</a>
		</figure>
		<h1>Todos los imnuebles de<?php echo "$nmus"; ?></h1>
	</header>
	<article id="menuybusc" class="automarbb">
		<nav id="mnP">
			<ul>
				<li><a href="../">Inicio</a></li>
				<li><a href="../nosotros">Quienes Somos</a></li>
				<li class="submen" data-num="1"><a href="../servicios">Servicios</a>
					<ul class="children1">
						<li><a href="../servicios/ind2x.php?a=0&b=0&c=0&d=0&e=1&f=">Arriendos</a></li>
						<li><a href="../servicios/ind2x.php?a=0&b=0&c=0&d=0&e=2&f=">Ventas</a></li>
					</ul>
				</li>
				<li><a href="../proyectos">Proyectos</a></li>
				<?php
					if ($idus=="0") {
				?>
				<li><a href="../registro">Anunciar</a></li>
				<?php
					}
				?>
				<li><a href="../contacto">Contacto</a></li>
				<?php
					if ($idus!="0") {
				?>
				<li class="submen" data-num="2"><a  class="sel" href="../usuario"><?php echo $nomP[0]; ?></a>
					<ul class="children2">
						<li><a href="../usuario">Información</a></li>
						<li><a class="sel" href="../usuario/inmuebles.php">Mis Inmuebles</a></li>
						<li><a href="../cerrar/us.php">Salir</a></li>
					</ul>
				</li>
				<?php
					}
				?>
			</ul>
		</nav>
		<div id="boton_mov"><span class="icon-menu"></span></div>
		<article id="buscador">
			<div><span class="icon-search"></span></div>
		</article>
	</article>
	<section>
		<article id="automargen">
			<nav id="mnC">
				<a href="inmuebles.php">Ver Inmuebles</a>
				<a href="images_inmueble.php">Imagenes de Inmuebles</a>
			</nav>
			<h2>Nuevo imagen Inmueble</h2>
			<form action="#" method="post" enctype="multipart/form-data" id="nvG_imb" class="columninput">
				<label>*<b>Del Inmueble</b></label>
				<select id="idib" name="idib">
					<option value="0">Seleccione</option>
					<?php
						$tdimb="SELECT * from inmuebles where usuario_id=$idus order by cod_inm desc";
						$sql_imb=mysql_query($tdimb,$conexion) or die (mysql_error());
						while ($mb=mysql_fetch_array($sql_imb)) {
							$idmb=$mb['cod_inm'];
					?>
					<option value="<?php echo $idmb ?>"><?php echo "$idmb"; ?></option>
					<?php
						}
					?>
				</select>
				<label><b>Imagen (resolución permitida 1200 x 1088)</b></label>
				<input type="file" id="imgib" name="imgib" required />
				<div id="txgib"></div>
				<input type="submit" value="Subir e ingresar" id="nvimgimb" />
			</form>
		</article>
	</section>
	<footer class="automarbb">
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
	<script src="../js/colmapa.js"></script>
</body>
</html>
<?php
	}
	else{
		echo "<script type='text/javascript'>";
			echo "alert('sesion caducada');";
			echo "var pagina='../';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>