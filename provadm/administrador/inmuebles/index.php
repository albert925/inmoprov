<?php
	include '../../../config.php';
	include '../../../fecha_format.php';
	session_start();
	if (isset($_SESSION['adm'])) {
		$idradd=$_SESSION['adm'];
		$datadm="SELECT * from administrador where id_adm=$idradd";
		$sql_adm=mysql_query($datadm,$conexion) or die (mysql_error());
		while ($ad=mysql_fetch_array($sql_adm)) {
			$usad=$ad['user_adm'];
			$tpad=$ad['tp_adm'];
		}
		$mH=date("m");
		$yH=date("Y");	
		$arrestado=["Seleccione","Arrendar","Venta","Arrendado","Vendido"];
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
		function nompropietario($dato,$serv)
		{
			$sacarpropir="SELECT * from usuarios where id_us=$dato";
			$sql_usu=mysql_query($sacarpropir,$serv) or die (mysql_error());
			while ($Uus=mysql_fetch_array($sql_usu)) {
				$nmsus=$Uus['nom_ap_us'];
			}
			return $nmsus;
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
		<a id="btC" href="#">Nuevo Inmueble</a>
		<a href="images_inmueble.php">Imagenes de Inmuebles</a>
		<a href="tipos_inmuebles.php">Tipos de Inmuebles</a>
	</nav>
	<section>
		<h1>Inmuebles</h1>
		<article id="cjC" class="tdscajaocl">
			<article id="automargen">
				<form action="new_inmueble.php" method="post" class="columninput">
					<label>*<b>Del Propietario (usuario)</b></label>
					<select id="prus" name="prus">
						<option value="0">Seleccione</option>
						<?php
							$Tous="SELECT * from usuarios order by id_us desc";
							$sql_us=mysql_query($Tous,$conexion) or die (mysql_error());
							while ($osus=mysql_fetch_array($sql_us)) {
								$idus=$osus['id_us'];
								$nmus=$osus['nom_ap_us'];
						?>
						<option value="<?php echo $idus ?>"><?php echo "$nmus"; ?></option>
						<?php
							}
						?>
					</select>
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
							<label><b>Hab</b></label>
							<input type="number" id="hb" name="hb" required />
						</div>
						<div>
							<label><b>Sal</b></label>
							<input type="number" id="sl" name="sl" required />
						</div>
						<div>
							<label><b>Com</b></label>
							<input type="number" id="cm" name="cm" required />
						</div>
						<div>
							<label><b>Bañ</b></label>
							<input type="number" id="bn" name="bn" required />
						</div>
						<div>
							<label><b>Coc</b></label>
							<input type="number" id="coc" name="coc" required />
						</div>
						<div>
							<label><b>Bal</b></label>
							<input type="number" id="bal" name="bal" required />
						</div>
						<div>
							<label><b>Pat</b></label>
							<input type="number" id="pat" name="pat" required />
						</div>
						<div>
							<label><b>Par</b></label>
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
				?>
				<option value="<?php echo $sSa ?>"><?php echo $arrorden[$sSa]; ?></option>
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
				?>
				<option value="<?php echo $idOutp ?>"><?php echo "$nmOutp"; ?></option>
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
				?>
				<option value="<?php echo $idflmn ?>"><?php echo "$nmflmn"; ?></option>
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
				?>
				<option value="<?php echo $idfbar ?>"><?php echo "$nmfbar"; ?></option>
				<?php
					}
				?>
			</select>
			<input type="number" id="bsE" placeholder="# hab" style="width:70px;" />
			<input type="number" id="bsF" placeholder="Prec Min (solo números)" />
			<input type="number" id="bsG" placeholder="Prec. Max (solo números)" />
			<input type="number" id="bsH" placeholder="Cod Inmueble" />
		</article>
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
				$ssql="SELECT * from inmuebles order by cod_inm desc";
				$rs=mysql_query($ssql,$conexion) or die (mysql_error());
				$num_total_registros= mysql_num_rows($rs);
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from inmuebles order by cod_inm desc limit $inicio, $tamno_pagina";
				$impsql=mysql_query($gsql,$conexion) or die (mysql_error());
			?>
			<table border="1">
				<tr>
					<td><b>Cod</b></td>
					<td><b>Prop. (Usuario)</b></td>
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
					<td><b>Eliminar</b></td>
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
				<td><a href="../usuarios/ind3x.php?us=<?php echo $usb ?>"><?php echo nompropietario($usb,$conexion); ?></a></td>
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
				<td>
					<select class="cambestdibG" id="esG_<?php echo $idb ?>" data-id="<?php echo $idb ?>">
						<?php
							for ($ies=0; $ies <=4 ; $ies++) {
								if ($ies==$tb) {
									$selestado="selected";
								}
								else{
									$selestado="";
								}
						?>
						<option value="<?php echo $ies ?>" <?php echo $selestado ?>><?php echo $arrestado[$ies]; ?></option>
						<?php
							}
						?>
					</select>
				</td>
				<td>
					<a href="modif_imb.php?ib=<?php echo $idb ?>">Modificar</a><br />
					<a href="inmueble_images.php?ib=<?php echo $idb ?>">Imagenes</a>
				</td>
				<td><a class="dell" href="borr_inmueble.php?br=<?php echo $idb ?>">Brorrar</a></td>
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
							<a href="index.php?pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

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