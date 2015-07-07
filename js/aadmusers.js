$(document).on("ready",inicioadminusers);
function inicioadminusers () {
	$("#nvus").on("click",nuevo_usuario);
	$("#busE").keydown(buscarnombresusers);
	$("#busE").keyup(buscarnombresusers);
	$("#nvconus").on("click",nuevo_contacto);
	$(".fila select").on("change",busquedafiltr);
	$(".genestd").on("change",cambiarestaus);
	$(".mofcoont").on("click",modifcocntactos);
}
var mal={color:"#CD0000"};
var normal={color:"#000"};
var bien={color:"#002457"};
function nuevo_usuario () {
	var usa=$("#namus").val();
	var usb=$("#cecus").val();
	var usc=$("#corus").val();
	var usd=$("#telus").val();
	var use=$("#movus").val();
	var usf=$("#dirus").val();
	if (usa=="") {
		$("#txA").css(mal).text("Ingrese los nombres y apellidos");
		return false;
	}
	else{
		$("#txA").css(normal).text("");
		$("#txA").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' /></center>");
		$.post("new_users.php",{a:usa,b:usb,c:usc,d:usd,e:use,f:usf},resulusers);
		return false;
	}
}
function resulusers (kus) {
	if (kus=="2") {
		$("#txA").css(mal).text("Cédula ingresada ya está registrado");
			return false;
	}
	else{
		if (kus=="3") {
			$("#txA").css(bien).text("Usuario ingresado");
			location.reload(20)
		}
		else{
			if (kus=="4") {
				$("#txA").css(mal).text("Correo ingresado ya existe");
				return false;
			}
			else{
				$("#txA").css(mal).html(kus);
				return false;
			}
		}
	}
}
function busquedafiltr () {
	var bbb=$("#busB").val();
	var bcc=$("#busC").val();
	var bdd=$("#busD").val();
	window.location.href="ind2x.php?bb="+bbb+"&bc="+bcc+"&bd="+bdd;
}
function buscarnombresusers () {
	var nmus=$("#busE").val();
	$("#cargadorus center").remove();
	$("#cargadorus").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' style='width:20px;' /></center>");
	$.post("bucplab_users.php",{pa:nmus},resulcolnombres);
}
function resulcolnombres (xsx) {
	$("#cargadorus center").remove();
	if (xsx=="" || $("#busE").val()=="") {
		$("#resulNombres").css({display:"none"});
	}
	else{
		$("#resulNombres").css({display:"flex"}).html(xsx);
	}
}
function cambiarestaus () {
	var idb=$(this).attr("data-id");
	var deselbb=$("#acdest_"+idb).val();
	if (deselbb=="0" || deselbb=="") {
		alert("Selecione el estado");
	}
	else{
		$.post("cambiar_estadousers.php",{fb:idb,es:deselbb},resulestado);
	}
}
function resulestado (usess) {
	if (usess=="2") {
		alert("Estado cambiado");
		location.reload(20);
	}
	else{
		alert(usess);
	}
}
function nuevo_contacto () {
	var delidus=$("#idus").val();
	var namctus=$("#namcont").val();
	var numctus=$("#telcelcont").val();
	if (delidus=="0" || delidus=="") {
		$("#txUS").css(mal).text("Id de usuario no disdponible");
		return false;
	}
	else{
		if (namctus=="") {
			$("#txUS").css(mal).text("Ingrese el nombre de contacto");
			return false;
		}
		else{
			if (numctus=="") {
				$("#txUS").css(mal).text("Ingrese numero de teléfono");
				return false;
			}
			else{
				$("#txUS").css(normal).text("");
				$("#txUS").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' /></center>");
				$.post("new_contactous.php",{fid:delidus,a:namctus,b:numctus},function (rsctus) {
					if (rsctus=="2") {
						$("#txUS").css(bien).text("Contacto ingresado");
						window.location.href="users_contacto.php?us="+delidus;
					}
					else{
						$("#txUS").css(mal).html(rsctus);
						return false;
					}
				});
				return false;
			}
		}
	}
}
function modifcocntactos () {
	var idc=$(this).attr("data-id");
	var nomf=$("#nfnmct_"+idc).val();
	var numf=$("#numfnumct_"+idc).val();
	if (nomf=="") {
		$("#txE_"+idc).css(mal).text("Ingrese el nombre");
	}
	else{
		if (numf=="") {
			$("#txE_"+idc).css(mal).text("Ingrese el numero");
		}
		else{
			$("#txE_"+idc).css(normal).text("");
			$("#txE_"+idc).prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' /></center>");
			$.post("modif_contactos.php",{fcd:idc,a:nomf,b:numf},function (rdtct) {
				if (rdtct=="2") {
					$("#txE_"+idc).css(bien).text("Datos modificado");
					location.reload(20);
				}
				else{
					$("#txE_"+idc).css(mal).html(rdtct);
				}
			});
		}
	}
}