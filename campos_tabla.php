<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	require 'funciones.php';
	encabezado_html("Campos de una tabla");
	?>
<body>
	<?php
	$enlace = conexion_mysql();
	$descripcion = 'Campos de una tabla';
	echo '<h2>'.$descripcion.'</h2>';
	if ($campos = campos_tabla($enlace, "Familias")){
		foreach ($campos as $dato) {
      echo $dato."<br>";
    };
		#muestra_resultados($result);
		}
		mysqli_close($enlace);
	?>
</body>
</html>
