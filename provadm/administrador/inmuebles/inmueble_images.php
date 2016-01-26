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
	<title>Inmueble del cod <?php echo "$idR"; ?>|Inmobiliaria Provase</title>
	<link rel="icon" href="../../../imagenes/icon.png" />
	<link rel="stylesheet" href="../../../css/normalize.css" />
	<link rel="stylesheet" href="../../../css/iconos/style.css" />
	<link rel="stylesheet" href="../../../css/style.css" />
	<link rel="stylesheet" href="../../../css/admin.css" />
	<script src="../../../js/jquery_2_1_1.js"></script>
	<script src="../../../js/scripag.js"></script>
	<script src="../../../js/scriadmin.js"></script>
	<script src="../../../js/adminmuebles.js"></script>
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
		<a href="tipos_inmuebles.php">Tipos de Inmuebles</a>
	</nav>
	<section>
		<h1>Imagenes de Inmueble del cod <?php echo "$idR"; ?></h1>
		<article id="automargen">
			<form action="#" method="post" enctype="multipart/form-data" id="nvG_imb" class="columninput">
				<input type="text" id="idib" name="idib" value="<?php echo $idR ?>" required style="display:none;" />
				<label><b>Imagen (resolución permitida 1200 x 1088)</b></label>
				<input type="file" id="imgib" name="imgib" required />
				<div id="txgib"></div>
				<input type="submit" value="Subir e ingresar" id="nvimgimb" />
			</form>
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
				$ssql="SELECT * from images_imb where ib_id=$idR order by id_img_ib asc";
				$rs=$conexion->query($ssql) or die (mysqli_error());
				$num_total_registros= $rs->num_rows;
				$total_paginas= ceil($num_total_registros / $tamno_pagina);
				$gsql="SELECT * from images_imb where ib_id=$idR order by id_img_ib asc limit $inicio, $tamno_pagina";
				$impsql=$conexion->query($gsql) or die (mysqli_error());
				while ($gh=$impsql->fetch_assoc()) {
					$idgmib=$gh['id_img_ib'];
					$rtgmib=$gh['rut_ib'];
			?>
			<figure>
				<img src="../../../<?php echo $rtgmib ?>" alt="imange_<?php echo $idr ?>_<?php echo $idgmib ?>" />
				<figcaption class="columninput">
					<a class="dell" href="borrimagen_imb.php?br=<?php echo $idgmib ?>&ib=<?php echo $idR ?>">Borrar</a>
				</figcaption>
			</figure>
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
							<a href="inmueble_images.php?ib=<?php echo $idR ?>&pagina=<?php echo $i ?>"><?php echo "$i"; ?></a>

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
	}
	else{
		echo "<script type='text/javascript'>";
			echo "var pagina='../../errroadm.html';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>