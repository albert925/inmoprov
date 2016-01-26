<?php
	$conexion = mysqli_connect("localhost", "root", "", "provase_new");
	if (mysqli_connect_errno($conexion)) {
		echo "faloo al conectar a".mysqli_connect_error();
	}
	/*
	host: 50.62.209.72:3306
	base_datos: proinco_provase;
	root: provase;
	pass:provapro123
	*/
	function inpseg($conx, $post)
	{
		$input = htmlentities($post);
		$segur = mysqli_real_escape_string($conx, $input);
		$otro = replace_($segur);
		return $otro;
	}
	function segcon($conx, $post)
	{
		$input = htmlentities($post);
		$segur = mysqli_real_escape_string($conx, $input);
		return $segur;
	}

	function replace_($string = '', $special_chars = array())
	{
		if (empty($string) || !is_string($string)) {
			return -1;
		}
		$string = trim($string);
		// Replace special chars
		if (!empty($special_chars)) {
			$string = str_replace(
				$special_chars["search"],
				$special_chars["replace"],
				$string
			);
		}
		// Delete special chars
		$string = str_replace(
			array("\\", "¨", "º", "-", "~",
				"#", "@", "|", "!", "\"",
				"·", "$", "%", "&", "/",
				"(", ")", "?", "'", "¡",
				"¿", "[", "^", "`", "]",
				"+", "}", "{", "¨", "´",
				">", "< ", ";", ",", ":",
				".", " "),
			'',
			$string
		);
		return $string;
	}
	function uncoscarcper($string = '', $special_chars = array())
	{
		if (empty($string) || !is_string($string)) {
			return -1;
		}
		$string = trim($string);
		// Replace special chars
		if (!empty($special_chars)) {
			$string = str_replace(
				$special_chars["search"],
				$special_chars["replace"],
				$string
			);
		}
		// Delete special chars
		$string = str_replace(
			array("\\", "¨", "º", "-", "~",
				"#", "@", "|", "!", "\"",
				"·", "$", "%", "&", "/",
				"(", ")", "?", "'", "¡",
				"¿", "[", "^", "`", "]",
				"+", "}", "{", "¨", "´",
				">", "< ", ",", ":", " "),
			'',
			$string
		);
		return $string;
	}
?>