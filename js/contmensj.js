var expr=/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
$(document).on("ready",inicio_mensajes);
function inicio_mensajes () {
	$("#nvmsjs").on("click",nuevo_mensaje_cont);
}
var mal={color:"#CD0000"};
var normal={color:"#000"};
var bien={color:"#002457"};
function nuevo_mensaje_cont () {
	var ua=$("#sjnm").val();
	var ub=$("#sjcr").val();
	var uc=$("#sjtl").val();
	var ud=$("#sjtx").val();
	if (ua=="") {
		$("#txsj").css(mal).text("ingrese el nombre");
		return false;
	}
	else{
		if (ub=="" || !expr.test(ub)) {
			$("#txsj").css(mal).text("ingrese el correo");
			return false;
		}
		else{
			if (ud=="") {
				$("#txsj").css(mal).text("ingrese el mensaje");
				return false;
			}
			else{
				$("#txsj").css(normal).text("");
				$("#txsj").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
				$.post("new_mensaje.php",{a:ua,b:ub,c:uc,d:ud},resulmensaje);
				return false;
			}
		}
	}
}
function resulmensaje (resmsms) {
	if (resmsms=="2") {
		$("#txsj").css(bien).text("Mensaje Enviado");
		location.reload(20);
	}
	else{
		$("#txsj").css(mal).html(resmsms);
		return false;
	}
}