<?php
function encabezado_html($title){
    echo '
    <html>
    <head>
    	<title> '.$title.' </title>
      <link rel="stylesheet" href="css/estilos.css" />
    </head>';
}

function conexion_mysql(){
    $dbhost = 'localhost:3366';
  	$dbuser = 'root';
  	$dbpass = 'root';
  	$database = 'luisdorao';
    if(mysqli_connect_errno())
  	  {	die('No se pudo conectar a la base de datos: '
        . mysqli_connect_error());};
  	return mysqli_connect($dbhost, $dbuser, $dbpass, $database);
    echo '<p>Conexión Correcta... </p>';
}

function muestra_resultados($result){
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

function tabla_resultados($result){
  $cabeceras = mysqli_fetch_fields( $result );
  echo '<table class="resultados"><tr>';
  foreach ($cabeceras as $titulo){
    echo "<th>".$titulo->name."</th>";
  };
  echo "</tr>";
  while ($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    foreach ($row as $valor){
      echo "<td>".$valor."</td>";
    }
  };
}
?>
