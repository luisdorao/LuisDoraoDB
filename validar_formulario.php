<?php
require 'funciones.php';
encabezado_html("Validar Datos del Formulario");
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  echo "<h1>Valide los datos que se van a registrar:</h1>";
  tabla_associativo($_POST);
  echo "<p>¿Los datos son correctos?</p>";
} else {
  echo "No hay datos para validar.";
}
pie_html();
?>
