var expr=/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
$(document).on("ready",inicio_us_ibus);
function inicio_us_ibus () {
	$("#nvimb").on("click",validarserlects);
	$("#mnib").on("change",buscar_barrio);
	$("#dptfus").on("change",buscar_municipios);
	$("#nvimgimb").on("click",nueva_imagen);
	$("#camusA").on("click",modifdatA);
	$("#camusB").on("click",modifdatB);
	$("#camusC").on("click",modifdatC);
	$("#camusD").on("click",modifdatD);
	$(".dell").on("click",returconfrimar);
	$(".filimb select,.filimb input").on("change",buscar_filimnb);
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
function buscar_municipios () {
	var deldepart=$("#dptfus").val();
	$("#loaddepart").text("Buscando municipios..");
	$.post("buscar_munici.php",{dp:deldepart},colocarmunicipio);
}
function colocarmunicipio (munRc) {
	$("#loaddepart").text("");
	$("#mnfus").html(munRc);
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
function modifdatA () {
	var ida=$(this).attr("data-id");
	var dat=$("#nomfus").val();
	var dct=$("#tlfus").val();
	var ddt=$("#mvfus").val();
	var det=$("#dptfus").val();
	var dft=$("#mnfus").val();
	var dgt=$("#drfus").val();
	if (dat=="") {
		$("#txA").css(mal).text("Ingrese los nombres y apellidos");
	}
	else{
		if (ddt=="" || ddt.length!=10) {
			$("#txA").css(mal).text("Numero de celular es de 10 dígitos");
		}
		else{
			if (det=="0" || det=="") {
				$("#txA").css(mal).text("Selecione el departamento");
			}
			else{
				if (dft=="0" || dft=="") {
					$("#txA").css(mal).text("Selecione el municipio");
				}
				else{
					$("#txA").css(normal).text("");
					$("#txA").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
					$.post("cambausdat.php",{fad:ida,a:dat,c:dct,d:ddt,e:det,f:dft,g:dgt},resultcA);
				}
			}
		}
	}
}
function resultcA (resusa) {
	if (resusa=="2") {
		$("#txA").css(bien).text("Datos modificado");
		location.reload(20);
	}
	else{
		$("#txA").css(mal).html(resusa);
	}
}
function modifdatB () {
	var idb=$(this).attr("data-id");
	var corF=$("#corfus").val();
	if (corF=="" || !expr.test(corF)) {
		$("#txB").css(mal).text("Ingrese el correo");
	}
	else{
		$("#txB").css(normal).text("");
		$("#txB").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
		$.post("cambauscor.php",{fbd:idb,a:corF},resultcB);
	}
}
function resultcB (resusb) {
	if (resusb=="2") {
		$("#txB").css(mal).text("Correo ingresado ya está resgistrado");
	}
	else{
		if (resusb=="3") {
			$("#txB").css(bien).text("Solicitud realiza");
			alert("Se ha enviado un mensaje al correo para confirmar el cambio");
			location.reload(20);
		}
		else{
			$("#txB").css(mal).html(resusb);
		}
	}
}
function modifdatD () {
	var idd=$(this).attr("data-id");
	var ccF=$("#ccfus").val();
	if (ccF=="" || ccF.length<5) {
		$("#txD").css(mal).text("Cedula mínimo 5 digitos");
	}
	else{
		$("#txD").css(normal).text("");
		$("#txD").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
		$.post("cambauscc.php",{fdd:idd,a:ccF},resultcC);
	}
}
function resultcC (resusc) {
	if (resusc=="2") {
		$("#txD").css(mal).text("Cedula ingresado ya est´pa registrado");
	}
	else{
		if (resusc=="3") {
			$("#txD").css(bien).text("Cedula modificado");
			location.reload(20);
		}
		else{
			$("#txD").css(mal).html(resusc);
		}
	}
}
function modifdatC () {
	var idc=$(this).attr("data-id");
	var cac=$("#psact").val();
	var cna=$("#psnva").val();
	var cnb=$("#psnvb").val();
	if (cac=="") {
		$("#txC").css(mal).text("Ingrese la contraseña actual");
	}
	else{
		if (cna=="" || cna.length<6) {
			$("#txC").css(mal).text("Contraseña mínimo 6 dígitos");
		}
		else{
			if (cnb!=cna) {
				$("#txC").css(mal).text("Contraseñas no coinciden");
			}
			else{
				$("#txC").css(normal).text("");
				$("#txC").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
				$.post("cambauspass.php",{fcd:idc,a:cac,b:cna},resultcD);
			}
		}
	}
}
function resultcD (resusd) {
	if (resusd=="2") {
		$("#txC").css(mal).text("Contraseñas actual incorrecta");
	}
	else{
		if (resusd=="3") {
			$("#txC").css(bien).text("Contraseña cambiada");
			setTimeout(direcionus,1500);
		}
		else{
			$("#txC").css(mal).html(resusd);
		}
	}
}
function direcionus () {
	window.location.href="../cerrar/us.php";
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
	window.location.href="inmu2bles.php?ba="+bba+"&bb="+bbb+"&bc="+bbc+"&bd="+bbd+"&be="+bbe+"&bf="+bbf+"&bg="+bbg+"&bh="+bbh;
}