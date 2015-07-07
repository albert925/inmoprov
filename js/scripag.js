$(document).on("ready",inicio_pagina);
var contador=1;
function inicio_pagina () {
	$("#boton_mov").on("click",abrirmenu);
	$("#busGA").on("change",busGbarrios);
	$("#clbusmb").on("click",busquedaGeneral);
	$(".submen").on("click",abrirsubmenu);
	$(".destacad div").on("click",colocarpunto);
}
function abrirmenu () {
	if (contador==1) {
		$("#mnP").animate({left:"0"}, 500);
		contador=0;
	}
	else{
		$("#mnP").animate({left:"-100%"}, 500);
		contador=1;
	}
}
function abrirsubmenu () {
	var numerothis=$(this).attr("data-num");
	$(".children"+numerothis).slideToggle();
}
function busGbarrios () {
	var delmunibs=$("#busGA").val();
	$("#loadGg").text("Buscando barrios..");
	$.post("buscar_barrio.php",{mn:delmunibs},colocarbarGg);
}
function colocarbarGg (br) {
	$("#loadGg").text("");
	$("#busGB").html(br);
}
function busquedaGeneral (uy) {
	uy.preventDefault();
	var tipoB=$(this).attr("data-tp");
	if (tipoB=="1") {
		var ruta="servicios/";
	}
	else{
		if (tipoB=="2") {
			var ruta="../servicios/";
		}
		else{
			var ruta="../../../servicios/";
		}
	}
	var ja=0;
	var jb=$("#busGA").val();
	var jc=$("#busGB").val();
	var jd=$("#busGC").val();
	var je=$("#busGD").val();
	var jf=$("#busGE").val();
	window.location.href=ruta+"ind2x.php?a="+ja+"&b="+jb+"&c="+jc+"&d="+jd+"&e="+je+"&f="+jf;
}
function colocarpunto () {
	var fory=$(this).attr("data-dest");
	var imbfory=$(this).attr("data-imb");
	var actualfor=$(this).attr("data-actual");
	$.post("destacar.php",{xa:fory,xb:imbfory,xc:actualfor},setmesdestacados);
}
function setmesdestacados (carty) {
	if (carty=="2") {
		location.reload(20);
	}
	else{
		alert(carty);
	}
}