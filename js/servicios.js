$(document).on("ready",inicio_servicios);
function inicio_servicios () {
	$("#bsB").on("change",buscar_barrioAA);
	$(".filserv select").on("change",buscfiltros);
}
function buscar_barrioAA () {
	var delmunibs=$("#bsB").val();
	$("#loadbarr").text("Buscando barrios..");
	$.post("buscar_barrio.php",{mn:delmunibs},colocarbarAA);
}
function colocarbarAA (br) {
	$("#loadbarr").text("");
	$("#bsC").html(br);
}
function buscfiltros () {
	var ya=$("#bsA").val();
	var yb=$("#bsB").val();
	var yc=$("#bsC").val();
	var yd=$("#bdD").val();
	var ye=$("#bdE").val();
	window.location.href="ind2x.php?a="+ya+"&b="+yb+"&c="+yc+"&d="+yd+"&e="+ye+"&f=";
}