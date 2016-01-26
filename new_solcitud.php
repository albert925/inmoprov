<?php
	include 'config.php';
	$idR=$_POST['fid'];//id inmueble
	$a=$_POST['a'];//nombre
	$b=$_POST['b'];//telefono
	$c=$_POST['c'];//correo
	$d=$_POST['d'];//mensaje

	function Nomtipos($dato,$serv)
	{
		$sacarnombtp="SELECT * from tipo_inmueble where id_tp=$dato";
		$sql_sacartipo=$serv->query($sacarnombtp)  or die (mysqli_error());
		while ($wtp=$sql_sacartipo->fetch_assoc()) {
			$namwtp=$wtp['nam_tp'];
		}
		return $namwtp;
	}
	function NomMunici($dato,$serv)
	{
		$sacarnommunic="SELECT * from muni_nt_s where id_nt='$dato'";
		$sql_sacarmuni=$serv->query($sacarnommunic) or die (mysqli_error());
		$nummuni=$sql_sacarmuni->num_rows;
		if ($nummuni>0) {
			while ($wmn=$sql_sacarmuni->fetch_assoc()) {
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
		$sql_sacbarr=$serv->query($sacarnombarr) or die (mysqli_error());
		$numbarrio=$sql_sacbarr->num_rows;
		if ($numbarrio>0) {
			while ($brw=$sql_sacbarr->fetch_assoc()) {
				$nambarw=$brw['nam_barr'];
			}
		}
		else{
			$nambarw="No selecionado";
		}
		return $nambarw;
	}
	function colocardato($ibdat,$numero)
	{
		$palabrcol=["","Estrato","Habitacion","Sala","Comedor","Baño","Cocina","Balcón","Patio",
			"Parqueadero","Precio por m<sup>2</sup>","Area","Administración",
			"Amoblado","Superficie (m<sup>2</sup>)","Superficie de terreno (m<sup>2</sup>)"];
		switch ($ibdat) {
			case '0':
				$colcarpalabra="";
				break;
			case '':
				$colcarpalabra="";
				break;
			default:
				$colcarpalabra="<tr><td><b>".$palabrcol[$numero].":</b></td><td>$ibdat</td></tr>";
				break;
		}
		return $colcarpalabra;
	}
	$arrestado=["Seleccione","Arriendo","Venta","Arrendado","Vendido"];

	if ($idR=="" ||$a=="" || $b=="" || $c=="") {
		echo "1";
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
		include 'miler/class.phpmailer.php';
		$mail=new PHPMailer();
		$body="<section style='max-width:1100px;'>
			<header>
				<figure>
					<img src='http://inmobiliariaprovase.com.co/imagenes/logo.png' alt='logo' />
				</figure>
				<h1>Solcitud de $a</h1>
			</header>
			<section>
				<article>
					<p>
						El usuario $a solicitud el inmueble del codigo $idR con los siguientes datos.
					</p>
					<h3>Información del solicitante</h3>
					<p>
						<b>Nombres: </b>$a<br />
						<b>Teléfono: </b>$b<br />
						<b>Correo: </b>$c<br />
						<b>Mensaje: </b>
					</p>
					<p>$d</p>
					<h3>
						".Nomtipos($tpb,$conexion)." en ".$arrestado[$tb]." - ".NomMunici($ab,$conexion)."/".NomBarr($bb,$conexion).
					"</h3>
					<article>
						<h3>Descripción</h3>
						<table>
							<tr>
								<td><b>Cod:</b></td>
								<td>$idR</td>
							</tr>
							<tr>
								<td><b>Precio:</b></td>
								<td>$ ".number_format($mb)."</td>
							</tr>
							<tr>
								<td><b>Tipo de Inmueble:</b></td>
								<td>".Nomtipos($tpb,$conexion)."</td>
							</tr>
							<tr>
								<td><b>Tipo de operación:</b></td>
								<td>".$arrestado[$tb]."</td>
							</tr>
							<tr>
								<td><b>Ubicación:</b></td>
								<td>".NomMunici($ab,$conexion)."/".NomBarr($bb,$conexion)."</td>
							</tr>";
							$buspal=['',$db,$eb,$fb,$gb,$hb,$ib,$jb,$kb,$lb,'$ '.number_format($nb),$ob,$pb,$qb,$rb,$sb];
							for ($trtbl=1; $trtbl <=15 ; $trtbl++) {
								$posid=$buspal[$trtbl]; 
								$body.=colocardato($posid,$trtbl);
							}
		$body.="</table>
					</article>
				</article>
				<article>
					<a herf='http://inmobiliariaprovase.com.co/' target='_blank'>Página</a>
				</article>
			</section>
		</section>";
		$mail->SetFrom('$c','$a');
		$mail->From = "$c";
		$mail->FromName = "$a";
		$mail->AddReplyTo('$c','$a');
		$address="Info@inmobiliariaprovase.com.co";
		$mail->AddAddress($address, "Inmobiliaria Provase");
		$mail->AddAddress("albertarias925@gmail.com", "albert arias");
		$mail->Subject = "Solicitud de Inmueble";
		$mail->AltBody = "Cuerpo alternativo del mensaje";
		$mail->CharSet = 'UTF-8';
		$mail->MsgHTML($body);
		if(!$mail->Send()) {
			echo "Error al enviar el mensaje: " . $mail­>ErrorInfo;
		} 
		else {
			echo "2";
		}
	}
?>