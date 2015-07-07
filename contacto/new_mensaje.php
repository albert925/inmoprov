<?php
	$a=$_POST['a'];//nombre
	$b=$_POST['b'];//correo
	$c=$_POST['c'];//telefono
	$d=$_POST['d'];//mensaje
	if ($a=="" || $b=="" || $d=="") {
		echo "1";
	}
	else{
		include '../miler/class.phpmailer.php';
		$mail=new PHPMailer();
		$body="<section style='max-width:1100px;'>
			<header>
				<figure>
					<img src='http://inmobiliariaprovase.com.co/imagenes/logo.png' alt='logo' />
				</figure>
				<h1>Contacto $a</h1>
			</header>
			<section>
				<article>
					<p>
						<b>Nombre:</b> $a<br />
						<b>Correo:</b> $b<br />
						<b>Teléfono:</b> $c<br />
						<b>Mensaje:</b>
					</p>
					<p>
						$d
					</p>
				</article>
				<article>
					<a herf='http://inmobiliariaprovase.com.co/' target='_blank'>Página</a>
				</article>
			</section>
		</section>";
		$mail->SetFrom('$b','$a');
		$mail->From = "$b";
		$mail->FromName = "$a";
		$mail->AddReplyTo('$b','$a');
		$address="Info@inmobiliariaprovase.com.co";
		$mail->AddAddress($address, "Inmobiliaria Provase");
		$mail->AddAddress("albertarias925@gmail.com", "albert arias");
		$mail->Subject = "Contacto";
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