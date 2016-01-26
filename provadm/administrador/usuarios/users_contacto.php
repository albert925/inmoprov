<?php
	include '../../../config.php';
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
		$idR=$_GET['us'];
		if ($idR=="") {
			echo "<script type='text/javascript'>";
				echo "alert('id de usuario no disponible');";
				echo "var pagina='../../errroadm.html';";
				echo "document.location.href=pagina;";
			echo "</script>";
		}
		else{
			$datos="SELECT * from usuarios where id_us=$idR";
			$sql_datos=$conexion->query($datos) or die (mysqli_error());
			while ($dt=$sql_datos->fetch_assoc()) {
				$idus=$dt['id_us'];
				$ccus=$dt['cc_us'];
				$nmus=$dt['nom_ap_us'];
				$crus=$dt['cor_us'];
				$tlus=$dt['tel_us'];
				$mvus=$dt['mov_us'];
				$dpus=$dt['depart_id'];
				$mnus=$dt['muni_id'];
				$drus=$dt['direc_us'];
				$esus=$dt['estd_us'];
				$fius=$dt['fecr_us'];
			}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, maximun-scale=1" />
	<meta name="description" content="Administra usuarios" />
	<meta name="keywords" content="Todos los usuarios" />
	<title>Contactos de <?php echo "$nmus"; ?>|Inmobiliaria Provase</title>
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
		<a href="../usuarios">Ver Usuarios</a>
		<a id="btB" href="cont_users.php">Nuevo contactos</a>
	</nav>
	<section>
		<h1>Contactos de <?php echo "$nmus"; ?></h1>
		<article id="cjB" class="tdscajaocl">
			<article id="automargen">
				<form action="#" method="post" class="columninput">
					<input type="text" id="idus" value="<?php echo $idR ?>" required style="display:none;" />
					<label>*<b>Nombre contacto</b></label>
					<input type="text" id="namcont" />
					<label>*<b>Número</b></label>
					<input type="tel" id="telcelcont" />
					<div id="txUS"></div>
					<input type="submit" id="nvconus" value="Ingresar" />
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
				$ssql="SELECT * from otros_cont where us_id=$idR order by nam_cont asc";
				$rs=$conexion->query($ssql) or die (mysqli_error());
				$num_total_registros= $rs->num_rows;
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from otros_cont where us_id=$idR order by nam_cont asc limit $inicio, $tamno_pagina";
				$impsql=$conexion->query($gsql) or die (mysqli_error());
				while ($gh=$impsql->fetch_assoc()) {
					$idct=$gh['id_cont'];
					$nmct=$gh['nam_cont'];
					$nuct=$gh['num_cont'];
			?>
			<article class="columninput">
				<input type="text" id="nfnmct_<?php echo $idct ?>" value="<?php echo $nmct ?>" />
				<input type="tel" id="numfnumct_<?php echo $idct ?>" value="<?php echo $nuct ?>" />
				<div id="txE_<?php echo $idct ?>"></div>
				<input type="submit" value="Modificar" class="mofcoont" data-id="<?php echo $idct ?>" />
				<a href="borrar_cont.php?br=<?php echo $idct ?>&us=<?php echo $idR ?>" class="dell">Borrar</a>
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
							<a href="users_contacto.php?us=<?php echo $idR ?>&pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

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
					<div><span class="icon-old-phone"> 314 394 1701 - 315 827 4399</span></div>
					<div><span class="icon-mail"></span> correo@dominio.com</div>
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
	}
	else{
		echo "<script type='text/javascript'>";
			echo "var pagina='../../errroadm.html';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>