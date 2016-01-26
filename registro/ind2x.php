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
		<h1>Registro y publicar 2</h1>
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
			<h2 id="disubdos">Anuncio de Inmueble</h2>
			<article id="restanunc">
				<hgroup>
					<h3>Paso 2</h3>
					<h4>Datos Inmueble</h4>
				</hgroup>
				<form action="new_inmueble.php" method="post" class="columninput">
					<input type="text" id="prus" name="prus" value="<?php echo $idR ?>" required style="display:none;" />
					<label>*<b>Del tipo</b></label>
					<select id="tpib" name="tpib">
						<option value="0">Seleccione</option>
						<?php
							$tdtp="SELECT * from tipo_inmueble order by nam_tp asc";
							$sql_tdtp=$conexion->query($tdtp) or die (mysqli_error());
							while ($tpU=$sql_tdtp->fetch_assoc()) {
								$idtpU=$tpU['id_tp'];
								$nmtpU=$tpU['nam_tp'];
						?>
						<option value="<?php echo $idtpU ?>"><?php echo "$nmtpU"; ?></option>
						<?php
							}
						?>
					</select>
					<label>*<b>Municipio</b></label>
					<select id="mnib" name="mnib">
						<option value="0">Seleccione</option>
						<?php
							$Tmnnt="SELECT * from muni_nt_s order by nam_nt asc";
							$sql_mnnt=$conexion->query() or die (mysqli_error());
							while ($Umn=$sql_mnnt->fetch_assoc()) {
								$idUmn=$Umn['id_nt'];
								$nmUmn=$Umn['nam_nt'];
						?>
						<option value="<?php echo $idUmn ?>"><?php echo "$nmUmn"; ?></option>
						<?php
							}
						?>
					</select>
					<div id="loadbarr"></div>
					<label>*<b>Barrio</b></label>
					<select id="barib" name="barib">
						<option value="0">Seleccione</option>
						<?php
							$Tdbarr="SELECT * from barrios order by nam_barr asc";
							$sql_tdbar=$conexion->query($Tdbarr) or die (mysqli_error());
							while ($Ubarr=$sql_tdbar->fetch_assoc()) {
								$idUbar=$Ubarr['id_barrio'];
								$nmUbarr=$Ubarr['nam_barr'];
						?>
						<option value="<?php echo $idUbar ?>"><?php echo "$nmUbarr"; ?></option>
						<?php
							}
						?>
					</select>
					<label>*<b>Dirección</b></label>
					<input type="text" id="dirib" name="dirib" required />
					<label><b>Estrato</b></label>
					<select id="estib" name="estib">
						<?php
							for ($hes=1; $hes <=6 ; $hes++) { 
						?>
						<option value="<?php echo $hes ?>"><?php echo "$hes"; ?></option>
						<?php
							}
						?>
					</select>
					<article class="foofform">
						<div>
							<label><b>Habitación</b></label>
							<input type="number" id="hb" name="hb" required />
						</div>
						<div>
							<label><b>Sala</b></label>
							<input type="number" id="sl" name="sl" required />
						</div>
						<div>
							<label><b>Comedor</b></label>
							<input type="number" id="cm" name="cm" required />
						</div>
						<div>
							<label><b>Baño</b></label>
							<input type="number" id="bn" name="bn" required />
						</div>
						<div>
							<label><b>Cocina</b></label>
							<input type="number" id="coc" name="coc" required />
						</div>
						<div>
							<label><b>Balcón</b></label>
							<input type="number" id="bal" name="bal" required />
						</div>
						<div>
							<label><b>Patio</b></label>
							<input type="number" id="pat" name="pat" required />
						</div>
						<div>
							<label><b>Parqueadero</b></label>
							<input type="number" id="par" name="par" required />
						</div>
					</article>
					<label>*<b>Precio</b></label>
					<input type="number" id="preib" name="preib" required placeholder="solo numeros" />
					<label><b>Precio por m<sup>2</sup></b></label>
					<input type="number" id="precdosib" name="precdosib" placeholder="solo numeros" />
					<label><b>Area</b></label>
					<input type="text" id="areib" name="areib" />
					<label><b>Administración</b></label>
					<input type="text" id="adminib" name="adminib" />
					<label><b>Amoblado</b></label>
					<select id="amobib" name="amobib">
						<?php
							$arrsino=["Selecione","Si","No"];
							for ($has=1; $has <=2 ; $has++) { 
						?>
						<option value="<?php echo $arrsino[$has] ?>"><?php echo $arrsino[$has]; ?></option>
						<?php
							}
						?>
					</select>
					<label style="display:none;"><b>Superficie m<sup>2</sup></b></label>
					<input style="display:none;" type="text" id="superfib" name="superfib"  />
					<label><b>Superficie terreno</b></label>
					<input type="text" id="superterib" name="superterib" />
					<label><b>Estado</b></label>
					<select id="esdib" name="esdib">
						<?php
							for ($ioes=0; $ioes <=2 ; $ioes++) { 
						?>
						<option value="<?php echo $ioes ?>"><?php echo "$arrestadobb[$ioes]"; ?></option>
						<?php
							}
						?>
					</select>
					<label><b>Disponible a partir de</b></label>
					<input type="date" id="disfeib" name="disfeib" />
					<label style="display:none;"><b>Ubiacion google maps (Lat,Long)</b></label>
					<article style="display:none;" class="foofformBb">
						<div>
							<label><b>Latitud (positivo)</b></label>
							<input type="text" id="latib" name="latib" placeholder="7.858777" />
						</div>
						<div>
							<label><b>Longitud (negativo)</b></label>
							<input type="text" id="logib" name="logib" placeholder="-7.565456" />
						</div>
					</article>
					<label><b>Descripción</b></label>
					<textarea id="editor1" name="txib"></textarea>
					<script>
						CKEDITOR.replace('txib');
					</script>
					<div id="txA"></div>
					<input type="submit" id="nvimb" value="Ingresar" />
				</form>
			</article>
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