<html>
<head>
	<title>Consulta sobre base de datos</title>
</head>
<body>
	<?php
	$dbhost = 'localhost:3366';
	$dbuser = 'root';
	$dbpass = 'root';
	$database = 'luisdorao';
	$enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $database);
	if(mysqli_connect_errno())
	  {	die('No se pudo conectar a la base de datos: ' . mysqli_connect_error());}
	echo '<p>Conexión Correcta... </p>';
	// CONSULTAR LA BASE DE DATOS
	$sql = 'SELECT Alumnos.id, Nombre, Apellido1, Apellido2, curso_txt AS curso, letra, gasto_material AS EUR, email
	  FROM Alumnos INNER JOIN Familias INNER JOIN Cursos
	  ON Familias.id = Alumnos.id_familia
	  AND Alumnos.id_curso = Cursos.id
	  ORDER BY curso;';
	if($result = mysqli_query($enlace, $sql)){
		$fila = 1;
	  $cabeceras = mysqli_fetch_fields ( $result );
	  while ($row = mysqli_fetch_assoc($result)) {
	      echo "## Fila: ".$fila++." ##<br>";
				foreach ($cabeceras as $valor) {
	        echo $valor->name." : ".$row[$valor->name]."<br>";
				}
				echo "---------------------------------------------<br>";
	      }
		echo "Datos Recuperados Correctamente<br>";
		}
		mysqli_close($enlace);
		echo 'Conexión CERRADA... ';
	?>
</body>
</html>
