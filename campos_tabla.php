<?php
	require 'configuracion.php';
	require 'funciones.php';
	encabezado_html("Campos de una tabla");
	$enlace = conexion_mysql();
	$descripcion = "Campos de la tabla: ".$_GET["tabla"];
	echo '<h2>'.$descripcion.'</h2>';
	if ($campos = campos_tipo_tabla($enlace, $_GET["tabla"])){
		tabla_associativo($campos);
				}
		mysqli_close($enlace);
		pie_html();
	?>
