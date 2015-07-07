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

		$cca=$_GET['ba'];//Ordernar
		$ccb=$_GET['bb'];//tipo inmueble
		$ccc=$_GET['bc'];//municipios
		$ccd=$_GET['bd'];//barrios
		$cce=$_GET['be'];//# hab
		$ccf=$_GET['bf'];//prec min
		$ccg=$_GET['bg'];//prec max
		$cch=$_GET['bh'];//cod imb
		$arrordenfil=['cod_inm desc','cod_inm asc','cod_inm desc','prec_inm asc','prec_inm desc'];
		switch ($ccb) {
			case '0':
				$rgbb="";
				break;
			case '':
				$rgbb="";
				break;
			default:
				$rgbb="and tip_inm_id=$ccb";
				break;
		}
		switch ($ccc) {
			case '0':
				$rgcc="";
				break;
			case '':
				$rgcc="";
				break;
			default:
				$rgcc="and muni_id=$ccc";
				break;
		}
		switch ($ccd) {
			case '0':
				$rgdd="";
				break;
			case '':
				$rgdd="";
				break;
			default:
				$rgdd="and barr_id=$ccd";
				break;
		}
		switch ($cce) {
			case '0':
				$rgee="";
				break;
			case '':
				$rgee="";
				break;
			default:
				$rgee="and hab_inm='$cce'";
				break;
		}
		switch ($ccf) {
			case '0':
				$rgff="";
				break;
			case '':
				$rgff="";
				break;
			default:
				$rgff="and prec_inm>=$ccf";
				break;
		}
		switch ($ccg) {
			case '0':
				$rggg="";
				break;
			case '':
				$rggg="";
				break;
			default:
				$rggg="and prec_inm<=$ccg";
				break;
		}
		switch ($cch) {
			case '0':
				$rghh="";
				break;
			case '':
				$rghh="";
				break;
			default:
				$rghh="and cod_inm=$cch";
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
				<a id="btC" href="#">Nuevo Inmueble</a>
				<a href="images_inmueble.php">Imagenes de Inmuebles</a>
			</nav>
		</article>
	</section>
	<section id="genT">
		<article id="cjC" class="tdscajaocl">
			<article id="automargen">
				<form action="new_inmueble.php" method="post" class="columninput">
					<input type="text" id="prus" name="prus" value="<?php echo $idus ?>" required style="display:none;" />
					<label>*<b>Del tipo</b></label>
					<select id="tpib" name="tpib">
						<option value="0">Seleccione</option>
						<?php
							$tdtp="SELECT * from tipo_inmueble order by nam_tp asc";
							$sql_tdtp=mysql_query($tdtp,$conexion) or die (mysql_error());
							while ($tpU=mysql_fetch_array($sql_tdtp)) {
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
							$sql_mnnt=mysql_query($Tmnnt,$conexion) or die (mysql_error());
							while ($Umn=mysql_fetch_array($sql_mnnt)) {
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
							$sql_tdbar=mysql_query($Tdbarr,$conexion) or die (mysql_error());
							while ($Ubarr=mysql_fetch_array($sql_tdbar)) {
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
						<option value="<?php echo $ioes ?>"><?php echo "$arrestado[$ioes]"; ?></option>
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
		<article id="filtros" class="filimb">
			<select id="bsA">
				<?php
					$arrorden=["Ordernar por","Cod asc","Cod Desc","Menor a Mayor precio",
					"Mayor a Menor precio"];
					for ($sSa=0; $sSa <=4 ; $sSa++) {
						if ($sSa==$cca) {
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
				<option value="0">Tipo de Inmueble</option>
				<?php
					$busTipos="SELECT * from tipo_inmueble order by nam_tp asc";
					$sql_bustp=mysql_query($busTipos,$conexion) or die (mysql_error());
					while ($Outp=mysql_fetch_array($sql_bustp)) {
						$idOutp=$Outp['id_tp'];
						$nmOutp=$Outp['nam_tp'];
						if ($idOutp==$ccb) {
							$seldostipo="selected";
						}
						else{
							$seldostipo="";
						}
				?>
				<option value="<?php echo $idOutp ?>" <?php echo $seldostipo ?>><?php echo "$nmOutp"; ?></option>
				<?php
					}
				?>
			</select>
			<select id="bsC">
				<option value="0">Municipios</option>
				<?php
					$filmunis="SELECT * from muni_nt_s order by nam_nt asc";
					$sql_filmuni=mysql_query($filmunis,$conexion) or die (mysql_error());
					while ($filmn=mysql_fetch_array($sql_filmuni)) {
						$idflmn=$filmn['id_nt'];
						$nmflmn=$filmn['nam_nt'];
						if ($idflmn==$ccc) {
							$seldosmuni="selected";
						}
						else{
							$seldosmuni="";
						}
				?>
				<option value="<?php echo $idflmn ?>" <?php echo $seldosmuni ?>><?php echo "$nmflmn"; ?></option>
				<?php
					}
				?>
			</select>
			<select id="bsD">
				<option value="0">Barrios</option>
				<?php
					$flbar="SELECT * from barrios order by nam_barr asc";
					$sql_flbar=mysql_query($flbar,$conexion) or die (mysql_error());
					while ($fbr=mysql_fetch_array($sql_flbar)) {
						$idfbar=$fbr['id_barrio'];
						$nmfbar=$fbr['nam_barr'];
						if ($idfbar==$ccd) {
							$seldosbarr="selected";
						}
						else{
							$seldosbarr="";
						}
				?>
				<option value="<?php echo $idfbar ?>" <?php echo $seldosbarr ?>><?php echo "$nmfbar"; ?></option>
				<?php
					}
				?>
			</select>
			<input type="number" id="bsE" placeholder="# hab" style="width:70px;" value="<?php echo $cce ?>" />
			<input type="number" id="bsF" placeholder="Prec Min (solo números)" value="<?php echo $ccf ?>" />
			<input type="number" id="bsG" placeholder="Prec. Max (solo números)" value="<?php echo $ccg ?>" />
			<input type="number" id="bsH" placeholder="Cod Inmueble" value="<?php echo $cch ?>" />
		</article>
		<h2>Mis Inmuebles</h2>
		<article class="tblus">
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
				$ssql="SELECT * from inmuebles where usuario_id=$idus $rgbb $rgcc $rgdd $rgee $rgff $rggg $rghh 
					order by $arrordenfil[$cca]";
				$rs=mysql_query($ssql,$conexion) or die (mysql_error());
				$num_total_registros= mysql_num_rows($rs);
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from inmuebles where usuario_id=$idus $rgbb $rgcc $rgdd $rgee $rgff $rggg $rghh 
					order by $arrordenfil[$cca] limit $inicio, $tamno_pagina";
				$impsql=mysql_query($gsql,$conexion) or die (mysql_error());
			?>
			<table border="1">
				<tr>
					<td><b>Cod</b></td>
					<td><b>Tipo Inm.</b></td>
					<td><b>Mun/Barrio</b></td>
					<td><b>Direc</b></td>
					<td><b>Hab</b></td>
					<td><b>Sal</b></td>
					<td><b>Com</b></td>
					<td><b>Bañ</b></td>
					<td><b>Coc</b></td>
					<td><b>Bal</b></td>
					<td><b>Pat</b></td>
					<td><b>Par</b></td>
					<td><b>Precio</b></td>
					<td><b>Estado</b></td>
					<td><b>Modif/Images</b></td>
				</tr>
			<?php
				while ($gh=mysql_fetch_array($impsql)) {
					$idb=$gh['cod_inm'];
					$usb=$gh['usuario_id'];
					$tpb=$gh['tip_inm_id'];
					$ab=$gh['muni_id'];
					$bb=$gh['barr_id'];
					$cb=$gh['direccion_inm'];
					$db=$gh['estrato'];
					$eb=$gh['hab_inm'];
					$fb=$gh['sal_inm'];
					$gb=$gh['com_inm'];
					$hb=$gh['ban_inm'];
					$ib=$gh['coc_inm'];
					$jb=$gh['bal_inm'];
					$kb=$gh['pat_inm'];
					$lb=$gh['par_inm'];
					$mb=$gh['prec_inm'];
					$nb=$gh['prec_m2_inm'];
					$ob=$gh['area'];
					$pb=$gh['adminis_inm'];
					$qb=$gh['amobla_inm'];
					$rb=$gh['superficie_m2_inm'];
					$sb=$gh['superf_terre_inm'];
					$tb=$gh['estd_inm'];
					$ub=$gh['fe_inm'];
					$vb=$gh['lat_inm'];
					$wb=$gh['lon_inm'];
					$xb=$gh['descip_inm'];
					$yb=$gh['ff_inm'];
					$zb=$gh['fp_inm'];
					$aab=$gh['quin_publico'];
					$abb=$gh['destac_imb'];
					$acb=$gh['cant_uno'];
					$adb=$gh['cant_dos'];
					$aeb=$gh['cant_tres'];
					$afb=$gh['cant_cuatro'];
					$agb=$gh['cant_cinco'];
			?>
			<tr>
				<td><b><?php echo "$idb"; ?></b></td>
				<td><?php echo Nomtipos($tpb,$conexion); ?></td>
				<td><?php echo NomMunici($ab,$conexion); ?>/<?php echo NomBarr($bb,$conexion); ?></td>
				<td><?php echo "$cb"; ?></td>
				<td><?php echo "$eb"; ?></td>
				<td><?php echo "$fb"; ?></td>
				<td><?php echo "$gb"; ?></td>
				<td><?php echo "$hb"; ?></td>
				<td><?php echo "$ib"; ?></td>
				<td><?php echo "$jb"; ?></td>
				<td><?php echo "$kb"; ?></td>
				<td><?php echo "$lb"; ?></td>
				<td>$ <?php echo number_format($mb); ?></td>
				<td><?php echo $arrestado[$tb]; ?></td>
				<td>
					<a href="modif_imb.php?ib=<?php echo $idb ?>">Modificar</a><br />
					<a href="inmueble_images.php?ib=<?php echo $idb ?>">Imagenes</a>
				</td>
			</tr>
			<?php
				}
			?>
			</table>
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
							<a href="inmu2bles.php?ba=<?php echo $cca ?>&bb=<?php echo $ccb ?>&bc=<?php echo $ccc ?>&bd=<?php echo $ccd ?>&be=<?php echo $cce ?>&bf=<?php echo $ccf ?>&bg=<?php echo $ccg ?>&bh=<?php echo $cch ?>&pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

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