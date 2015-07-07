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
	}
	else{
		$idus=0;
	}
	$rra=$_GET['a'];//odernar
	$rrb=$_GET['b'];//municipios
	$rrc=$_GET['c'];//barrios
	$rrd=$_GET['d'];//tipo de inmueble
	$rre=$_GET['e'];//Estado
	$rrf=$_GET['f'];//cod inmueble
	$arrordenfil=['cod_inm desc','cod_inm asc','cod_inm desc','prec_inm asc','prec_inm desc'];
	switch ($rrb) {
		case '0':
			$rgbb="1";
			break;
		case '':
			$rgbb="1";
			break;
		default:
			$rgbb="muni_id=$rrb";
			break;
	}
	switch ($rrc) {
		case '0':
			$rgcc="";
			break;
		case '':
			$rgcc="";
			break;
		default:
			$rgcc="and barr_id=$rrc";
			break;
	}
	switch ($rrd) {
		case '0':
			$rgdd="";
			break;
		case '':
			$rgdd="";
			break;
		default:
			$rgdd="and tip_inm_id=$rrd";
			break;
	}
	switch ($rre) {
		case '0':
			$rgee="and estd_inm<'3'";
			$palarr="";
			break;
		case '':
			$rgee="and estd_inm<'3'";
			$palarr="";
			break;
		default:
			$rgee="and estd_inm='$rre'";
			if ($rre=="1") {
				$palarr="en Arriendo";
			}
			else{
				if ($rre=="2") {
					$palarr="en Venta";
				}
				else{
					$palarr="";
				}
			}
			break;
	}
	switch ($rrf) {
		case '0':
			$rgff="";
			break;
		case '':
			$rgff="";
			break;
		default:
			$rgff="and cod_inm=$rrf";
			break;
	}
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Todos los INmuebles en arriendo o venta" />
	<meta name="keywords" content="Arriendos, Ventas, servicios" />
	<title>Servicios|Inmobiliaria Provase</title>
	<link rel="icon" href="../imagenes/icon.png" />
	<link rel="stylesheet" href="../css/normalize.css" />
	<link rel="stylesheet" href="../css/iconos/style.css" />
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" href="../css/servicios.css" />
	<link rel="stylesheet" href="../css/owl_carousel.css" />
	<link rel="stylesheet" href="../css/owl_theme_min.css" />
	<link rel="stylesheet" href="../css/component.css" />
	<script src="../js/jquery_2_1_1.js"></script>
	<script src="../js/owl_carousel_min.js"></script>
	<script src="../js/scripag.js"></script>
	<script src="../js/servicios.js"></script>
	<script src="../js/modernizr_custom.js"></script>
	<script type="application/ld+json">
		{
		  "@context" : "http://schema.org",
		  "@type" : "LocalBusiness",
		  "name" : "Servicios|Inmobiliaria Provase",
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
		<h1>Serviocos de inmuebles arriendo y ventas</h1>
	</header>
	<article id="menuybusc" class="automar">
		<nav id="mnP">
			<ul>
				<li><a href="../">Inicio</a></li>
				<li><a href="../nosotros">Quienes Somos</a></li>
				<li class="submen" data-num="1"><a class="sel" href="../servicios">Servicios</a>
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
		<h2 id="disubdos">Todos los Inmuebles <?php echo "$palarr"; ?></h2>
		<article class="gencjflA">
			<article id="reciimb">
				<article id="filtros" class="filserv">
					<select id="bsA">
						<?php
							$arrorden=["Ordernar por","Cod asc","Cod Desc","Menor a Mayor precio",
							"Mayor a Menor precio"];
							for ($sSa=0; $sSa <=4 ; $sSa++) {
								if ($sSa==$rra) {
									$selorden="selected";
								}
								else{
									$selorden="";
								}
						?>
						<option value="<?php echo $sSa ?>" <?php echo $selorden ?>><?php echo $arrorden[$sSa]; ?></option>
						<?php
							}
						?>
					</select>
					<select id="bsB">
						<option value="0">Municipios</option>
						<?php
							$Fmn="SELECT * from muni_nt_s order by nam_nt asc";
							$sql_fmn=mysql_query($Fmn,$conexion) or die (mysql_error());
							while ($mf=mysql_fetch_array($sql_fmn)) {
								$idFfmn=$mf['id_nt'];
								$nmFfmn=$mf['nam_nt'];
								if ($idFfmn==$rrb) {
									$selmuni="selected";
								}
								else{
									$selmuni="";
								}
						?>
						<option value="<?php echo $idFfmn ?>" <?php echo $selmuni ?>><?php echo "$nmFfmn"; ?></option>
						<?php
							}
						?>
					</select>
					<select id="bsC">
						<option value="0">Barrios</option>
						<?php
							$Fbr="SELECT * from barrios order by nam_barr asc";
							$sql_fbr=mysql_query($Fbr,$conexion) or die (mysql_error());
							while ($bf=mysql_fetch_array($sql_fbr)) {
								$idfbar=$bf['id_barrio'];
								$nmfbarr=$bf['nam_barr'];
								if ($idfbar==$rrc) {
									$selbar="selected";
								}
								else{
									$selbar="";
								}
						?>
						<option value="<?php echo $idfbar ?>" <?php echo $selbar ?>><?php echo "$nmfbarr"; ?></option>
						<?php
							}
						?>
					</select>
					<select id="bdD">
						<option value="0">Tipo de Inmueble</option>
						<?php
							$ftp="SELECT * from tipo_inmueble order by nam_tp asc";
							$sql_ftp=mysql_query($ftp,$conexion) or die (mysql_error());
							while ($tpf=mysql_fetch_array($sql_ftp)) {
								$idFftp=$tpf['id_tp'];
								$nmFftp=$tpf['nam_tp'];
								if ($idFftp==$rrd) {
									$seltipo="selected";
								}
								else{
									$seltipo="";
								}
						?>
						<option value="<?php echo $idFftp ?>" <?php echo $seltipo ?>><?php echo "$nmFftp"; ?></option>
						<?php
							}
						?>
					</select>
					<select id="bdE">
						<?php
							for ($sSb=0; $sSb <3 ; $sSb++) {
								if ($sSb==$rre) {
									$selestado="selected";
								}
								else{
									$selestado="";
								}
						?>
						<option value="<?php echo $sSb ?>" <?php echo $selestado ?>><?php echo $arrestado[$sSb]; ?></option>
						<?php
							}
						?>
					</select>
				</article>
				<div id="loadbarr"></div>
				<ul class="grid cs-style-3">
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
						$ssql="SELECT * from inmuebles where $rgbb $rgcc $rgdd $rgee $rgff order by $arrordenfil[$rra]";
						$rs=mysql_query($ssql,$conexion) or die (mysql_error());
						$num_total_registros= mysql_num_rows($rs);
						$total_paginas= ceil($num_total_registros / $tamno_pagina);
						$gsql="SELECT * from inmuebles where $rgbb $rgcc $rgdd $rgee $rgff order by $arrordenfil[$rra] limit $inicio, $tamno_pagina";
						$impsql=mysql_query($gsql,$conexion) or die (mysql_error());
						while ($xor=mysql_fetch_array($impsql)) {
							$idbxr=$xor['cod_inm'];
							$tpbxr=$xor['tip_inm_id'];
							$barxr=$xor['barr_id'];
							$esxr=$xor['estd_inm'];
							$ebxr=$xor['hab_inm'];
							$hbxr=$xor['ban_inm'];
							$mbxr=$xor['prec_inm'];
							$primerdos="SELECT * from images_imb where ib_id=$idbxr order by id_img_ib asc limit 1";
							$sql_primerdos=mysql_query($primerdos,$conexion) or die (mysql_error());
							$numerdos=mysql_num_rows($sql_primerdos);
							if ($numerdos>0) {
								while ($ox=mysql_fetch_array($sql_primerdos)) {
									$gmibxr=$ox['id_img_ib'];
									$gmrutxr=$ox['rut_ib'];
								}
							}
							else{
								$gmibxr=0;
								$gmrutxr="imagenes/predeterminado.png";
							}
					?>
					<li>
						<figure>
							<img src="../<?php echo $gmrutxr ?>" alt="<?php echo $idbxr ?>" />
							<figcaption>
								<h3><?php echo Nomtipos($tpbxr,$conexion); ?> <?php echo NomBarr($barxr,$conexion); ?></h3>
								<div id="texazul"><?php echo "$ebxr"; ?> habitaciones + <?php echo "$hbxr"; ?> baños</div>
								<div id="texazul" class="lev"><?php echo $arrestado[$esxr]; ?> <div id="texblanc">$<?php echo number_format($mbxr); ?></div></div>
								<a href="../descripcion.php?ib=<?php echo $idbxr ?>">Ver más</a>
							</figcaption>
						</figure>
					</li>
					<?php
						}
					?>
				</ul>
				<article class="pagin">
					<br />
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
									<a href="ind2x.php?a=<?php echo $rra ?>&b=<?php echo $rrb ?>&c=<?php echo $rrc ?>&d=<?php echo $rrd ?>&e=<?php echo $rre ?>&f=<?php echo $rrf ?>&pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

						<?php
								}
							}
						}
					?>
				</article>
				<h2 id="disubdos">Proyectos</h2>
				<article id="inmrec">
					<article class="owl-carousel owl-theme owl-loaded">
						<?php
							$ProyR="SELECT * from proyectos where estd_py='1' order by id_py desc limit 10";
							$sql_pyR=mysql_query($ProyR,$conexion) or die (mysql_error());
							while ($yyr=mysql_fetch_array($sql_pyR)) {
								$idy=$yyr['id_py'];
								$nmy=$yyr['nam_py'];
								$primertres="SELECT * from images_py where py_id=$idy order by id_img_py asc limit 1";
								$sql_primertres=mysql_query($primertres,$conexion) or die (mysql_error());
								$numtres=mysql_num_rows($sql_primertres);
								if ($numtres>0) {
									while ($ggm=mysql_fetch_array($sql_primertres)) {
										$idimgpy=$ggm['id_img_py'];
										$rutpy=$ggm['rut_py'];
									}
								}
								else{
									$idimgpy=0;
									$rutpy="imagenes/predeterminado.png";
								}
						?>
						<div class="item">
							<figure class="conce" data-id="<?php echo $idy ?>">
								<a href="../proyectos/ind2x.php?iy=<?php echo $idy ?>">
									<div id="mosmas_<?php echo $idy ?>" class="vermas">
										VER MÁS +
									</div>
								</a>
								<img src="../<?php echo $rutpy ?>" alt="<?php echo $gmibUB ?>" />
								<figcaption id="descim">
									<hgroup>
										<h5><?php echo "$nmy"; ?></h5>
									</hgroup>
								</figcaption>
							</figure>
						</div>
						<?php
							}
						?>
					</article>
				</article>
			</article>
			<article id="busqeydestc">
				<article id="forbusqueda">
					<form action="#" method="post" class="columninput">
						<h2>Buscar Inmuebles</h2>
						<label><b>Municipios</b></label>
						<select id="busGA">
							<option value="0">Seleccione</option>
							<?php
								$Tmnnt="SELECT * from muni_nt_s order by nam_nt asc";
								$sql_busmn=mysql_query($Tmnnt,$conexion) or die (mysql_error());
								while ($bumn=mysql_fetch_array($sql_busmn)) {
									$idbumn=$bumn['id_nt'];
									$nmbumn=$bumn['nam_nt'];
							?>
							<option value="<?php echo $idbumn ?>"><?php echo "$nmbumn"; ?></option>
							<?php
								}
							?>
						</select>
						<div id="loadGg"></div>
						<label><b>Barrios</b></label>
						<select id="busGB">
							<option value="0">Seleccione</option>
							<?php
								$Tbrt="SELECT * from barrios order by nam_barr asc";
								$sql_busbar=mysql_query($Tbrt,$conexion) or die (mysql_error());
								while ($bubr=mysql_fetch_array($sql_busbar)) {
									$idbubar=$bubr['id_barrio'];
									$nmbubarr=$bubr['nam_barr'];
							?>
							<option value="<?php echo $idbubar ?>"><?php echo "$nmbubarr"; ?></option>
							<?php
								}
							?>
						</select>
						<label><b>Tipo de Inmueble</b></label>
						<select id="busGC">
							<option value="0">Seleccione</option>
							<?php
								$Tdtp="SELECT * from tipo_inmueble order by nam_tp asc";
								$sql_tdpd=mysql_query($Tdtp,$conexion) or die (mysql_error());
								while ($butp=mysql_fetch_array($sql_tdpd)) {
									$idbutp=$butp['id_tp'];
									$nmbutp=$butp['nam_tp'];
							?>
							<option value="<?php echo $idbutp ?>"><?php echo "$nmbutp"; ?></option>
							<?php
								}
							?>
						</select>
						<label><b>Arriendo/Venta</b></label>
						<select id="busGD">
							<?php
								for ($sSc=0; $sSc <3 ; $sSc++) { 
							?>
							<option value="<?php echo $sSc ?>"><?php echo $arrestado[$sSc]; ?></option>
							<?php
								}
							?>
						</select>
						<label><b>Id proiedad</b></label>
						<input type="number" id="busGE" />
						<div id="txbq"></div>
						<input type="submit" value="BUSCAR INMUEBLE" id="clbusmb" data-tp="2" />
					</form>
				</article>
				<article>
					<h3>Siguenos en:</h3>
					<article id="redes">
						<a id="fa" href="#" target="_blank"><span class="icon-facebook"></span></a>
						<a id="go" href="#" target="_blank"><span class="icon-google-plus"></span></a>
						<a id="yo" href="#" target="_blank"><span class="icon-youtube3"></span></a>
					</article>
				</article>
				<article id="destac">
					<h2>Inmuebles Destacados</h2>
					<?php
						$destaimb="SELECT * from inmuebles where estd_inm<'3' order by destac_imb desc limit 5";
						$sql_desim=mysql_query($destaimb,$conexion) or die (mysql_error());
						while ($dEs=mysql_fetch_array($sql_desim)) {
							$idEb=$dEs['cod_inm'];
							$tpEb=$dEs['tip_inm_id'];
							$mnEb=$dEs['muni_id'];
							$brEb=$dEs['barr_id'];
							$haEb=$dEs['hab_inm'];
							$bnEb=$dEs['ban_inm'];
							$esEb=$dEs['estd_inm'];
							$aaEb=$dEs['destac_imb'];
							$prircinco="SELECT * from images_imb where ib_id=$idEb order by id_img_ib asc limit 1";
							$sql_cinco=mysql_query($prircinco,$conexion) or die (mysql_error());
							$numcinco=mysql_num_rows($sql_cinco);
							if ($numcinco>0) {
								while ($cic=mysql_fetch_array($sql_cinco)) {
									$cicidgm=$cic['id_img_ib'];
									$cicimgrut=$cic['rut_ib'];
								}
							}
							else{
								$cicidgm=0;
								$cicimgrut="imagenes/predeterminado.png";
							}
					?>
					<article>
						<figure>
							<div id="image">
								<img src="../<?php echo $cicimgrut ?>" alt="img_<?php echo $idEb ?>" />
								<article class="destacad">
									<?php
										for ($wy=1; $wy <=5 ; $wy++) { 
											if ($wy<=$aaEb) {
												$clasDes="icon-star-full";
												$clasDis="id='colodes'";
											}
											else{
												$clasDes="icon-star-empty";
												$clasDis="id='nnocoldes'";
											}
									?>
									<div <?php echo $clasDis ?> data-actual="<?php echo $aaEb ?>" 
										data-dest="<?php echo $wy ?>" data-imb="<?php echo $idEb ?>">
										<span class="<?php echo $clasDes ?>"></span>
									</div>
									<?php
										}
									?>
								</article>
							</div>
							<figcaption>
								<div>
									<?php echo Nomtipos($tpEb,$conexion); ?> en <?php echo $arrestado[$esEb]; ?>
								</div>
								<div>
									<?php echo NomBarr($brEb,$conexion); ?>
								</div>
								<div>
									<?php echo $haEb; ?> Hab - <?php echo "$bnEb"; ?> baños
								</div>
								<div>
									<a href="../descripcion.php?ib=<?php echo $idEb ?>">Ver mas</a>
								</div>
							</figcaption>
						</figure>
					</article>
					<?php
						}
					?>
				</article>
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