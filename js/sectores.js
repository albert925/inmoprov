$(document).on("ready",inicio_municipio);
function inicio_municipio () {
	$("#nvmnp").on("click",nuevo_muni);
	$("#nvbarr").on("click",nuevo_barr);
	$(".mocamuni").on("click",modif_muni);
	$(".cammbar").on("click",modif_barr);
}
var mal={color:"#CD0000"};
var normal={color:"#000"};
var bien={color:"#002457"};
function nuevo_muni () {
	var nammuni=$("#nammn").val();
	if (nammuni=="") {
		$("#txA").css(mal).text("Ingrese el nombre municipio");
		return false;
	}
	else{
		$("#txA").css(normal).text("");
		$("#txA").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' /></center>");
		$.post("new_minicipio.php",{a:nammuni},resulmuniciA);
		return false;
	}
}
function resulmuniciA (mnRa) {
	if (mnRa=="2") {
		$("#txA").css(mal).text("Nombre ya existe");
		return false;
	}
	else{
		if (mnRa=="3") {
			$("#txA").css(bien).text("Municipio ingresado");
			location.reload(20);
		}
		else{
			$("#txA").css(mal).html(mnRa);
			return false;
		}
	}
}
function modif_muni () {
	var ida=$(this).attr("data-id");
	var nomFmn=$("#nmmf_"+ida).val();
	if (nomFmn=="") {
		$("#txB_"+ida).css(mal).text("Ingrese el nombre");
	}
	else{
		$("#txB_"+ida).css(normal).text("");
		$("#txB_"+ida).prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' /></center>");
		$.post("modfi_muni.php",{fa:ida,a:nomFmn},function (fmn) {
			if (fmn=="2") {
				$("#txB_"+ida).css(bien).text("Nombre modificado");
				location.reload(20);
			}
			else{
				$("#txB_"+ida).css(mal).html(fmn);
			}
		});
	}
}
function nuevo_barr () {
	var barmuni=$("#slmn").val();
	var nambarrio=$("#nambar").val();
	if (barmuni=="0" || barmuni=="") {
		$("#txC").css(mal).text("Selecione el municipio");
		return false;
	}
	else{
		if (nambarrio=="") {
			$("#txC").css(mal).text("Ingrese el nombre barrio");
			return false;
		}
		else{
			$("#txC").css(normal).text("");
			$("#txC").prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' /></center>");
			$.post("new_barrio.php",{a:barmuni,b:nambarrio},resulbarrioB);
			return false;
		}
	}
}
function resulbarrioB (barRb) {
	if (barRb=="2") {
		$("#txC").css(mal).text("El nombre ya existe");
		return false;
	}
	else{
		if (barRb=="3") {
			$("#txC").css(bien).text("Barrio ingresado");
			location.reload(20);
		}
		else{
			$("#txC").css(mal).html(barRb);
			return false;
		}
	}
}
function modif_barr () {
	var idb=$(this).attr("data-id");
	var selmunf=$("#delmnFf_"+idb).val();
	var nomfbar=$("#nmFbar_"+idb).val();
	if (selmunf=="0" || selmunf=="") {
		$("#txD_"+idb).css(mal).text("Selecione el municipio");
	}
	else{
		if (nomfbar=="") {
			$("#txD_"+idb).css(mal).text("Ingrese el nombre");
		}
		else{
			$("#txD_"+idb).css(normal).text("");
			$("#txD_"+idb).prepend("<center><img src='../../../imagenes/loadingb.gif' alt='loading' /></center>");
			$.post("modif_barrio.php",{fb:idb,a:selmunf,b:nomfbar},function (rbarbb) {
				if (rbarbb=="2") {
					$("#txD_"+idb).css(bien).text("Datos modificado");
					location.reload(20);
				}
				else{
					$("#txD_"+idb).css(mal).html(rbarbb);
				}
			});
		}
	}
}