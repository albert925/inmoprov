<?php
	include '../config.php';
	$idR=$_POST['idib'];
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
	if ($idR=="" ||$idus=="0" || $idus=="" || $idtp=="0" || $idtp=="" || $ab=="0" || $ab=="" || $bb=="0" || $bb=="") {
		echo "<script type='text/javascript'>";
			echo "alert('id usuario, tipo de inmueble, municipio o barrio no disponible');";
			echo "var pagina='../inmuebles';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
	else{
		$modificar="UPDATE inmuebles set
			usuario_id=$idus,tip_inm_id=$idtp,muni_id=$ab,barr_id=$bb,
			direccion_inm='$cb',estrato='$db',
			hab_inm='$eb',sal_inm='$fb',com_inm='$gb',ban_inm='$hb',coc_inm='$ib',bal_inm='$jb',pat_inm='$kb',par_inm='$lb',
			prec_inm=$mb,prec_m2_inm='$nb',area='$ob',
			adminis_inm='$pb',amobla_inm='$qb',
			superficie_m2_inm='$rb',superf_terre_inm='$sb',
			estd_inm='$tb',fe_inm='$ub',
			lat_inm='$vb',lon_inm='$wb',
			descip_inm='$xb' where cod_inm=$idR";
		$conexion->query($modificar) or die (mysqli_error());
		echo "<script type='text/javascript'>";
			echo "alert('Inmueble modificado');";
			echo "var pagina='modif_imb.php?ib=$idR';";
			echo "document.location.href=pagina;";
		echo "</script>";
	}
?>