$(document).on("ready",incio_inmuebles);
function incio_inmuebles () {
	$("#nvtpsimb").on("click",nuevo_tipo);
	$("#mnib").on("change",buscar_barrio);
	$("#bsC").on("change",buscar_arriodos);
	$("#nvimb").on("click",validarserlects);
	$("#nvimgimb").on("click",nueva_imagen);
	$(".moftipo").on("click",modif_tipo);
	$(".filimb select,.filimb input").on("change",buscar_filimnb);
	$(".cambestdibG").on("change",cambiarestimb);
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
function nuevo_tipo () {
	var nomtp=$("#nwmtp").val();
	if (nomtp=="") {
		$("#txA").css(mal).text("Ingrese el nombre del tipo");
		return false;
	}
	else{
		$("#txA").css(normal).text("");
		$("#txA").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' /></center>");
		$.post("new_tipo.php",{a:nomtp},resultipo);
		return false;
	}
}
function resultipo (dtpd) {
	if (dtpd=="2") {
		$("#txA").css(mal).text("Nombre ya existe");
		return false;
	}
	else{
		if (dtpd=="3") {
			$("#txA").css(bien).text("Nuevo tipo ingresado");
			location.reload(20);
		}
		else{
			$("#txA").css(mal).html(dtpd);
			return false;
		}
	}
}
function modif_tipo () {
	var ida=$(this).attr("data-id");
	var nmftp=$("#nmmf_"+ida).val();
	if (nmftp=="") {
		$("#txB_"+ida).css(mal).text("Ingrese el nombre");
	}
	else{
		$("#txB_"+ida).css(normal).text("");
		$("#txB_"+ida).prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' /></center>");
		$.post("modifc_tipos.php",{had:ida,a:nmftp},function (rstp) {
			if (rstp=="2") {
				$("#txB_"+ida).css(bien).text("Datos modificado");
				location.reload(20);
			}
			else{
				$("#txB_"+ida).css(mal).html(rstp);
			}
		});
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
				url: '../../../nuevoimginmueble.php',
				type: 'POST',
				data: formu,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend:function () {
					$("#txgib").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
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
									window.location.href="inmueble_images.php?ib="+idcjats;
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
function buscar_arriodos () {
	var delmunibs=$("#bsC").val();
	$.post("buscar_barrio.php",{mn:delmunibs},colocarbarriodos);
}
function colocarbarriodos (barbbC) {
	$("#bsD").html(barbbC);
}
function buscar_filimnb () {
	var bba=$("#bsA").val();
	var bbb=$("#bsB").val();
	var bbc=$("#bsC").val();
	var bbd=$("#bsD").val();
	var bbe=$("#bsE").val();
	var bbf=$("#bsF").val();
	var bbg=$("#bsG").val();
	var bbh=$("#bsH").val();
	window.location.href="ind2x.php?ba="+bba+"&bb="+bbb+"&bc="+bbc+"&bd="+bbd+"&be="+bbe+"&bf="+bbf+"&bg="+bbg+"&bh="+bbh;
}
function cambiarestimb () {
	var idb=$(this).attr("data-id");
	var delselesd=$("#esG_"+idb).val();
	if (delselesd=="0" || delselesd=="") {
		alert("Selecione el estado");
	}
	else{
		$.post("modif_estadimb.php",{fbd:idb,a:delselesd},resulestado);
	}
}
function resulestado (ilseles) {
	if (ilseles=="2") {
		alert("Estado modificado");
		location.reload(20);
	}
	else{
		alert(ilseles);
	}
}