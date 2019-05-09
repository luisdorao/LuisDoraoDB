<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	require 'funciones.php';
	encabezado_html("Elegir una tabla");
	?>
<body>
	<?php
	$enlace = conexion_mysql();
	$descripcion = 'Tablas en la base de datos';
	echo '<h2>'.$descripcion.'</h2>';
	if ($tablas = tablas_bd($enlace)){
		foreach ($tablas as $dato) {
      echo $dato."<br>";
    };
		}
		mysqli_close($enlace);
	?>
</body>
</html>
