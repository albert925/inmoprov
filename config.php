<?php
	$conexion=mysql_connect("localhost","root","") or die (mysql_error());
	$base_datos=mysql_select_db("provase_new") or die ("Base de datos no disponible");
?>