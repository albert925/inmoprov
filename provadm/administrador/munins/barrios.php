<?php
	include '../../../config.php';
	session_start();
	if (isset($_SESSION['adm'])) {
		$idradd=$_SESSION['adm'];
		$datadm="SELECT * from administrador where id_adm=$idradd";
		$sql_adm=mysql_query($datadm,$conexion) or die (mysql_error());
		while ($ad=mysql_fetch_array($sql_adm)) {
			$usad=$ad['user_adm'];
			$tpad=$ad['tp_adm'];
		}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Administra usuarios" />
	<meta name="keywords" content="Todos los usuarios" />
	<title>Barrios Inmb|Inmobiliaria Provase</title>
	<link rel="icon" href="../../../imagenes/icon.png" />
	<link rel="stylesheet" href="../../../css/normalize.css" />
	<link rel="stylesheet" href="../../../css/iconos/style.css" />
	<link rel="stylesheet" href="../../../css/style.css" />
	<link rel="stylesheet" href="../../../css/admin.css" />
	<script src="../../../js/jquery_2_1_1.js"></script>
	<script src="../../../js/scripag.js"></script>
	<script src="../../../js/scriadmin.js"></script>
	<script src="../../../js/sectores.js"></script>
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
				<li><a class="sel" href="../munins">Municipios y Barrios</a></li>
				<li><a href="../usuarios">Usuarios</a></li>
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
		<a href="../munins">Ver Municipios</a>
		<a id="btB" href="barrios.php">Nuevo Barrio</a>
	</nav>
	<section>
		<h1>Barrios</h1>
		<article id="cjB" class="tdscajaocl">
			<article id="automargen">
				<form action="#" method="post" class="columninput">
					<label>*<b>Del municipio</b></label>
					<select id="slmn">
						<option value="0">Selecione</option>
						<?php
							$tMn="SELECT * from muni_nt_s order by nam_nt asc";
							$sql_mnnt=mysql_query($tMn,$conexion) or die (mysql_error());
							while ($mn=mysql_fetch_array($sql_mnnt)) {
								$idnt=$mn['id_nt'];
								$nant=$mn['nam_nt'];
						?>
						<option value="<?php echo $idnt ?>"><?php echo "$nant"; ?></option>
						<?php
							}
						?>
					</select>
					<label>*<b>Nombre Barrio</b></label>
					<input type="text" id="nambar" required />
					<div id="txC"></div>
					<input type="submit" id="nvbarr" value="Ingresar" />
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
				$ssql="SELECT * from barrios order by nam_barr asc";
				$rs=mysql_query($ssql,$conexion) or die (mysql_error());
				$num_total_registros= mysql_num_rows($rs);
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from barrios order by nam_barr asc limit $inicio, $tamno_pagina";
				$impsql=mysql_query($gsql,$conexion) or die (mysql_error());
				while ($gh=mysql_fetch_array($impsql)) {
					$idbr=$gh['id_barrio'];
					$idbrmn=$gh['munins_id'];
					$nambr=$gh['nam_barr'];
			?>
			<article class="columninput">
				<input type="text" id="nmFbar_<?php echo $idbr ?>" value="<?php echo $nambr ?>" />
				<select id="delmnFf_<?php echo $idbr ?>">
					<?php
						$dosmuni="SELECT * from muni_nt_s order by nam_nt asc";
						$sql_diosmn=mysql_query($dosmuni,$conexion) or die (mysql_error());
						while ($Umn=mysql_fetch_array($sql_diosmn)) {
							$idUmn=$Umn['id_nt'];
							$nmUmn=$Umn['nam_nt'];
							if ($idUmn==$idbrmn) {
								$selmuni="selected";
							}
							else{
								$selmuni="";
							}
					?>
					<option value="<?php echo $idUmn ?>" <?php echo $selmuni ?>><?php echo "$nmUmn"; ?></option>
					<?php
						}
					?>
				</select>
				<div id="txD_<?php echo $idbr ?>"></div>
				<input type="submit" value="modificar" class="cammbar" data-id="<?php echo $idbr ?>" />
				<a href="borrar_barr.php?br=<?php echo $idbr ?>" class="dell">Borrar</a>
			</article>
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
							<a href="barrios.php?pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

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