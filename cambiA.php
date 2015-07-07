<?php
	include 'config.php';
	$idR=$_GET['di'];
	$codiR=$_GET['alg'];
	function rand_code($chars,$long)
	{
		$code="";
		for ($x=0; $x <=$long ; $x++) { 
			$rand=rand(1,strlen($chars));
			$code.=substr($chars, $rand,1);
		}
		return $code;
	}
	if ($idR=="" || $codiR=="") {
		$der=1;
	}
	else{
		$existe="SELECT * from usuarios where id_us=$idR and cod_reg_us='$codiR'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			$caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012456789";
			$longitud=20;
			$codigoal=rand_code($caracteres,$longitud);
			$sacar_corract="SELECT * from usuarios where id_us=$idR";
			$sql_corac=mysql_query($sacar_corract,$conexion) or die (mysql_error());
			while ($ss=mysql_fetch_array($sql_corac)) {
				$nomus=$ss['nom_ap_us'];
				$aas=$ss['cor_us'];
				$corrAct=$ss['corrfm_us'];
			}
			$modificar="UPDATE usuarios set cod_reg_us='$codigoal' where id_us=$idR";
			mysql_query($modificar,$conexion) or die (mysql_error());
			include 'miler/class.phpmailer.php';
			$mail=new PHPMailer();
			$body="<section style='max-width:1100px;'>
				<header>
					<figure>
						<img src='http://inmobiliariaprovase.com.co/imagenes/logo.png' alt='logo' />
					</figure>
					<h1>Cambio de correo</h1>
				</header>
				<section>
					<article>
						<p>
							Hola $nomus has confimrado el cambio del correo anterior $aas. 
							Para terminar el cambio click en cambiar correo.
						</p>
						<p>
							<a style='background: #002457;color: #fff;text-decoration: none;padding: 0.5em 0;' 
								href='http://inmobiliariaprovase.com.co/cambiB.php?alg=$codigoal&di=$idR' target='_blank'>
								Cambiar correo
							</a>
						</p>
					</article>
					<article>
						<a herf='http://inmobiliariaprovase.com.co/' target='_blank'>Página</a>
					</article>
				</section>
			</section>";
			$mail->SetFrom('no-reply@inmobiliariaprovase.com.co','Inmobiliaria Provase');
			$mail->From = "no-reply@inmobiliariaprovase.com.co";
			$mail->FromName = "Inmobiliaria Provase";
			$mail->AddReplyTo('no-reply@inmobiliariaprovase.com.co','Inmobiliaria Provase');
			$address="$corrAct";
			$mail->AddAddress($address, "$nomus");
			$mail->Subject = "Cambio de correo";
			$mail->AltBody = "Cuerpo alternativo del mensaje";
			$mail->CharSet = 'UTF-8';
			$mail->MsgHTML($body);
			if(!$mail->Send()) {
				echo "Error al enviar el mensaje: " . $mail­>ErrorInfo;
				$der=3;
			} 
			else {
				$der=2;
			}
		}
		else{
			$der=1;
		}
	}
	echo "<script type='text/javascript'>";
		echo "var pagina='corAcompl.php?es=$der';";
		echo "document.location.href=pagina;";
	echo "</script>";
?>