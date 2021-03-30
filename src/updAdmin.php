
</html><!DOCTYPE html>
<html>
    <head>
        <title>Actualizar administrador</title>
        <link href="../templates/tabla.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <h1 style= "color: blue;">Selecciona un administrador</h1>
    <?php   
         $conexionadmin = mysqli_connect('localhost','root', '777303', 'universidad');
         if (mysqli_connect_errno()) {
             printf("Conexión fallida: %s\n", mysqli_connect_error());
             die();
         }
     

        
        $consulta = mysqli_query($conexionadmin, "SELECT * FROM persona where TIPO='ADMIN'");
        $numcol = mysqli_num_rows($consulta);

        for( $i = 0 ; $i < $numcol ; $i++ ){
            $fila = mysqli_fetch_array($consulta);

            if($i == 0){
                echo "<form method=\"POST\" enctype=\"multipart/form-data\" action=\"./CRUD/modadmin.php\" > 
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
                <td> <input type=\"submit\" name=\"dni\" value=\"".$dni."\"  ></td>

                <tr>";
        }
        echo "</table></form>";
    
            
        mysqli_close($conexionadmin);
        
        echo " <br>   <form action=\"./paneladmin.php\" >
        <input type=\"submit\" value=\"Volver\" />
        </form>";

    ?>
    </body>
</html>