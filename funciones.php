<?php
$dbhost = 'localhost:3366';
$dbuser = 'root';
$dbpass = 'root';
$database = 'luisdorao';

# Imprime un encabezado html común a varias páginas
function encabezado_html($title){
    echo '
    <html>
    <head>
    	<title> '.$title.' </title>
      <link rel="stylesheet" href="css/estilos.css" />
    </head>
    <body>';
}
# Imprime un pie de página html
function pie_html(){
  echo '
  <hr>
  <a href="consultas.php" >Volver al listado de consultas</a>
  </body>
  </html>';
}

# Devuelve una conexion a base de datos a partir de las variables definidas
# $dbhost, $dbuser, $dbpass, $database
function conexion_mysql(){
    global $dbhost, $dbuser, $dbpass, $database;
    if(mysqli_connect_errno())
  	  {	die('No se pudo conectar a la base de datos: '
        . mysqli_connect_error());};
  	return mysqli_connect( $dbhost,  $dbuser,  $dbpass,  $database);
    echo '<p>Conexión Correcta... </p>';
}

# Devuelve el array $nombres_tablas con los nombres de las tablas de
# la base de datos correspondiente a una conexión $enlace
function tablas_bd($enlace){
    global $database;
    $sql="SHOW TABLES;";
    $nombres_tablas=array();
    if ($resultado = mysqli_query($enlace, $sql)){
      while ($row = mysqli_fetch_assoc($resultado)){
        $nombres_tablas[]= $row["Tables_in_$database"];
      }
      return $nombres_tablas;
    }
    else die ('No existen tablas');
}

# Devuelve el array $cabeceras con los nombres de los campos de una tabla
function campos_tabla($enlace, $tabla){
    $sql="SHOW COLUMNS FROM $tabla;";
    $cabeceras=array();
    if ($describe_columnas = mysqli_query($enlace, $sql)){
      while ($row = mysqli_fetch_assoc($describe_columnas)){
        $cabeceras[]= $row["Field"];
      }
      return $cabeceras;
    }
    else die ('No existe esa tabla');
}

# Devuelve el array asociativo $cabeceras con los nombres y los tipos de introducir_datos
# de los campos de una tabla
function campos_tipo_tabla($enlace, $tabla){
    $sql="SHOW COLUMNS FROM $tabla;";
    $cabeceras=array();
    if ($describe_columnas = mysqli_query($enlace, $sql)){
      while ($row = mysqli_fetch_assoc($describe_columnas)){
        $cabeceras[$row["Field"]]=$row["Type"];
      }
      return $cabeceras;
    }
    else die ('No existe esa tabla');
}

# Devuelve un array asociativo id->curso_txt con los cursos de la escuela
function cursos($enlace){
    $sql = "SELECT id, curso_txt FROM cursos;";
    $cursos = array();
    if ($resultado = mysqli_query($enlace, $sql)){
      while ($row = mysqli_fetch_assoc($resultado)){
        $cursos[$row[id]]= $row["curso_txt"];
      }
    }
      return $cursos;
}

# Imprime una tabla con los resultados de una consulta $resultado
# Cabecera con los nombres de los campos y filas con datos
function tabla_resultados($result){
  $cabeceras = mysqli_fetch_fields( $result );
  echo '<table class="resultados"><tr>';
  echo '<th>Nr.</th>';
  foreach ($cabeceras as $titulo){
    echo "<th>".$titulo->name."</th>";
  };
  echo "</tr>";
  $nr=1;
  while ($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$nr++."</td>";
    foreach ($row as $valor){
      echo "<td>".$valor."</td>";
    }
  };
  echo "</table>";
}
?>
