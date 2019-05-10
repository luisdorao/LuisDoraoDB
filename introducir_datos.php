<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	require 'funciones.php';
	encabezado_html("Introducir datos en Luis Dorao DB");
	echo "<h1>Introducir datos nuevos en ".$_GET["tabla"]."</h1>";
  $campos = campos_tipo_tabla(conexion_mysql(), $_GET["tabla"]);
  foreach ($campos as $campo=>$tipo) {
    echo $campo." - [ ".$tipo." ]"."<br>";
  };
	pie_html();
  ?>
