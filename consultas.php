<?php
require 'funciones.php';
encabezado_html("Menú de consultas");
 ?>
 <body>
   <h1>Consultas disponibles</h1>
   <ol>
     <li> <a href="alumnos_por_curso.php"> Alumnos de un curso </a></li>
     <li> <a href="alumnos_todos.php"> Todos los alumnos </a></li>
     <li> <a href="campos_tabla.php"> Consultar los campos de una tabla </a> </li>
     <li> Introducir datos </li>
     <ul>
       <li> <a href="introducir_datos.php?tabla=Alumnos"> Introducir datos </a></li>
     </ul>

   </ol>
 </body>
