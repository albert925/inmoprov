<?php
	include '../config.php';
	$a=$_POST['a'];//nombres
	$b=$_POST['b'];//apellidos
	$c=$_POST['c'];//correo
	$d=$_POST['d'];//telefono
	$nombreComp=$a." ".$b;
	$hoy=date("Y-m-d");
	function rand_code($chars,$long)
	{
		$code="";
		for ($x=0; $x <=$long ; $x++) { 
			$rand=rand(1,strlen($chars));
			$code.=substr($chars, $rand,1);
		}
		return $code;
	}
	if ($a=="" || $b=="" || $c=="") {
		echo "1";
	}
	else{
		$existe="SELECT * from usuarios where cor_us='$c'";
		$sql_existe=mysql_query($existe,$conexion) or die (mysql_error());
		$numero=mysql_num_rows($sql_existe);
		if ($numero>0) {
			echo "2|0";
		}
		else{
			$caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012456789";
			$longitud=20;
			$longib=8;
			$codigoal=rand_code($caracteres,$longitud);
			$e=rand_code($caracteres,$longib);
			$ingresar="INSERT into usuarios(nom_ap_us,cor_us,mov_us,pass_us,tp_us,estd_us,cod_reg_us,fecr_us) 
				values('$nombreComp','$c','$d','$e','1','2','$codigoal','$hoy')";
			mysql_query($ingresar,$conexion) or die (mysql_error());
			$tomar_id="SELECT id_us from usuarios where cor_us='$c'";
			$sql_tomar=mysql_query($tomar_id,$conexion) or die (mysql_error());
			while ($fg=mysql_fetch_array($sql_tomar)) {
				$idus=$fg['id_us'];
			}
			include '../miler/class.phpmailer.php';
			$mail=new PHPMailer();
			$body="<section style='max-width:1100px;'>
				<header>
					<figure>
						<img src='http://inmobiliariaprovase.com.co/imagenes/logo.png' alt='logo' />
					</figure>
					<h1>Registro</h1>
				</header>
				<section>
					<article>
						<p>
							Hola $a $b te has registrado en la página de Inmobiliaria Provase poder 
							ingresar click en el siguiente link para activar tu cuenta y publicar mas inmuebles.
						</p>
						<p>
							Estos son su datos de acceso
						</p>
						<p>
							<b>Nombre y apellidos:</b> $a $b<br />
							<b>Correo:</b> $c<br />
							<b>Contraseña:</b> $e
						</p>
						<p>
							Link de activación: 
							<a style='background: #002457;color: #fff;text-decoration: none;padding: 0.5em 0;' 
								href='http://inmobiliariaprovase.com.co/activacion.php?alg=$codigoal&di=$idus' target='_blank'>
								Terminar Registro
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
			$address="$c";
			$mail->AddAddress($address, "$a $b");
			$mail->Subject = "Registro";
			$mail->AltBody = "Cuerpo alternativo del mensaje";
			$mail->CharSet = 'UTF-8';
			$mail->MsgHTML($body);
			if(!$mail->Send()) {
				echo "Error al enviar el mensaje: " . $mail­>ErrorInfo;
			} 
			else {
				echo "3"."|".$idus;
			}
		}
	}
?>