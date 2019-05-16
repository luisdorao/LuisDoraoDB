<?php
require 'configuracion.php';
require 'funciones.php';

encabezado_html("Menú de consultas");
 ?>
   <h1>Consultas disponibles</h1>
   <ol>
     <li> Alumnos de un curso </li>
          <ul>
          <?php
            $enlacesql = conexion_mysql();
            $cursos = cursos($enlacesql);
            foreach ($cursos as $id=>$curso){
              echo '<li> <a href="alumnos_por_curso.php?curso='.$id.'" > '.$curso.' </a></li>';
            };
            mysqli_close($enlacesql);
            ?>
          </ul>
     <li> <a href="alumnos_todos.php"> Todos los alumnos </a></li>
     <li> Consultar los campos de una tabla </li>
        <ul>
          <?php
            $enlacesql = conexion_mysql();
            $tablas = tablas_bd($enlacesql);
            foreach ($tablas as $tabla) {
              echo '<li> <a href="campos_tabla.php?tabla='.$tabla.'"> '.$tabla.' </a></li>';
            }
            mysqli_close($enlacesql);
            ?>
        </ul>
     <li> Introducir datos </li>
     <ul>
       <?php
         $enlacesql = conexion_mysql();
         $tablas = tablas_bd($enlacesql);
         foreach ($tablas as $tabla) {
           echo '<li> <a href="introducir_datos.php?tabla='.$tabla.'"> '.$tabla.' </a></li>';
         }
       ?>
     </ul>
   </ol>
 </body>
 </html>
