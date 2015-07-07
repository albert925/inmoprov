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
		$arrestado=["Seleccione","Activado","Desactivado"];
		function nomDepart($dato,$serv)
		{
			$nomdtp="SELECT * from departamentos where id_depart='$dato'";
			$sql_depart=mysql_query($nomdtp,$serv);
			$numdepar=mysql_num_rows($sql_depart);
			if ($numdepar>0) {
				while ($dpt=mysql_fetch_array($sql_depart)) {
					$nmdp=$dpt['nam_depart'];
				}
			}
			else{
				$nmdp="No selecionado";
			}
			return $nmdp;
		}
		function nomMuni($dato,$serv)
		{
			$sqlmn="SELECT * from municipios where id_municipio='$dato'";
			$sql_rtmn=mysql_query($sqlmn,$serv) or die (mysql_error());
			$nummuni=mysql_num_rows($sql_rtmn);
			if ($nummuni>0) {
				while ($mn=mysql_fetch_array($sql_rtmn)) {
					$nmmnm=$mn['nam_muni'];
				}
			}
			else{
				$nmmnm="No selecionado";
			}
			return $nmmnm;
		}
		$rb=$_GET['bb'];//order id nom as desc
		$mesR=$_GET['bc'];//mes
		$yH=$_GET['bd'];//año
		$ara=["estd_us asc","estd_us asc","estd_us desc"];
		$brb=["id_us asc","id_us asc","id_us desc","nom_ap_us asc","nom_ap_us desc","cc_us asc","cc_us desc"];
		if ($mesR<10) {
			$mH="0".$mesR;
		}
		else{
			$mH=$mesR;
		}
		switch ($mH) {
			case '0':
				$fein=$yH."-01-00";
				$feff=$yH."-12-31";
				break;
			case '00':
				$fein=$yH."-01-00";
				$feff=$yH."-12-31";
				break;
			case '':
				$fein=$yH."-01-00";
				$feff=$yH."-12-31";
				break;
			default:
				$fein=$yH."-".$mH."-00";
				$feff=$yH."-".$mH."-31";
				break;
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Administra usuarios" />
	<meta name="keywords" content="Todos los usuarios" />
	<title>Administrar Usuarios|Inmobiliaria Provase</title>
	<link rel="icon" href="../../../imagenes/icon.png" />
	<link rel="stylesheet" href="../../../css/normalize.css" />
	<link rel="stylesheet" href="../../../css/iconos/style.css" />
	<link rel="stylesheet" href="../../../css/style.css" />
	<link rel="stylesheet" href="../../../css/admin.css" />
	<script src="../../../js/jquery_2_1_1.js"></script>
	<script src="../../../js/scripag.js"></script>
	<script src="../../../js/scriadmin.js"></script>
	<script src="../../../js/aadmusers.js"></script>
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
				<li><a class="sel" href="../usuarios">Usuarios</a></li>
				<li><a href="../inmuebles">Inmuebles</a></li>
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
		<a id="btA" href="#">Nuevo Usuario</a>
		<a href="cont_users.php">Mas contactos</a>
	</nav>
	<section>
		<h1>Usuarios</h1>
		<article id="cjA" class="tdscajaocl">
			<article id="automargen">
				<form action="#" method="post" class="columninput">
					<label>*<b>Nombres y Apellidos</b></label>
					<input type="text" id="namus" required />
					<label><b>Cédula</b></label>
					<input type="tel" id="cecus" />
					<label><b>Correo</b></label>
					<input type="email" id="corus" />
					<label><b>Teléfono</b></label>
					<input type="tel" id="telus" />
					<label><b>Celular</b></label>
					<input type="tel" id="movus" />
					<label><b>Dirección</b></label>
					<input type="text" id="dirus" />
					<div id="txA"></div>
					<input type="submit" id="nvus" value="Ingresar" />
				</form>
			</article>
		</article>
		<article id="filtros" class="fila">
			<select id="busB">
				<?php
					$arrordendos=["Ordenar","Id asc","Id desc","nombre asc","nombre desc","Cedula asc","Cedula desc"];
					for ($ob=0; $ob <=6 ; $ob++) {
						if ($ob==$rb) {
							$selorddos="selected";
						}
						else{
							$selorddos="";
						}
				?>
				<option value="<?php echo $ob ?>" <?php echo $selorddos ?>><?php echo $arrordendos[$ob]; ?></option>
				<?php
					}
				?>
			</select>
			<select id="busC">
				<?php
					$arrmeses=["Meses","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto",
						"Septiembre","Octubre","Noviembre","Diciembre"];
					for ($oc=0; $oc <=12 ; $oc++) {
						if ($oc==$mesR) {
							$selmes="selected";
						}
						else{
							$selmes="";
						}
				?>
				<option value="<?php echo $oc ?>" <?php echo $selmes ?>><?php echo $arrmeses[$oc]; ?></option>
				<?php
					}
				?>
			</select>
			<select id="busD">
				<?php
					for ($od=2015; $od <=($yH+1) ; $od++) {
						if ($od==$yH) {
							$selyear="selected";
						}
						else{
							$selyear="";
						}
				?>
				<option value="<?php echo $od ?>" <?php echo $selyear ?>><?php echo "$od"; ?></option>
				<?php
					}
				?>
			</select>
			<input type="text" id="busE" placeholder="Buscar por nombre" />
		</article>
		<div id="cargadorus"></div>
		<article id="resulNombres">
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
				$ssql="SELECT * from usuarios where fecr_us>='$fein' and fecr_us<='$feff' order by $brb[$rb]";
				$rs=mysql_query($ssql,$conexion) or die (mysql_error());
				$num_total_registros= mysql_num_rows($rs);
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from usuarios where fecr_us>='$fein' and fecr_us<='$feff' order by $brb[$rb] limit $inicio, $tamno_pagina";
				$impsql=mysql_query($gsql,$conexion) or die (mysql_error());
			?>
			<table border="1">
				<tr>
					<td><b>Id</b></td>
					<td><b>Cédula</b></td>
					<td><b>Nombres</b></td>
					<td><b>Correo</b></td>
					<td><b>Teléfono</b></td>
					<td><b>Depar/Muni</b></td>
					<td><b>Dirección</b></td>
					<td><b>Estado</b></td>
					<td><b>Fecha Registro</b></td>
					<td><b>Mas contactos</b></td>
				</tr>
			<?php
				while ($gh=mysql_fetch_array($impsql)) {
					$idus=$gh['id_us'];
					$ccus=$gh['cc_us'];
					$nmus=$gh['nom_ap_us'];
					$crus=$gh['cor_us'];
					$tlus=$gh['tel_us'];
					$mvus=$gh['mov_us'];
					$dpus=$gh['depart_id'];
					$mnus=$gh['muni_id'];
					$drus=$gh['direc_us'];
					$esus=$gh['estd_us'];
					$fius=$gh['fecr_us'];
			?>
			<tr>
				<td><b><?php echo "$idus"; ?></b></td>
				<td><?php echo "$ccus"; ?></td>
				<td><?php echo "$nmus"; ?></td>
				<td><?php echo "$crus"; ?></td>
				<td><?php echo "$tlus/$mvus"; ?></td>
				<td><?php echo nomDepart($dpus,$conexion); ?>/<?php echo nomMuni($mnus,$conexion); ?></td>
				<td><?php echo "$drus"; ?></td>
				<td>
					<select id="acdest_<?php echo $idus ?>" class="genestd" data-id="<?php echo $idus ?>">
						<?php
							for ($bi=0; $bi <=2 ; $bi++) { 
								if ($bi==$esus) {
									$selestado="selected";
								}
								else{
									$selestado="";
								}
						?>
						<option value="<?php echo $bi ?>" <?php echo $selestado ?>><?php echo $arrestado[$bi]; ?></option>
						<?php
							}
						?>
					</select>
				</td>
				<td><?php echo fechatraducearray($fius); ?></td>
				<td><a class="lktable" href="users_contacto.php?us=<?php echo $idus ?>">Ver mas contactos</a></td>
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
							<a href="ind2x.php?bb=<?php echo $rb ?>&bc=<?php echo $mesR ?>&bd=<?php echo $yH ?>&pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

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
	<script src="http://www.google.com/jsapi"></script>
	<script src="../../../js/colmapa.js"></script>
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