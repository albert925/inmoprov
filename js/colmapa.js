google.load("maps","3.9", {"other_params":"sensor=true"});
var mapa_colocar;
var map;
$(document).on("ready",inicio_mapa);
function inicio_mapa () {
	var lugar=new google.maps.LatLng(7.886603, -72.497806);
	var opcionmapa={
		zoom:16,
		center:lugar,
		mapTypeId:google.maps.MapTypeId.WALKING
	};
	mapa_colocar=new google.maps.Map($("#map_canvas").get(0),opcionmapa);
	var contenidostrin="<h2 id='titumap'>Inmobiliaria Provase</h2>";
	var ventainfo=new google.maps.InfoWindow({content:contenidostrin,maxWidth:1200});
	var marcauno=new google.maps.Marker({
		position:lugar,
		map:mapa_colocar,
		title:"Inmobiliaria Provase"
	});
	marcauno.addListener("mouseover",function () {
		ventainfo.open(mapa_colocar,marcauno);
	});
}