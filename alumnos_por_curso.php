<?php
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  require 'funciones.php';
  encabezado_html("Alumnos por curso");
?>
<body>
<?php
$enlace = conexion_mysql();
$descripcion = 'Alumnos por cursos y gastos';
$sql = 'SELECT Alumnos.id, Nombre, Apellido1, Apellido2, curso_txt AS curso,
  letra, gasto_material AS "Material EUR", email
  FROM Alumnos INNER JOIN Familias INNER JOIN Cursos
  ON Familias.id = Alumnos.id_familia
  AND Alumnos.id_curso = Cursos.id
  ORDER BY curso;';
echo '<h2>'.$descripcion.'</h2>';
if ($result = mysqli_query($enlace, $sql)){
  tabla_resultados($result);
  #muestra_resultados($result);
  }
  mysqli_close($enlace);
?>
</body>
</html>
