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
	<meta name="description" content="Información y actulizar datos de <?php echo $nmus ?>" />
	<meta name="keywords" content="Actulizar datos de usuario" />
	<title>Datos <?php echo "$nmus"; ?>|Inmobiliaria Provase</title>
	<link rel="icon" href="../imagenes/icon.png" />
	<link rel="stylesheet" href="../css/normalize.css" />
	<link rel="stylesheet" href="../css/iconos/style.css" />
	<link rel="stylesheet" href="../css/style.css" />
	<link rel="stylesheet" href="../css/users.css" />
	<script src="../js/jquery_2_1_1.js"></script>
	<script src="../js/scripag.js"></script>
	<script src="../js/usuarious.js"></script>
</head>
<body>
	<header id="automargen">
		<figure id="logo">
			<a href="../">
				<img src="../imagenes/logo.png" alt="logo" />
			</a>
		</figure>
		<h1><?php echo "$nmus"; ?></h1>
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
						<li><a  class="sel" href="../usuario">Información</a></li>
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
	<section>
		<article id="automargen">
			<h2 id="disubdos">Datos <?php echo "$nmus"; ?></h2>
			<article class="users">
				<article class="columninput">
					<h2>Modificar datos</h2>
					<label>*<b>Nombre y Apellidos</b></label>
					<input type="text" id="nomfus" value="<?php echo $nmus ?>" />
					<label><b>Teléfono</b></label>
					<input type="tel" id="tlfus" value="<?php echo $tlus ?>" />
					<label>*<b>Celular</b></label>
					<input type="tel" id="mvfus" value="<?php echo $mvus ?>" />
					<label>*<b>Departamento</b></label>
					<select id="dptfus">
						<option value="0">Seleccione</option>
						<?php
							$Tddepart="SELECT * from departamentos order by nam_depart asc";
							$sql_tddepar=mysql_query($Tddepart,$conexion) or die (mysql_error());
							while ($dp=mysql_fetch_array($sql_tddepar)) {
								$idpd=$dp['id_depart'];
								$nmdp=$dp['nam_depart'];
								if ($idpd==$dpus) {
									$seldepart="selected";
								}
								else{
									$seldepart="";
								}
						?>
						<option value="<?php echo $idpd ?>" <?php echo $seldepart ?>><?php echo "$nmdp"; ?></option>
						<?php
							}
						?>
					</select>
					<div id="loaddepart"></div>
					<label>*<b>Municipio</b></label>
					<select id="mnfus">
						<option value="0">Seleccione</option>
						<?php
							$Tmunis="SELECT * from municipios order by nam_muni asc";
							$sql_muni=mysql_query($Tmunis,$conexion) or die (mysql_error());
							while ($sm=mysql_fetch_array($sql_muni)) {
								$idmn=$sm['id_municipio'];
								$nmmn=$sm['nam_muni'];
								if ($idmn==$mnus) {
									$selmuni="selected";
								}
								else{
									$selmuni="";
								}
						?>
						<option value="<?php echo $idmn ?>" <?php echo $selmuni ?>><?php echo "$nmmn"; ?></option>
						<?php
							}
						?>
					</select>
					<label><b>Dirección</b></label>
					<input type="text" id="drfus" value="<?php echo $drus ?>" />
					<div id="txA"></div>
					<input type="submit" value="Modificar" id="camusA" data-id="<?php echo $idus ?>" />
				</article>
				<article class="columninput">
					<h2>Modificar correo</h2>
					<input type="email" id="corfus" value="<?php echo $crus ?>" />
					<div id="txB"></div>
					<input type="submit" value="Modificar" id="camusB" data-id="<?php echo $idus ?>" />
					<h2>Cédula</h2>
					<?php
						if ($ccus=="") {
					?>
					<label>*<b>Cédula</b></label>
					<input type="number" id="ccfus" value="<?php echo $ccus ?>" />
					<div id="txD"></div>
					<input type="submit" value="modificar" id="camusD" data-id="<?php echo $idus ?>" />
					<?php
						}
						else{
					?>
					<div><?php echo "$ccus"; ?></div>
					<?php
						}
					?>
				</article>
				<article class="columninput">
					<h2>Modificar Contraseña</h2>
					<label>*<b>Contraseña actual</b></label>
					<input type="password" id="psact" />
					<label>*<b>Contraseña nueva</b></label>
					<input type="password" id="psnva" />
					<label>*<b>Rrepite la contraseña nueva</b></label>
					<input type="password" id="psnvb" />
					<div id="txC"></div>
					<input type="submit" value="Modificar" id="camusC" data-id="<?php echo $idus ?>" />
				</article>
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