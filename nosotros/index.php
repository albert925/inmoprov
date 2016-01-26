<?php
	include '../config.php';
	session_start();
	if (isset($_SESSION['us'])) {
		$rcusus=$_SESSION['us'];
		$datosusers="SELECT * from usuarios where id_us=$rcusus";
		$sql_dtus=$conexion->query($datosusers) or die (mysqli_error());
		while ($us=$sql_dtus->fetch_assoc()) {
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
	}
	else{
		$idus=0;
	}
	function Nomtipos($dato,$serv)
	{
		$sacarnombtp="SELECT * from tipo_inmueble where id_tp=$dato";
		$sql_sacartipo=$serv->query($sacarnombtp)  or die (mysqli_error());
		while ($wtp=$sql_sacartipo->fetch_assoc()) {
			$namwtp=$wtp['nam_tp'];
		}
		return $namwtp;
	}
	function NomBarr($dato,$serv)
	{
		$sacarnombarr="SELECT * from barrios where id_barrio='$dato'";
		$sql_sacbarr=$serv->query($sacarnombarr) or die (mysqli_error());
		$numbarrio=$sql_sacbarr->num_rows;
		if ($numbarrio>0) {
			while ($brw=$sql_sacbarr->fetch_assoc()) {
				$nambarw=$brw['nam_barr'];
			}
		}
		else{
			$nambarw="No selecionado";
		}
		return $nambarw;
	}
	$arrestado=["Seleccione","Arriendo","Venta","Arrendado","Vendido"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Informaxion de la empresa Inmobiliaria probase" />
	<meta name="keywords" content="Nosotros, misión, visión" />
	<title>Nosotros|Inmobiliaria Provase</title>
	<link rel="icon" href="../imagenes/icon.png" />
	<link rel="stylesheet" href="../css/normalize.css" />
	<link rel="stylesheet" href="../css/iconos/style.css" />
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" href="../css/nosotros.css" />
	<link rel="stylesheet" href="../css/owl_carousel.css" />
	<link rel="stylesheet" href="../css/owl_theme_min.css" />
	<script src="../js/jquery_2_1_1.js"></script>
	<script src="../js/owl_carousel_min.js"></script>
	<script src="../js/scripag.js"></script>
	<script type="application/ld+json">
		{
		  "@context" : "http://schema.org",
		  "@type" : "LocalBusiness",
		  "name" : "Nosotros|Inmobiliaria Provase",
		  "image" : "http://inmobiliariaprovase.com.co/logo.png"
		}
	</script>
</head>
<body>
	<header id="automargen">
		<figure id="logo">
			<a href="../">
				<img src="../imagenes/logo.png" alt="logo" />
			</a>
		</figure>
		<h1>Nosotros e información empresa</h1>
	</header>
	<article id="menuybusc" class="automar">
		<nav id="mnP">
			<ul>
				<li><a href="../">Inicio</a></li>
				<li><a class="sel" href="../nosotros">Quienes Somos</a></li>
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
				<li class="submen" data-num="2"><a href="../usuario"><?php echo $nomP[0]; ?></a>
					<ul class="children2">
						<li><a href="../usuario">Información</a></li>
						<li><a href="../usuario/inmuebles.php">Mis Inmuebles</a></li>
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
	<section id="automargen">
		<article id="inmrec">
			<article class="owl-carousel owl-theme owl-loaded">
				<?php
					$Ultmosdzimb="SELECT * from inmuebles where estd_inm<'3' order by cod_inm desc limit 12";
					$sql_ulimb=$conexion->query($Ultmosdzimb) or die (mysqli_error());
					while ($ub=$sql_ulimb->fetch_assoc()) {
						$idbUB=$ub['cod_inm'];
						$tpbUB=$ub['tip_inm_id'];
						$barUB=$ub['barr_id'];
						$esUB=$ub['estd_inm'];
						$primierimg="SELECT * from images_imb where ib_id=$idbUB order by id_img_ib asc limit 1";
						$sql_primeruno=$conexion->query($primierimg) or die (mysqli_error());
						$numeruno=$sql_primeruno->num_rows;
						if ($numeruno>0) {
							while ($ob=$sql_primeruno->fetch_assoc()) {
								$gmibUB=$ob['id_img_ib'];
								$gmrutUB=$ob['rut_ib'];
							}
						}
						else{
							$gmibUB=0;
							$gmrutUB="imagenes/predeterminado.png";
						}
				?>
				<div class="item">
					<figure class="conce" data-id="<?php echo $idbUB ?>">
						<a href="../descripcion.php?ib=<?php echo $idbUB ?>">
							<div id="mosmas_<?php echo $idbUB ?>" class="vermas">
								VER MÁS +
							</div>
						</a>
						<img src="../<?php echo $gmrutUB ?>" alt="<?php echo $gmibUB ?>" />
						<figcaption id="descim">
							<hgroup>
								<h4> <?php echo Nomtipos($tpbUB,$conexion) ?> <?php echo NomBarr($barUB,$conexion); ?></h4>
								<h5><?php echo $arrestado[$esUB]; ?></h5>
							</hgroup>
						</figcaption>
					</figure>
				</div>
				<?php
					}
				?>
			</article>
		</article>
	</section>
	<section id="automargen">
		<h2 id="disubdos">Nosotros</h2>
		<article class="infns">
			<h2 id="Ja">Reseña Histórica</h2>
			<article id="Ha" class="cajnos">
				<p>
					La inmobiliaria <span class="azul">PROVASE LTDA</span> es una empresa fundada en el año 1973 en la ciudad de Cúcuta, con la unión de socios en cabeza del Dr. Luciano Jaramillo en la búsqueda de lograr una perfecta unión entre las propiedades, los valores y los seguros. Con el paso de los años la empresa se enfocó al mando del Dr. Sergio Jaramillo en el sector inmobiliario, siendo al día de hoy una compañía dedicada al manejo netamente de bienes raíces y comenzando a realizar su cambio generacional con el Dr. Nicolás Jaramillo como administrador. 
				</p>
				<p>
					<b>Nos caracterizamos por nuestra experiencia, cumplimiento y conocimiento.</b>
				</p>
				<article id="imgfl">
					<figure>
						<img src="../imagenes/empleados.jpg" alt="nos1" />
					</figure>
					<figure>
						<img src="../imagenes/fachada.jpg" alt="nos2" />
					</figure>
				</article>
			</article>
			<h2 id="Jb">Misión</h2>
			<article id="Hb" class="cajnos">
				<p>
					INMOBILIARIA <span class="azul">PROVASE LTDA</span>, somos una compañía que busca darle a los habitantes de la ciudad de Cúcuta y su área metropolitana una experiencia diferente en la asesoría del mercado finca raíz. Basándonos en nuestros valores de puntualidad, respeto y calidad. Apoyándonos en nuestra trayectoria de más de 40 años en el sector inmobiliario. 
				</p>
			</article>
			<h2 id="Jc">Visión</h2>
			<article id="Hc" class="cajnos">
				<p>
					Ser a 2020 una empresa líder en el sector inmobiliario de la ciudad de Cúcuta y su área metropolitana. El servicio al cliente interno será una responsabilidad incorporada en todos los miembros de la organización. 
				</p>
			</article>
			<h2 id="Jd">Valores</h2>
			<article id="Hd" class="cajnos">
				<p>
					Los valores serán la puntualidad, el respeto, la honestidad y la calidad. 
				</p>
			</article>
		</article>
	</section>
	<footer id="automarbb">
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
	<script type="text/javascript">
		$(document).ready(function(){
		  $('.owl-carousel').owlCarousel({
				autoplay:true,
				loop:true,
				margin:10,
				responsiveClass:true,
				autoplayTimeout:3000,
				autoplayHoverPause:true,
				nav:true,
				responsive:{
					0:{
						items:1
					},
					600:{
						items:3
					},
					1000:{
							items:5
					}
				}
			});
		});
	</script>
	<script src="http://www.google.com/jsapi"></script>
	<script src="../js/colmapa.js"></script>
</body>
</html>