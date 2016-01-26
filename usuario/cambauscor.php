<?php
	include '../config.php';
	$idR=$_POST['fbd'];
	$a=$_POST['a'];
	function rand_code($chars,$long)
	{
		$code="";
		for ($x=0; $x <=$long ; $x++) { 
			$rand=rand(1,strlen($chars));
			$code.=substr($chars, $rand,1);
		}
		return $code;
	}
	if ($idR=="" || $a=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from usuarios where cor_us='$a'";
		$sql_existe=$conexion->query($existe) or die (mysqli_error());
		$numero=$sql_existe->num_rows;
		if ($numero>0) {
			echo "2";
		}
		else{
			$caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012456789";
			$longitud=20;
			$codigoal=rand_code($caracteres,$longitud);
			$sacar_corract="SELECT * from usuarios where id_us=$idR";
			$sql_corac=$conexion->query($sacar_corract) or die (mysqli_error());
			while ($ss=$sql_corac->fetch_assoc()) {
				$nomus=$ss['nom_ap_us'];
				$corrAct=$ss['cor_us'];
			}
			$modificar="UPDATE usuarios set cod_reg_us='$codigoal',corrfm_us='$a' where id_us=$idR";
			$conexion->query($modificar) or die (mysqli_error());
			include '../miler/class.phpmailer.php';
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
							Hola $nomus has solicitado un cambio del siguiente correo $a. 
							Si has solicitado el cambio click en cmabiar correo para hacer el cambio.
						</p>
						<p>
							<a style='background: #002457;color: #fff;text-decoration: none;padding: 0.5em 0;' 
								href='http://inmobiliariaprovase.com.co/cambiA.php?alg=$codigoal&di=$idR' target='_blank'>
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
			} 
			else {
				echo "3";
			}
		}
	}
?>