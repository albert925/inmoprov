<?php
	include 'config.php';
	$a=$_POST['xa'];//destacado click
	$b=$_POST['xb'];//id imbueble
	$c=$_POST['xc'];//destacad actual
	$bus_numeros="SELECT * from inmuebles where cod_inm=$b";
	$ensql=mysql_query($bus_numeros,$conexion) or die (mysql_error());
	while ($n=mysql_fetch_array($ensql)) {
		$numA=intval($n['cant_uno']);
		$numB=intval($n['cant_dos']);
		$numC=intval($n['cant_tres']);
		$numD=intval($n['cant_cuatro']);
		$numE=intval($n['cant_cinco']);
	}
	switch ($numA) {
		case '':
			$ma=1;
			break;
		case '0':
			$ma=1;
			break;
		default:
			$ma=1+$numA;
			break;
	}
	switch ($numB) {
		case '':
			$mb=1;
			break;
		case '0':
			$mb=1;
			break;
		default:
			$mb=1+$numB;
			break;
	}
	switch ($numC) {
		case '':
			$mc=1;
			break;
		case '0':
			$mc=1;
			break;
		default:
			$mc=1+$numC;
			break;
	}
	switch ($numD) {
		case '':
			$md=1;
			break;
		case '0':
			$md=1;
			break;
		default:
			$md=1+$numD;
			break;
	}
	switch ($numE) {
		case '':
			$me=1;
			break;
		case '0':
			$me=1;
			break;
		default:
			$me=1+$numE;
			break;
	}
	$total_votos=$ma+$mb+$mc+$md+$me;
	$porcA=($ma/$total_votos)*100;
	$porcB=($mb/$total_votos)*100;
	$porcC=($mc/$total_votos)*100;
	$porcD=($md/$total_votos)*100;
	$porcE=($me/$total_votos)*100;
	$tot=$porcA+$porcB+$porcC+$porcD+$porcE;
	//echo "$total_votos---$porcA-$porcB-$porcC-$porcD-$porcE--Total:$tot";
	$maximo=max($porcA,$porcB,$porcC,$porcD,$porcE);
	//echo "<br/>$maximo";
	if ($porcA>$porcB && $porcA>$porcC && $porcA>$porcD && $porcA>$porcE) {
		$tipo=1;
	}
	else{
		if ($porcB>$porcA && $porcB>$porcC && $porcB>$porcD && $porcB>$porcE) {
			$tipo=2;
		}
		else{
			if ($porcC>$porcA && $porcC>$porcB && $porcC>$porcD && $porcC>$porcE) {
				$tipo=3;
			}
			else{
				if ($porcD>$porcA && $porcD>$porcB && $porcD>$porcC && $porcD>$porcE) {
					$tipo=4;
				}
				else{
					if ($porcE>$porcA && $porcE>$porcB && $porcE>$porcC && $porcE>$porcD) {
						$tipo=5;
					}
					else{
						$tipo=1;
					}
				}
			}
		}
	}
	switch ($a) {
		case '1':
			$cc=",cant_uno='$ma'";
			break;
		case '2':
			$cc=",cant_dos='$mb'";
			break;
		case '3':
			$cc=",cant_tres='$mc'";
			break;
		case '4':
			$cc=",cant_cuatro='$md'";
			break;
		case '5':
			$cc=",cant_cinco='$me'";
			break;
		default:
			$cc="";
			break;
	}
	$modifcar="UPDATE inmuebles set destac_imb='$tipo'$cc where cod_inm=$b";
	mysql_query($modifcar,$conexion) or die (mysql_error());
	echo "2";
?>