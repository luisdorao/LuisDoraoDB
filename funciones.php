<?php
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
    if(mysqli_connect_errno())
  	  {	die('No se pudo conectar a la base de datos: '
        . mysqli_connect_error());};
    return mysqli_connect( DBHOST,  DBUSER,  DBPASS,  DATABASE);
}

# Devuelve el array $nombres_tablas con los nombres de las tablas de
# la base de datos correspondiente a una conexión $enlace
function tablas_bd($enlace){
    $database = DATABASE;
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
# Incluye cabecera con los nombres de los campos y filas con datos
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

/*
# Crea formulario para una tabla en una base de datos conectada por $enlace
function formulario_tabla($enlace, $tabla){
  $array_campos = campos_tipo_tabla ($enlace, $tabla);
  echo '<h2>Formulario para la tabla '.$tabla.'</h2>';
  echo '<input type="hidden" name="tabla" value="'.$tabla.'">';
  echo '<table>';
  foreach ($array_campos as $campo => $tipo) {
    $actual= isset($_POST[$campo])? $_POST[$campo] : "";
    echo '<tr>';
    echo '<td>'.$campo." - ".$tipo.'</td>';
    echo '<td><input name="'.$campo.'" '.tipo_input($tipo).' value="'.$actual.'"></td>';
    echo '</tr>';}
  echo '</table>';
}
*/

# Selecciona los campos de una $tabla de una base de datos $enlace que no son auto_increment
# y se pedirán en un formulario. Devuelve un array asociativo $campos [Field:Type]
function campos_para_formulario($enlace, $tabla){
  $sql="DESCRIBE $tabla;";
  $campos=array();
  if ($describe_columnas = mysqli_query($enlace, $sql)){
    while ($row = mysqli_fetch_assoc($describe_columnas)){
      if(!$row["Extra"]=="auto_increment"){
        $campos[$row["Field"]]=$row["Type"];
      }
    }
    return $campos;
  }
  else die ('No existe esa tabla');
  }

# Crea formulario a partir de array asociativo $campo:$tipo_dato
function formulario_para_assoc($array_asoc){
  echo '<table>';
  $error=FALSE;
  foreach ($array_asoc as $campo => $tipo) {
    $actual= isset($_POST[$campo])? $_POST[$campo] : "";
    echo '<tr>';
    echo '<td>'.$campo." - ".$tipo.'</td>';
    echo '<td><input name="'.$campo.'" '.tipo_input($tipo).' value="'.$actual.'"></td>';
    if (!valido($actual,$tipo)) {
      $error=TRUE;
      echo '<td class="error">Contenido no válido</td>';
    }
    echo "</tr>\n";}
    if ($error) {echo '<p class="error">Hay campos no completados</p>';}
    else {echo '<tr><td> <button type="button">Confirmar Datos</button> </td></tr>';}
  echo '</table>';
}

########################################################
# Funciones para validar las entradas de un formulario #
# a partir de un par $valor:$tipo                      #
########################################################

function valido($valor, $tipo): bool {
  if (trim($valor) == '') {return FALSE;}
  else {return TRUE;}
  }

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

#######################################
#           FUNCIONES AJAX            #
#######################################

function ayuda(){
  echo ('
  <button id="boton_ayuda" type="button" onclick="loadDoc()">Pedir ayuda</button>
  <p id="demo">La ayuda aparecerá aqui</p>
  <script>
  function loadDoc(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("demo").innerHTML = this.responseText;
        }
      else {
        document.getElementById("demo").innerHTML=xhttp.statusText;
      }
      };
    xhttp.open("GET", "texto_ayuda.txt", true);
    xhttp.send();
    }

  </script>
  ');
}

function prueba_montar(){
  echo ('
  <button type="button" onclick="loadDoc2()">Probar php</button>
  <p id="demo2">Comprobar si php esta activo y funcionando</p>
  <script>
  function loadDoc2(){
    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("demo2").innerHTML = this.responseText;
        }
      else {
        document.getElementById("demo2").innerHTML=xhttp.statusText;
      }
      };
    xhttp2.open("GET", "prueba.php", true);
    xhttp2.send();
    }
  </script>
  ');
}
?>
