<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	require 'funciones.php';
	encabezado_html("Campos de una tabla");
	$enlace = conexion_mysql();
	$descripcion = "Campos de la tabla: ".$_GET["tabla"];
	echo '<h2>'.$descripcion.'</h2>';
	if ($campos = campos_tipo_tabla($enlace, $_GET["tabla"])){
		foreach ($campos as $campo=>$dato) {
      echo $campo. " es de tipo: ".$dato."<br>";
    };
		}
		mysqli_close($enlace);
		pie_html();
	?>
