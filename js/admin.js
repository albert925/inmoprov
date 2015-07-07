$(document).on("ready",inicio_admini);
function inicio_admini () {
	$("#ingad").on("click",ingradm);
	$("#cambA").on("click",cambioA);
	$("#cambB").on("click",cambioB);
}
var mal={color:"#CD0000"};
var normal={color:"#000"};
var bien={color:"#002457"};
function ingradm () {
	var adus=$("#usad").val();
	var adps=$("#psad").val();
	if (adus=="") {
		$("#txA").css(mal).text("Ingrese el nombre de usuario");
		return false;
	}
	else{
		if (adps=="") {
			$("#txA").css(mal).text("Ingrese la contraseña");
			return false;
		}
		else{
			$("#txA").css(normal).text("");
			$("#txA").prepend("<center><img src='../imagenes/loadingb.gif' alt='loading' /></center>");
			$.post("ingr_adm.php",{a:adus,b:adps},resulingadmin);
			return false;
		}
	}
}
function resulingadmin (sjad) {
	if (sjad=="2") {
		$("#txA").css(mal).text("Usuario o contraseña incorrectos");
		return false;
	}
	else{
		if (sjad=="3") {
			$("#txA").css(bien).text("Ingresando..");
			window.location.href="administrador";
		}
		else{
			$("#txA").css(mal).html(sjad)
			return false;
		}
	}
}
function cambioA () {
	var ida=$(this).attr("data-adm");
	var usFc=$("#usfad").val();
	if (usFc=="") {
		$("#txB").css(mal).text("Ingrese el nombre de usuario");
	}
	else{
		$("#txB").css(normal).text("");
		$("#txB").prepend("<center><img src='../../imagenes/loadingb.gif' alt='loading' /></center>");
		$.post("modif_usadm.php",{fa:ida,a:usFc},resulkA);
	}
}
function resulkA (Cca) {
	if (Cca=="2") {
		$("#txB").css(mal).text("Nombre de usuario ya existe");
	}
	else{
		if (Cca=="3") {
			$("#txB").css(bien).text("Nombre usuario modificado");
			location.reload(20);
		}
		else{
			$("#txB").css(mal).html(Cca);
		}
	}
}
function cambioB () {
	var idb=$(this).attr("data-adm");
	var ca=$("#pasac").val();
	var cna=$("#pasna").val();
	var cnb=$("#pasnb").val();
	if (ca=="") {
		$("#txC").css(mal).text("Ingrese la contraseña actual");
	}
	else{
		if (cna=="" || cna.length<6) {
			$("#txC").css(mal).text("Contraseña mínmo 6 dígitos");
		}
		else{
			if (cnb!=cna) {
				$("#txC").css(mal).text("Contraseñas no coinciden");
			}
			else{
				$("#txC").css(normal).text("");
				$("#txC").prepend("<center><img src='../../imagenes/loadingb.gif' alt='loading' /></center>");
				$.post("modic_passadm.php",{fb:idb,b:ca,c:cna},resulkB);
			}
		}
	}
}
function resulkB (Ccb) {
	if (Ccb=="2") {
		$("#txC").css(mal).text("Contraseña actual incorrecta");
	}
	else{
		if (Ccb=="3") {
			$("#txC").css(bien).text("Contraseña modificado");
			setTimeout(direccionar,1500);
		}
		else{
			$("#txC").css(mal).html(Ccb);
		}
	}
}
function direccionar () {
	window.location.href="../../cerrar";
}