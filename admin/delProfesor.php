
</html><!DOCTYPE html>
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
        <title>Elimina profesor</title>
    </head>
    <body>
    <h1>Elimina a un profesor</h1>
    <?php   
         $conexionadmin = mysqli_connect('localhost','root','777303','universidad') ; 
         if (mysqli_connect_errno()) {
             printf("Conexión fallida: %s\n", mysqli_connect_error());
             die();
         }
     

        
        $consulta = mysqli_query($conexionadmin, "SELECT * FROM persona where TIPO='PROFESOR'");
        $numcol = mysqli_num_rows($consulta);

        for( $i = 0 ; $i < $numcol ; $i++ ){
            $fila = mysqli_fetch_array($consulta);

            if($i == 0){
                echo "<form method=\"POST\" enctype=\"multipart/form-data\" action=\"./CRUD/delProf.php\" > 
                <table class=\"encabezado\" > 
                <tr class = \"titulos\">
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Tipo</th>
                <th>DNI</th>
                <th>Seleccion</th>

                </tr>";
            }
                $dni = $fila['DNI'];
                echo  
                "<tr class=\"filas\" >
                <td> ".$fila['ID']." </td>
                <td> ".$fila['NOMBRE']." </td>
                <td> ".$fila['APELLIDOS']." </td>
                <td> ".$fila['TIPO']." </td>
                <td> ".$fila['DNI']." </td>
                <td> <input type=\"hidden\" name=\"dni\" value=\"$dni\" placeholder=\"Eliminar\"  >
                <input type=\"submit\" value=\"Eliminar\" placeholder=\"Eliminar\"  >
                </td><tr>";
        }
        echo "</table></form>";
    
            
        mysqli_close($conexionadmin);
        
        echo " <br>   <form action=\"./paneladmin.php\" >
        <input type=\"submit\" value=\"Volver\" />
        </form>";

    ?>
    </body>
</html>