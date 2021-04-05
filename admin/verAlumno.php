<!DOCTYPE html>
<html>
    <head>
    <style>
h1 {
    color: black ;
    font-family: fantasy;
    text-align: center ; 
    font-size: 30px ; 
    
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

</style>
        <title>Ver Alumno</title>
    </head>
    <body>
    <h1 style= "color: black;">Datos de los alumnos</h1>
    <?php   
         $conexionadmin = mysqli_connect('localhost','root','777303','universidad') ; 
         if (mysqli_connect_errno()) {
             printf("Conexión fallida: %s\n", mysqli_connect_error());
             die();
         }
     

        
        $consulta = mysqli_query($conexionadmin, "SELECT * FROM persona where TIPO='ALUMNO'");
        $numcol = mysqli_num_rows($consulta);

        for( $i = 0 ; $i < $numcol ; $i++ ){
            $fila = mysqli_fetch_array($consulta);
            $actdni = $fila['DNI'];
            $consultaalum = mysqli_query($conexionadmin, "SELECT * FROM alumno where DNI='$actdni'");

            $filaalum = mysqli_fetch_array($consultaalum);

            if($i == 0){
                echo " <table class=\"encabezado\" > 
                <tr class = \"titulos\">
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Tipo</th>
                <th>DNI</th>
                <th>Pass</th>
                <th>User</th>
                <th>Curso</th>
                <th>Grado</th>
                <th>Asignaturas</th>
                <th>Foto</th>
                </tr>";
            }
                $filename = $fila['FOTO']; //nombre de la imagen
                $dir = "../imgs/".$filename ;  //directorio en ella, lo hago asi porque emborronaba la legibilidad en href ./imgs/filename con las comas y demás
                 
                $matr =str_replace(",", " ", $filaalum['MATRICULADO'] );

                echo  
                "<tr class=\"filas\" >
                <td> ".$fila['ID']." </td>
                <td> ".$fila['NOMBRE']." </td>
                <td> ".$fila['APELLIDOS']." </td>
                <td> ".$fila['TIPO']." </td>
                <td> ".$fila['DNI']." </td>
                <td> ".sha1($fila['PASS'])." </td>
                <td> ".$fila['USER']." </td>
                <td> ".$filaalum['CURSO']." </td>
                <td> ".$filaalum['GRADO']." </td>
                <td> ".$matr."</td>
                <td> <a href=$dir>";
                if($filename != null) //si no hay imagen da igual, porque no aparece el hipervinculo
                    echo "<img src=\"../imgs/img.png\" width=\"30px\" height=\"30px\" /> </a> </td>";
                echo "<tr>";
        }
        echo "</table></div>";
    
            
        mysqli_close($conexionadmin);
        
        echo " <br>   <form action=\"./paneladmin.php\" >
        <input type=\"submit\" value=\"Volver\" />
        </form>";

    ?>
    </body>
</html>