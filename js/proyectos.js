$(document).on("ready",inicio_proyectos);
function inicio_proyectos () {
	$("#nvimgpy").on("click",nuevoimgpy);
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
function nuevoimgpy (argument) {
	var idpyR=$("#idpy").val();
	var imgyR=$("#imgpy")[0].files[0];
	var nameimgyR=imgyR.name;
	var exteimgyR=nameimgyR.substring(nameimgyR.lastIndexOf('.')+1);
	var tamimgyR=imgyR.size;
	var tipoimgyR=imgyR.type;
	if (idpyR=="0" || idpyR=="") {
		$("#mspy").css(mal).text("Id de proyecto no disponible");
		return false;
	}
	else{
		if (!es_imagen(exteimgyR)) {
			$("#mspy").css(mal).text("tipo de imagen no permitido");
			return false;
		}
		else{
			$("#mspy").css(normal).text("");
			var formu=new FormData($("#nvG_impy")[0]);
			$.ajax({
				url: '../../../nuevoimgproyecto.php',
				type: 'POST',
				data: formu,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend:function () {
					$("#mspy").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
				},
				success:function (dtst) {
					if (dtst=="2") {
						$("#mspy").css(mal).text("Carpeta sin permisos o resolución de imagen no permitido");
						$("#mspy").fadeIn();$("#mspy").fadeOut(3000);
						return false;
					}
					else{
						if (dtst=="3") {
							$("#mspy").css(mal).text("Tamaño no permitido");
							$("#mspy").fadeIn();$("#mspy").fadeOut(3000);
							return false;
						}
						else{
							if (dtst=="4") {
								$("#mspy").css(mal).text("Carpeta sin permisos o resolución de imagen no permitido");
								$("#mspy").fadeIn();$("#mspy").fadeOut(3000);
								return false;
							}
							else{
								if (dtst=="5") {
									$("#mspy").css(bien).text("Imagen subida");
									$("#mspy").fadeIn();$("#mspy").fadeOut(3000);
									window.location.href="proyecto_images.php?py="+idpyR;
								}
								else{
									$("#mspy").css(mal).html(dtst);
									$("#mspy").fadeIn();
									return false;
								}
							}
						}
					}
				},
				error:function () {
					$("#mspy").css(mal).text("Ocurrió un error");
					$("#mspy").fadeIn();$("#mspy").fadeOut(3000);
				}
			});
			return false;
		}
	}
}