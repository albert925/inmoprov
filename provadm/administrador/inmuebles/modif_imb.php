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
		$arrestado=["Seleccione","Arrendar","Venta","Arrendado","Vendido"];
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
		<h1>Datos del inmueble <?php echo "$idR"; ?></h1>
		<article id="automargen">
			<form action="modifc_inmueble.php" method="post" class="columninput">
				<input type="text" name="idib" required value="<?php echo $idR ?>" style="display:none;" />
				<label>*<b>Del Propietario (usuario)</b></label>
				<select id="prus" name="prus">
					<option value="0">Seleccione</option>
					<?php
						$Tous="SELECT * from usuarios order by id_us desc";
						$sql_us=$conexion->query($Tous) or die (mysqli_error());
						while ($osus=$sql_us->fetch_assoc()) {
							$idus=$osus['id_us'];
							$nmus=$osus['nom_ap_us'];
							if ($idus==$usb) {
								$selidusb="selected";
							}
							else{
								$selidusb="";
							}
					?>
					<option value="<?php echo $idus ?>" <?php echo $selidusb ?>><?php echo "$nmus"; ?></option>
					<?php
						}
					?>
				</select>
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
						$sql_mnnt=$conexion->query($Tmnnt) or die (mysqli_error());
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
						<label><b>Hab</b></label>
						<input type="number" id="hb" name="hb" required value="<?php echo $eb ?>" />
					</div>
					<div>
						<label><b>Sal</b></label>
						<input type="number" id="sl" name="sl" required value="<?php echo $fb ?>" />
					</div>
					<div>
						<label><b>Com</b></label>
						<input type="number" id="cm" name="cm" required value="<?php echo $gb ?>" />
					</div>
					<div>
						<label><b>Bañ</b></label>
						<input type="number" id="bn" name="bn" required value="<?php echo $hb ?>" />
					</div>
					<div>
						<label><b>Coc</b></label>
						<input type="number" id="coc" name="coc" required value="<?php echo $ib ?>" />
					</div>
					<div>
						<label><b>Bal</b></label>
						<input type="number" id="bal" name="bal" required value="<?php echo $jb ?>" />
					</div>
					<div>
						<label><b>Pat</b></label>
						<input type="number" id="pat" name="pat" required value="<?php echo $kb ?>" />
					</div>
					<div>
						<label><b>Par</b></label>
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
</body>
</html>
<?php
		}
	}
	else{
		echo "<script type='text/javascript'>";
			echo "var pagina='../../errroadm.html';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>