var expr=/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
$(document).on("ready",inicio_registro);
function inicio_registro () {
	$("#btreg").on("click",registrousuario);
	$("#nvimb").on("click",validarserlects);
	$("#mnib").on("change",buscar_barrio);
	$("#nvimgimb").on("click",nueva_imagen);
	$("#termprc").on("click",terminar_pasos)
	$("#inus").on("click",ingreso_usuario);
	$(".dell").on("click",returconfrimar);
}
var mal={color:"#CD0000"};
var normal={color:"#000"};
var bien={color:"#002457"};
function es_imagen (tipederf) {
	switch(tipederf.toLowerCase()){
		case 'jpg':
			return true;
			break;
		case 'gif':
			return true;
			break;
		case 'png':
			return true;
			break;
		case 'jpeg':
			return true;
			break;
		default:
			return false;
			break;
	}
}
function returconfrimar () {
	return confirm("estas seguro de eliminarlo?");
}
function registrousuario (argument) {
	var psua=$("#rgnm").val();
	var psub=$("#rgap").val();
	var psuc=$("#rgcr").val();
	var psud=$("#rgmv").val();
	if (psua=="") {
		$("#txA").css(mal).text("Ingrese el nombre");
	}
	else{
		if (psub=="") {
			$("#txA").css(mal).text("Ingrese el apellido");
		}
		else{
			if (psuc=="" || !expr.test(psuc)) {
				$("#txA").css(mal).text("Ingrese el correo");
			}
			else{
				if (psud=="" || psud.length!=10) {
					$("#txA").css(mal).text("Ingrese el número celular");
				}
				else{
					$("#txA").css(normal).text("");
					$("#txA").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
					$.post("reg_users.php",{a:psua,b:psub,c:psuc,d:psud},resulregistro);
				}
			}
		}
	}
}
function resulregistro (sksj) {
	var separador=sksj.split("|");
	var errordt=separador[0];
	var idusdt=separador[1];
	if (errordt=="2") {
		$("#txA").css(mal).text("Correo ingresado ya está registrado");
	}
	else{
		if (errordt=="3") {
			$("#txA").css(bien).text("Paso 1 completado");
			window.location.href="ind2x.php?us="+idusdt;
		}
		else{
			$("#txA").css(mal).html(sksj);
		}
	}
}
function validarserlects () {
	var sla=$("#prus").val();
	var slb=$("#tpib").val();
	var slc=$("#mnib").val();
	var sld=$("#barib").val();
	var sle=$("#esdib").val();
	if (sla=="0" || sla=="") {
		alert("Selecioene el usuario");
		return false;
	}
	else{
		if (slb=="0" || slb=="") {
			alert("Selecione tipo de inmueble");
			return false;
		}
		else{
			if (slc=="0" || slc=="") {
				alert("Selecione el municipio");
				return false;
			}
			else{
				if (sld=="0" || sld=="") {
					alert("Selecione el barrio");
					return false;
				}
				else{
					if (sle=="0" || sle=="") {
						alert("Selecione el estado");
						return false;
					}
					else{
						return true;
					}
				}
			}
		}
	}
}
function buscar_barrio () {
	var delmunibs=$("#mnib").val();
	$("#loadbarr").text("Buscando barrios..");
	$.post("buscar_barrio.php",{mn:delmunibs},colocarbarrio);
}
function colocarbarrio (barRc) {
	$("#loadbarr").text("");
	$("#barib").html(barRc);
}
function nueva_imagen () {
	var idcjats=$("#idib").val();
	var gmigts=$("#imgib")[0].files[0];
	var namegmigts=gmigts.name;
	var extegmigts=namegmigts.substring(namegmigts.lastIndexOf('.')+1);
	var tamgmigts=gmigts.size;
	var tipogmigts=gmigts.type;
	if (idcjats=="0" || idcjats=="") {
		$("#txgib").css(mal).text("Id de inmueble no disponible");
		return false;
	}
	else{
		if (!es_imagen(extegmigts)) {
			$("#txgib").css(mal).text("Tipo de imagen no permitido");
			return false;
		}
		else{
			$("#txgib").css(normal).text("");
			var formu=new FormData($("#nvG_imb")[0]);
			$.ajax({
				url: '../nuevoimginmueble.php',
				type: 'POST',
				data: formu,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend:function () {
					$("#txgib").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
				},
				success:function (dtst) {
					if (dtst=="2") {
						$("#txgib").css(mal).text("Carpeta sin permisos o resolución de imagen no permitido");
						$("#txgib").fadeIn();$("#txgib").fadeOut(3000);
						return false;
					}
					else{
						if (dtst=="3") {
							$("#txgib").css(mal).text("Tamaño no permitido");
							$("#txgib").fadeIn();$("#txgib").fadeOut(3000);
							return false;
						}
						else{
							if (dtst=="4") {
								$("#txgib").css(mal).text("Carpeta sin permisos o resolución de imagen no permitido");
								$("#txgib").fadeIn();$("#txgib").fadeOut(3000);
								return false;
							}
							else{
								if (dtst=="5") {
									$("#txgib").css(bien).text("Imagen subida");
									$("#txgib").fadeIn();$("#txgib").fadeOut(3000);
									location.reload(20);
								}
								else{
									$("#txgib").css(mal).html(dtst);
									$("#txgib").fadeIn();
									return false;
								}
							}
						}
					}
				},
				error:function () {
					$("#txgib").css(mal).text("Ocurrió un error");
					$("#txgib").fadeIn();$("#txgib").fadeOut(3000);
				}
			});
			return false;
		}
	}
}
function terminar_pasos () {
	window.location.href="terminado.php";
}
function ingreso_usuario () {
	var ina=$("#coring").val();
	var inb=$("#passing").val();
	if (ina=="") {
		$("#msjig").css(mal).text("Ingrese el correo");
		return false;
	}
	else{
		if (inb=="") {
			$("#msjig").css(mal).text("Ingrese la contraseña");
			return false;
		}
		else{
			$("#msjig").css(normal).text("Loading..");
			$.post("ingre_users.php",{a:ina,b:inb},resulingresous);
			return false;
		}
	}
}
function resulingresous (dtus) {
	if (dtus=="2") {
		$("#msjig").css(mal).text("Correo o contraseña incorrectos");
		return false;
	}
	else{
		if (dtus=="3") {
			$("#msjig").css(mal).text("Cuenta desactivada");
			return false;
		}
		else{
			if (dtus=="4") {
				$("#msjig").css(bien).text("Ingresando..");
				window.location.href="../";
			}
			else{
				$("#msjig").css(mal).html(dtus)
				return false;
			}
		}
	}
}