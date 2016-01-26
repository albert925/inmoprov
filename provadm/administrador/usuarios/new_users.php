<?php
	include '../../../config.php';
	$a=segcon($conexion,$_POST['a']);//nombres apellidos
	$b=segcon($conexion,$_POST['b']);//cedula
	$c=segcon($conexion,$_POST['c']);//correo
	$d=segcon($conexion,$_POST['d']);//telefono
	$e=segcon($conexion,$_POST['e']);//celular
	$f=$_POST['f'];//direccion
	$g=segcon($conexion,$_POST['g']);//mas numeros
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
	if ($a=="") {
		echo "1";
	}
	else{
		if ($c=="") {
			if ($b=="") {
				$ingresar="INSERT into usuarios(nom_ap_us,tel_us,mov_us,direc_us,estd_us,fecr_us,teltwo) 
					values('$a','$d','$e','$f','1','$hoy','$g')";
				$conexion->query($ingresar) or die (mysqli_error());
				echo "3";
			}
			else{
				$ccextis="SELECT * from usuarios where cc_us='$b'";
				$sqlccex=$conexion->query($ccextis) or die (mysqli_error());
				$numcc=$sqlccex->num_rows;
				if ($numcc>0) {
					echo "2";
				}
				else{
					$ingresar="INSERT into usuarios(cc_us,nom_ap_us,tel_us,mov_us,direc_us,estd_us,fecr_us,teltwo) 
						values('$b','$a','$d','$e','$f','1','$hoy','$g')";
					$conexion->query($ingresar) or die (mysqli_error());
					echo "3";
				}
			}
		}
		else{
			$exis_corre="SELECT * from usuarios where cor_us='$c'";
			$sql_excor=$conexion->query($exis_corre) or die (mysqli_error());
			$numcorreo=$sql_excor->num_rows;
			if ($numcorreo>0) {
				echo "4";
			}
			else{
				if ($b=="") {
					$caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012456789";
					$longitud=8;
					$codigoal=rand_code($caracteres,$longitud);
					$ingresar="INSERT into usuarios(nom_ap_us,cor_us,tel_us,mov_us,direc_us,estd_us,pass_us,fecr_us,teltwo) 
						values('$a','$c','$d','$e','$f','1','$codigoal','$hoy','$g')";
					$conexion->query($ingresar) or die (mysqli_error());
					include '../../../miler/class.phpmailer.php';
					$mail=new PHPMailer();
					$body="<section style='max-width:1100px;'>
						<header>
							<figure>
								<img src=http://inmobiliariaprovase.com.co/imagenes/logo.png' alt='logo' />
							</figure>
							<h1>Registro</h1>
						</header>
						<section>
							<article>
								<p>
									Hola $a el administrador de la página inmobiliaria probase ha creado una cuenta. 
									Para ingresar son lso siguientes datos:
								</p>
								<p>
									<b>Correo:</b> $c<br />
									<b>Contraseña:</b> $codigoal
								</p>
							</article>
							<article>
								<a herf='http://inmobiliariaprovase.com.co/' target='_blank'>Página</a>
							</article>
						</section>
					</section>";
					$mail->SetFrom('no-reply@inmobiliariaprovase.com.co','Inmboliaria Provase');
					$mail->From = "no-reply@inmobiliariaprovase.com.co";
					$mail->FromName = "Inmboliaria Provase";
					$mail->AddReplyTo('no-reply@inmobiliariaprovase.com.co','Inmboliaria Provase');
					$address="$c";
					$mail->AddAddress($address, "$a");
					$mail->Subject = "Registro";
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
				else{
					$ccextis="SELECT * from usuarios where cc_us='$b'";
					$sqlccex=$conexion->query($ccextis) or die (mysqli_error());
					$numcc=$sqlccex->num_rows;
					if ($numcc>0) {
						echo "2";
					}
					else{
						$caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012456789";
						$longitud=8;
						$codigoal=rand_code($caracteres,$longitud);
						$ingresar="INSERT into usuarios(cc_us,nom_ap_us,cor_us,tel_us,mov_us,direc_us,estd_us,pass_us,fecr_us,teltwo) 
							values('$b','$a','$c','$d','$e','$f','1','$codigoal','$hoy','$g')";
						$conexion->query($ingresar) or die (mysqli_error());
						include '../../../miler/class.phpmailer.php';
						$mail=new PHPMailer();
						$body="<section style='max-width:1100px;'>
							<header>
								<figure>
									<img src=http://inmobiliariaprovase.com.co/imagenes/logo.png' alt='logo' />
								</figure>
								<h1>Registro</h1>
							</header>
							<section>
								<article>
									<p>
										Hola $a el administrador de la página inmobiliaria probase ha creado una cuenta. 
										Para ingresar son lso siguientes datos:
									</p>
									<p>
										<b>Correo:</b> $c<br />
										<b>Contraseña:</b> $codigoal
									</p>
								</article>
								<article>
									<a herf='http://inmobiliariaprovase.com.co/' target='_blank'>Página</a>
								</article>
							</section>
						</section>";
						$mail->SetFrom('no-reply@inmobiliariaprovase.com.co','Inmboliaria Provase');
						$mail->From = "no-reply@inmobiliariaprovase.com.co";
						$mail->FromName = "Inmboliaria Provase";
						$mail->AddReplyTo('no-reply@inmobiliariaprovase.com.co','Inmboliaria Provase');
						$address="$c";
						$mail->AddAddress($address, "$a");
						$mail->Subject = "Registro";
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
			}
		}
	}
?>