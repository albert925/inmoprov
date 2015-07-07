var expr=/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
$(document).on("ready",incio_solicitar);
function incio_solicitar () {
	$("#evsol").on("click",enviarsolicitud);
}
var mal={color:"#CD0000"};
var normal={color:"#000"};
var bien={color:"#002457"};
function enviarsolicitud () {
	var ib=$(this).attr("data-ib");
	var sla=$("#nmsol").val();
	var slb=$("#tlsol").val();
	var slc=$("#crsol").val();
	var sld=$("#txsol").val();
	if (sla=="") {
		$("#txsl").css(mal).text("ingrese el nombre");
		return false;
	}
	else{
		if (slb=="") {
			$("#txsl").css(mal).text("ingrese el teléfono");
			return false;
		}
		else{
			if (slc=="" || !expr.test(slc)) {
				$("#txsl").css(mal).text("ingrese el correo");
				return false;
			}
			else{
				if (sld=="") {
					$("#txsl").css(mal).text("ingrese el mensaje");
					return false;
				}
				else{
					$("#txsl").css(normal).text("");
					$("#txsl").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
					$.post("new_solcitud.php",{fid:ib,a:sla,b:slb,c:slc,d:sld},resulsolcitud);
					return false;
				}
			}
		}
	}
}
function resulsolcitud (dtsl) {
	if (dtsl=="2") {
		$("#txsl").css(bien).text("Solcitud enviada");
		location.reload(20);
	}
	else{
		$("#txsl").css(mal).html(dtsl);
		return false;
	}
}