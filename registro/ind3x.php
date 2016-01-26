<?php
	include '../config.php';
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
	$arrestadobb=["Seleccione","Arrendar","Venta","Arrendado","Vendido"];
	$idR=$_GET['us'];
	if ($idR=="") {
		echo "<script type='text/javascript'>";
			echo "alert('id usuario no disponible');";
			echo "var pagina='../registro';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
	else{
		$obidbult="SELECT * from inmuebles where usuario_id=$idR order by cod_inm desc limit 1";
		$sqlultimib=mysql_query($obidbult,$conexion) or die (mysql_error());
		while ($ulb=mysql_fetch_array($sqlultimib)) {
			$idb=$ulb['cod_inm'];
			$tpb=$ulb['tip_inm_id'];
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Anunciar un inmuble" />
	<meta name="keywords" content="Publicar inmuebles" />
	<title>Registro Datos inmueble|Inmobiliaria Provase</title>
	<link rel="icon" href="../imagenes/icon.png" />
	<link rel="stylesheet" href="../css/normalize.css" />
	<link rel="stylesheet" href="../css/iconos/style.css" />
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" href="../css/regis_anunc.css" />
	<link rel="stylesheet" href="../css/owl_carousel.css" />
	<link rel="stylesheet" href="../css/owl_theme_min.css" />
	<script src="../js/jquery_2_1_1.js"></script>
	<script src="../js/owl_carousel_min.js"></script>
	<script src="../js/scripag.js"></script>
	<script src="../js/registro.js"></script>
	<script src="../ckeditor/ckeditor.js"></script>
	<script type="application/ld+json">
		{
		  "@context" : "http://schema.org",
		  "@type" : "LocalBusiness",
		  "name" : "Registro|Inmobiliaria Provase",
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
		<h1>Registro y publicar 3</h1>
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
				<li><a class="sel" href="../registro">Anunciar</a></li>
				<li><a href="../contacto">Contacto</a></li>
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
	<section>
		<article id="automargen">
			<h2 id="disubdos">Subir imagenes <?php echo Nomtipos($tpb,$conexion); ?></h2>
			<article id="restanunc">
				<hgroup>
					<h3>Paso 3</h3>
					<h4>Imagenes del Inmueble</h4>
				</hgroup>
				<form action="#" method="post" enctype="multipart/form-data" id="nvG_imb" class="columninput">
					<input type="text" id="idib" name="idib" value="<?php echo $idb ?>" required style="display:none;" />
					<label><b>Imagen (resolución permitida 1200 x 1088)</b></label>
					<input type="file" id="imgib" name="imgib" required />
					<div id="txgib"></div>
					<article>
						<input type="submit" value="Subir e ingresar" id="nvimgimb" />
						<input type="button" value="Terminar" id="termprc" />
					</article>
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
				$ssql="SELECT * from images_imb where ib_id=$idb order by id_img_ib asc";
				$rs=$conexion->query($ssql) or die (mysqli_error());
				$num_total_registros= $rs->num_rows;
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from images_imb where ib_id=$idb order by id_img_ib asc limit $inicio, $tamno_pagina";
				$impsql=$conexion->query($gsql) or die (mysqli_error());
				while ($gh=$impsql->fetch_assoc()) {
					$idgmib=$gh['id_img_ib'];
					$rtgmib=$gh['rut_ib'];
			?>
			<figure>
				<img src="../<?php echo $rtgmib ?>" alt="imange_<?php echo $idr ?>_<?php echo $idgmib ?>" />
				<figcaption class="columninput">
					<a class="dell" href="borrimagen_imb.php?br=<?php echo $idgmib ?>&us=<?php echo $idR ?>">Borrar</a>
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
							<a href="ind3x.php?us=<?php echo $idR ?>&pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

				<?php
						}
					}
				}
			?>
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
<?php
	}
?>