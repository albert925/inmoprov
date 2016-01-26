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
		function Nomtipos($dato,$serv)
		{
			$sacarnombtp="SELECT * from tipo_inmueble where id_tp=$dato";
			$sql_sacartipo=$serv->query($sacarnombtp)  or die (mysqli_error());
			while ($wtp=$sql_sacartipo->fetch_assoc()) {
				$namwtp=$wtp['nam_tp'];
			}
			return $namwtp;
		}
		function NomMunici($dato,$serv)
		{
			$sacarnommunic="SELECT * from muni_nt_s where id_nt='$dato'";
			$sql_sacarmuni=$serv->query($sacarnommunic) or die (mysqli_error());
			$nummuni=$sql_sacarmuni->num_rows;
			if ($nummuni>0) {
				while ($wmn=$sql_sacarmuni->fetch_assoc()) {
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
		$idR=$_GET['ib'];
		if ($idR=="") {
			echo "<script type='text/javascript'>";
				echo "alert('id de inmueble no disponible');";
				echo "var pagina='../inmuebles';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$datos="SELECT * from inmuebles where cod_inm=$idR";
			$sql_datos=$conexion->query($datos) or die (mysqli_error());
			while ($dt=$sql_datos->fetch_assoc()) {
				$usb=$dt['usuario_id'];
				$tpb=$dt['tip_inm_id'];
				$ab=$dt['muni_id'];
				$bb=$dt['barr_id'];
				$cb=$dt['direccion_inm'];
				$db=$dt['estrato'];
				$eb=$dt['hab_inm'];
				$fb=$dt['sal_inm'];
				$gb=$dt['com_inm'];
				$hb=$dt['ban_inm'];
				$ib=$dt['coc_inm'];
				$jb=$dt['bal_inm'];
				$kb=$dt['pat_inm'];
				$lb=$dt['par_inm'];
				$mb=$dt['prec_inm'];
				$nb=$dt['prec_m2_inm'];
				$ob=$dt['area'];
				$pb=$dt['adminis_inm'];
				$qb=$dt['amobla_inm'];
				$rb=$dt['superficie_m2_inm'];
				$sb=$dt['superf_terre_inm'];
				$tb=$dt['estd_inm'];
				$ub=$dt['fe_inm'];
				$vb=$dt['lat_inm'];
				$wb=$dt['lon_inm'];
				$xb=$dt['descip_inm'];
				$yb=$dt['ff_inm'];
				$zb=$dt['fp_inm'];
				$aab=$dt['quin_publico'];
			}
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
		</article>
	</section>
	<section>
		<article id="automargen">
			<form action="modifc_inmueble.php" method="post" class="columninput">
				<input type="text" name="idib" required value="<?php echo $idR ?>" required style="display:none;" />
				<input type="text" id="prus" name="prus" value="<?php echo $idus ?>" required style="display:none;" />
				<label>*<b>Del tipo</b></label>
				<select id="tpib" name="tpib">
					<option value="0">Seleccione</option>
					<?php
						$tdtp="SELECT * from tipo_inmueble order by nam_tp asc";
						$sql_tdtp=$conexion->query($tdtp) or die (mysqli_error());
						while ($tpU=$sql_tdtp->fetch_assoc()) {
							$idtpU=$tpU['id_tp'];
							$nmtpU=$tpU['nam_tp'];
							if ($idtpU==$tpb) {
								$seltipo="selected";
							}
							else{
								$seltipo="";
							}
					?>
					<option value="<?php echo $idtpU ?>" <?php echo $seltipo ?>><?php echo "$nmtpU"; ?></option>
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
							if ($idUmn==$ab) {
								$selab="selected";
							}
							else{
								$selab="";
							}
					?>
					<option value="<?php echo $idUmn ?>" <?php echo $selab ?>><?php echo "$nmUmn"; ?></option>
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
							if ($idUbar==$bb) {
								$selbb="selected";
							}
							else{
								$selbb="";
							}
					?>
					<option value="<?php echo $idUbar ?>" <?php echo $selbb ?>><?php echo "$nmUbarr"; ?></option>
					<?php
						}
					?>
				</select>
				<label>*<b>Dirección</b></label>
				<input type="text" id="dirib" name="dirib" required value="<?php echo $cb ?>" />
				<label><b>Estrato</b></label>
				<select id="estib" name="estib">
					<?php
						for ($hes=1; $hes <=6 ; $hes++) {
							if ($hes==$db) {
								$selestrato="selected";
							}
							else{
								$selestrato="";
							}
					?>
					<option value="<?php echo $hes ?>" <?php echo $selestrato ?>><?php echo "$hes"; ?></option>
					<?php
						}
					?>
				</select>
				<article class="foofform">
					<div>
						<label><b>Habitación</b></label>
						<input type="number" id="hb" name="hb" required value="<?php echo $eb ?>" />
					</div>
					<div>
						<label><b>Sala</b></label>
						<input type="number" id="sl" name="sl" required value="<?php echo $fb ?>" />
					</div>
					<div>
						<label><b>Comedor</b></label>
						<input type="number" id="cm" name="cm" required value="<?php echo $gb ?>" />
					</div>
					<div>
						<label><b>Baño</b></label>
						<input type="number" id="bn" name="bn" required value="<?php echo $hb ?>" />
					</div>
					<div>
						<label><b>Cocina</b></label>
						<input type="number" id="coc" name="coc" required value="<?php echo $ib ?>" />
					</div>
					<div>
						<label><b>Balcón</b></label>
						<input type="number" id="bal" name="bal" required value="<?php echo $jb ?>" />
					</div>
					<div>
						<label><b>Patio</b></label>
						<input type="number" id="pat" name="pat" required value="<?php echo $kb ?>" />
					</div>
					<div>
						<label><b>Parqueadero</b></label>
						<input type="number" id="par" name="par" required value="<?php echo $lb ?>" />
					</div>
				</article>
				<label>*<b>Precio</b></label>
				<input type="number" id="preib" name="preib" required placeholder="solo numeros" value="<?php echo $mb ?>" />
				<label><b>Precio por m<sup>2</sup></b></label>
				<input type="number" id="precdosib" name="precdosib" placeholder="solo numeros" value="<?php echo $nb ?>" />
				<label><b>Area</b></label>
				<input type="text" id="areib" name="areib" value="<?php echo $ob ?>" />
				<label><b>Administración</b></label>
				<input type="text" id="adminib" name="adminib" value="<?php echo $pb ?>" />
				<label><b>Amoblado</b></label>
				<select id="amobib" name="amobib">
					<?php
						if ($qb=="Si") {
							$numselam=1;
						}
						else{
							$numselam=2;
						}
						$arrsino=["Selecione","Si","No"];
						for ($has=1; $has <=2 ; $has++) {
							if ($has==$numselam) {
								$selamobaldo="selected";
							}
							else{
								$selamobaldo="";
							}
					?>
					<option value="<?php echo $arrsino[$has] ?>" <?php echo $selamobaldo ?>><?php echo $arrsino[$has]; ?></option>
					<?php
						}
					?>
				</select>
				<label style="display:none;"><b>Superficie m<sup>2</sup></b></label>
				<input style="display:none;" type="text" id="superfib" name="superfib" value="<?php echo $rb ?>" />
				<label><b>Superficie terreno</b></label>
				<input type="text" id="superterib" name="superterib" value="<?php echo $sb ?>" />
				<label><b>Estado</b></label>
				<select id="esdib" name="esdib">
					<?php
						for ($ioes=0; $ioes <=2 ; $ioes++) {
							if ($ioes==$tb) {
								$selestado="selected";
							}
							else{
								$selestado="";
							}
					?>
					<option value="<?php echo $ioes ?>" <?php echo $selestado ?>><?php echo "$arrestado[$ioes]"; ?></option>
					<?php
						}
					?>
				</select>
				<label><b>Disponible a partir de</b></label>
				<input type="date" id="disfeib" name="disfeib" value="<?php echo $ub ?>" />
				<label style="display:none;"><b>Ubiacion google maps (Lat,Long)</b></label>
				<article style="display:none;" class="foofformBb">
					<div>
						<label><b>Latitud (positivo)</b></label>
						<input type="text" id="latib" name="latib" placeholder="7.858777" value="<?php echo $vb ?>" />
					</div>
					<div>
						<label><b>Longitud (negativo)</b></label>
						<input type="text" id="logib" name="logib" placeholder="-7.565456" value="<?php echo $wb ?>" />
					</div>
				</article>
				<label><b>Descripción</b></label>
				<textarea id="editor1" name="txib"><?php echo "$xb"; ?></textarea>
				<script>
					CKEDITOR.replace('txib');
				</script>
				<div id="txA"></div>
				<input type="submit" id="nvimb" value="Modificar" />
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
	}
	else{
		echo "<script type='text/javascript'>";
			echo "alert('sesion caducada');";
			echo "var pagina='../';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>