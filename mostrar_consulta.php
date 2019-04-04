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
  if($sentencia = mysqli_prepare($enlace, $sql)){
		/* ejecutar la sentencia sql */
		mysqli_stmt_execute($sentencia);
    /* vincular las variables de resultados */
    mysqli_stmt_bind_result($sentencia, $Nombre, $Apellido1);
    /* obtener los valores */
		$Fila = 1;
		while (mysqli_stmt_fetch($sentencia)) {
        echo "Fila: ".$Fila++."<br>".
						"Nombre:".$Nombre."<br> ".
            "Apellidos: {$row['Apellido1']} {$row['Apellido2']} <br> ".
            "Curso: {$row['curso']} <br> ".
            "--------------------------------<br>";
        }
		echo "Datos Recuperados Correctamente\n";
		/* cerrar la sentencia */
    mysqli_stmt_close($sentencia);
		}
	mysqli_close($enlace);
	echo 'Conexión CERRADA... ';
	?>
</body>
</html>
