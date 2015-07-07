$(document).on("ready",inicsripadmin);
function inicsripadmin () {
	$("#btA").on("click",abrirA);
	$("#btB").on("click",abrirB);
	$("#btC").on("click",abrirC);
	$("#btD").on("click",abrirD);
	$(".dell").on("click",borr_confir);
}
function borr_confir () {
	return confirm("Estas seguro de eliminarlo?");
}
function abrirA (aaA) {
	aaA.preventDefault();
	$("#cjA").each(animarA);
}
function abrirB (aaB) {
	aaB.preventDefault();
	$("#cjB").each(animarB);
}
function abrirC (aaC) {
	aaC.preventDefault();
	$("#cjC").each(animarC);
}
function abrirD (aaD) {
	aaD.preventDefault();
	$("#cjD").each(animarD);
}
function animarA () {
	var alto=$(this).css("height");
	if ($(window).width()>800) {
		var resol="450px";
	}
	else{
		var resol="650px";
	}
	if (alto==resol) {
		$(this).animate({height:"0"}, 500);
	}
	else{
		$(this).animate({height:resol}, 500);
	}
}
function animarB () {
	var alto=$(this).css("height");
	if ($(window).width()>800) {
		var resol="250px";
	}
	else{
		var resol="350px";
	}
	if (alto==resol) {
		$(this).animate({height:"0"}, 500);
	}
	else{
		$(this).animate({height:resol}, 500);
	}
}
function animarC () {
	var alto=$(this).css("height");
	if ($(window).width()>800) {
		var resol="1350px";
	}
	else{
		var resol="1550px";
	}
	if (alto==resol) {
		$(this).animate({height:"0"}, 500);
	}
	else{
		$(this).animate({height:resol}, 500);
	}
}
function animarD () {
	var alto=$(this).css("height");
	if ($(window).width()>800) {
		var resol="650px";
	}
	else{
		var resol="750px";
	}
	if (alto==resol) {
		$(this).animate({height:"0"}, 500);
	}
	else{
		$(this).animate({height:resol}, 500);
	}
}