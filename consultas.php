<?php
require 'funciones.php';
encabezado_html("Menú de consultas");
 ?>
 <body>
   <h1>Consultas disponibles</h1>
   <ol>
     <li> <a href="alumnos_por_curso.php"> Alumnos de un curso </a></li>
          <ul>
          <?php
            $cursos = cursos(conexion_mysql());
            foreach ($cursos as $curso){
              echo '<li> <a href="alumnos_por_curso.php?curso='.$curso.'" > '.$curso.' </li>';
            }
           ?>
          </ul>
     <li> <a href="alumnos_todos.php"> Todos los alumnos </a></li>
     <li> Consultar los campos de una tabla </li>
        <ul>
          <?php
            $tablas = tablas_bd(conexion_mysql());
            foreach ($tablas as $nombre) {
              echo '<li> <a href="campos_tabla.php?tabla='.$nombre.'"> '.$nombre.' </li>';
            }
      ?>
        </ul>
     <li> <a href="elegir_tabla.php"> Seleccionar una tabla </a> </li>
     <li> Introducir datos </li>
     <ul>
       <li> <a href="introducir_datos.php?tabla=Alumnos"> Introducir datos </a></li>
     </ul>

   </ol>
 </body>
