<?php
	require 'funciones.php';
	encabezado_html("Introducir datos en Luis Dorao DB");
	echo "<h1>Introducir datos nuevos en ".$_GET["tabla"]."</h1>";
  echo '<form method="POST">';
	echo '<h2>Formulario para '.$_GET["tabla"].':</h2>';
	formulario_para_assoc(campos_para_formulario(conexion_mysql(), $_GET["tabla"]));
	echo '<input type="submit" value="Validar datos">';

	echo '</form>';
	pie_html();

  ?>
