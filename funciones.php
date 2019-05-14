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

# Devuelve el array asociativo $cabeceras con los nombres y
# los tipos de datos de los campos de una tabla
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
# Incluyes cabecera con los nombres de los campos y filas con datos
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

# Imprime una tabla con el contenido de un array asociativo
function tabla_associativo($array_asoc){
  echo '<table class="tabla_array"><tr>';
  echo '<th>Clave</th>';
  echo '<th>Valor</th>';
  echo '</tr>';
  foreach ($array_asoc as $clave=>$valor){
    echo '<tr>';
    echo '<td>'.$clave.'</td>';
    echo '<td>'.$valor.'</td>';
    echo '<tr>';
  };
  echo "</table>";
}

# Crea formulario para una tabla en una base de datos conectada por $enlace
function formulario_tabla($enlace, $tabla){
  $array_campos = campos_tipo_tabla ($enlace, $tabla);
  echo '<h2>Formulario para la tabla '.$tabla.'</h2>';
    echo '<input type="hidden" name="tabla" value="'.$tabla.'">';
  foreach ($array_campos as $campo => $tipo) {
    $actual= isset($_POST[$campo])? $_POST[$campo] : "";
    echo $campo." - ".$tipo;
    echo '<input name="'.$campo.'" '.tipo_input($tipo).' placeholder="'.$actual.'">';
    echo "<br>\n";
  }
}

########################################################
# Funciones para validar las entradas de un formulario #
########################################################

# Comprobar si un texto no esta vacío
function es_cadena_vacia(string $texto): bool {
  return (trim($texto) == '');
}

# Comprobar si es un número entero
function es_entero(string $numero): bool {
  return (filter_var($numero, FILTER_VALIDATE_INT) === FALSE) ? False : True;
}

# Comprobar si es un formato de E-Mail
function es_email(string $texto): bool {
  return (filter_var($texto, FILTER_VALIDATE_EMAIL) === FALSE) ? False : True;
}


# Devuelve el tipo de input para cada formulario
# según el tipo de dato de la tabla de la base de datos
function tipo_input($tipo_dato){
  $tipo_array = explode("(",$tipo_dato);
  $tipo_txt = $tipo_array[0];
  switch ($tipo_txt):
    case "int";
    case "smallint";
        return 'type= "number" step="1" min="0"';
        break;
    case "float";
        return 'type= "number" step="0.01" min ="0"';
        break;
    case "varchar":
        return 'type="text"';
        break;
    default:
        return "no-definido";
endswitch;
}

?>
