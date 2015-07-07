<?php
	include '../config.php';
	$idus=$_POST['prus'];
	$idtp=$_POST['tpib'];
	$ab=$_POST['mnib'];
	$bb=$_POST['barib'];
	$cb=$_POST['dirib'];
	$db=$_POST['estib'];
	$eb=$_POST['hb'];
	$fb=$_POST['sl'];
	$gb=$_POST['cm'];
	$hb=$_POST['bn'];
	$ib=$_POST['coc'];
	$jb=$_POST['bal'];
	$kb=$_POST['pat'];
	$lb=$_POST['par'];
	$mb=$_POST['preib'];
	$nb=$_POST['precdosib'];
	$ob=$_POST['areib'];
	$pb=$_POST['adminib'];
	$qb=$_POST['amobib'];
	$rb=$_POST['superfib'];
	$sb=$_POST['superterib'];
	$tb=$_POST['esdib'];
	$ub=$_POST['disfeib'];
	$vb=$_POST['latib'];
	$wb=$_POST['logib'];
	$xb=$_POST['txib'];
	$hoy=date("Y-m-d");
	$sacarnomb="SELECT * from usuarios where id_us=$idus";
	$sql_usus=mysql_query($sacarnomb,$conexion) or die (mysql_error());
	while ($cu=mysql_fetch_array($sql_usus)) {
		$nomus=$cu['nom_ap_us'];
	}
	if ($idus=="0" || $idus=="" || $idtp=="0" || $idtp=="" || $ab=="0" || $ab=="" || $bb=="0" || $bb=="") {
		echo "<script type='text/javascript'>";
			echo "alert('id usuario, tipo de inmueble, municipio o barrio no disponible');";
			echo "var pagina='../registro';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
	else{
		$ingresar="INSERT into inmuebles(
			usuario_id,tip_inm_id,muni_id,barr_id,
			direccion_inm,estrato,
			hab_inm,sal_inm,com_inm,ban_inm,coc_inm,bal_inm,pat_inm,par_inm,
			prec_inm,prec_m2_inm,area,
			adminis_inm,amobla_inm,
			superficie_m2_inm,superf_terre_inm,
			estd_inm,fe_inm,
			lat_inm,lon_inm,
			descip_inm,fp_inm,quin_publico,
			destac_imb,cant_uno,cant_dos,cant_tres,cant_cuatro,cant_cinco) 
		values(
			$idus,$idtp,$ab,$bb,
			'$cb','$db',
			'$eb','$fb','$gb','$hb','$ib','$jb','$kb','$lb',
			$mb,'$nb','$ob',
			'$pb','$qb',
			'$rb','$sb',
			'$tb','$ub',
			'$vb','$wb',
			'$xb','$hoy','$nomus',
			'0','0','0','0','0','0')";
		mysql_query($ingresar,$conexion) or die (mysql_error());
		echo "<script type='text/javascript'>";
			echo "alert('Inmueble ingresado');";
			echo "var pagina='ind3x.php?us=$idus';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>