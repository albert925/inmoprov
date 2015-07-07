<?php
	include 'config.php';
	function Nomtipos($dato,$serv)
	{
		$sacarnombtp="SELECT * from tipo_inmueble where id_tp=$dato";
		$sql_sacartipo=mysql_query($sacarnombtp,$serv)  or die (mysql_error());
		while ($wtp=mysql_fetch_array($sql_sacartipo)) {
			$namwtp=$wtp['nam_tp'];
		}
		return $namwtp;
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
	$tpreg=$_GET['es'];
	switch ($tpreg) {
		case '':
			$h="Página no existe";
			$m="El link ingresado no existe";
			$tp=1000;
			break;
		case '0':
			$h="Link Erroneo";
			$m="El link ingresado no existe";
			$tp=1000;
			break;
		case '1':
			$h="Error Cambio correo";
			$m="Codigo de de cambio erroneo";
			$tp=1500;
			break;
		case '2':
			$h="Correo cambiado paso 2";
			$m="Se ha enviado un link al correo para finalizar el cambio";
			$tp=3000;
			break;
		case '3':
			$h="Error al enviar el mensaje";
			$m="No se ha podido enviar el mensaje";
			$tp=1000;
			break;
		default:
			$h="Link Erroneo";
			$m="El link ingresado no existe";
			$tp=1000;
			break;
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="somos una empresa en el sector inmobiliario de la ciudad de Cúcuta y su área metropolitana. 
	El servicio al cliente interno será una responsabilidad incorporada en todos los miembros de la organización." />
	<meta name="keywords" content="Inmobiliaria,inmuebles,publicar inmuebles,casas, departamentos, oficinas, proyectos" />
	<title>Inmobiliaria Provase</title>
	<link rel="icon" href="imagenes/icon.png" />
	<link rel="image_src" href="imagenes/logo.png" />
	<link rel="stylesheet" href="css/normalize.css" />
	<link rel="stylesheet" href="css/iconos/style.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/owl_carousel.css" />
	<link rel="stylesheet" href="css/owl_theme_min.css" />
	<script src="js/jquery_2_1_1.js"></script>
	<script src="js/owl_carousel_min.js"></script>
	<script src="js/scripag.js"></script>
	<script type="text/javascript">
		setTimeout(direccionar,3000);
		function direccionar () {
			window.location.href="index.php";
		}
	</script>
</head>
<body>
	<header id="automargen">
		<figure id="logo">
			<a href="index.php">
				<img src="imagenes/logo.png" alt="logo" />
			</a>
		</figure>
		<h1>Provase</h1>
	</header>
	<article id="menuybusc" class="automar">
		<nav id="mnP">
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="nosotros">Quienes Somos</a></li>
				<li class="submen" data-num="1"><a href="servicios">Servicios</a>
					<ul class="children1">
						<li><a href="servicios/ind2x.php?a=0&b=0&c=0&d=0&e=1&f=">Arriendos</a></li>
						<li><a href="servicios/ind2x.php?a=0&b=0&c=0&d=0&e=2&f=">Ventas</a></li>
					</ul>
				</li>
				<li><a href="proyectos">Proyectos</a></li>
				<li><a href="registro">Anunciar</a></li>
				<li><a href="contacto">Contacto</a></li>
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
					$sql_ulimb=mysql_query($Ultmosdzimb,$conexion) or die (mysql_error());
					while ($ub=mysql_fetch_array($sql_ulimb)) {
						$idbUB=$ub['cod_inm'];
						$tpbUB=$ub['tip_inm_id'];
						$barUB=$ub['barr_id'];
						$esUB=$ub['estd_inm'];
						$primierimg="SELECT * from images_imb where ib_id=$idbUB order by id_img_ib asc limit 1";
						$sql_primeruno=mysql_query($primierimg,$conexion) or die (mysql_error());
						$numeruno=mysql_num_rows($sql_primeruno);
						if ($numeruno>0) {
							while ($ob=mysql_fetch_array($sql_primeruno)) {
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
						<a href="descripcion.php?ib=<?php echo $idbUB ?>">
							<div id="mosmas_<?php echo $idbUB ?>" class="vermas">
								VER MÁS +
							</div>
						</a>
						<img src="<?php echo $gmrutUB ?>" alt="<?php echo $gmibUB ?>" />
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
		<h2 id="disubdos"><?php echo "$h"; ?></h2>
		<p>
			<?php echo "$m"; ?>
		</p>
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
	<script src="js/toucheffects.js"></script>
	<script src="http://www.google.com/jsapi"></script>
	<script src="js/colmapa.js"></script>
</body>
</html>