<?php
  require 'configuracion.php';
  require 'funciones.php';
  encabezado_html("Alumnos por curso");
$enlace = conexion_mysql();
$descripcion = 'Alumnos por cursos y gastos';
$sql = 'SELECT Alumnos.id, Nombre, Apellido1, Apellido2, curso_txt AS curso,
  letra, gasto_material AS "Material EUR", email
  FROM Alumnos INNER JOIN Cursos
  ON Alumnos.id_curso = Cursos.id
  ORDER BY curso;';
echo '<h2>'.$descripcion.'</h2>';
if ($result = mysqli_query($enlace, $sql)){
  tabla_resultados($result);
  }
  mysqli_close($enlace);
  pie_html();
?>
