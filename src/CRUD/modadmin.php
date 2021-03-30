<?php 
    $dni = $_POST['dni'];

    $conexionpersona = mysqli_connect('localhost','root', '777303', 'universidad');
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }


    $consultapersona = mysqli_query($conexionpersona ,"SELECT * FROM persona WHERE DNI='$dni'");
    $consultaprof= mysqli_query($conexionpersona ,"SELECT * FROM profesor WHERE DNI='$dni'");

    $persona = mysqli_fetch_array($consultapersona);
    $prof = mysqli_fetch_array($consultaprof);
    



?>




<!DOCTYPE html>
<html>
<head>
    <meta content="charset=utf-8" />
    <title>Actualizar Admin</title>
    <link href="../templates/paneladmin.css" rel="stylesheet" type="text/css">

</head>
<body>
    <h1 style="column-span: all; text-align: center">Actualizar el administrador: <?php echo $dni ?></h1>
    <br></br>
    <h2 style=" text-align: center">Cambiar los campos a actualizar</h2>
\
    <table style="text-align: center;">
        <form method="POST" enctype="multipart/form-data" action="./updadminbbdd.php" >

            <tr>
                <th>
                <?php 
                    echo "
                    <input type=\"hidden\" name=\"ID\" value=\"".$persona['ID']." \" >
                    <input type=\"text\" name=\"nombre\" placeholder=\"nombre\" value=\"".$persona['NOMBRE']." \" >NOMBRE<br>
                    <input type=\"text\" name=\"apellidos\" placeholder=\"apellidos\" value=\"".$persona['APELLIDOS']." \" >APELLIDOS<br>
                    <input type=\"text\" name=\"tipo\" placeholder=\"tipo\" value=\"".$persona['TIPO']." \" >TIPO<br>
                    <input type=\"text\" name=\"dni\" placeholder=\"dni\" value=\"".$persona['DNI']." \" >DNI<br>
                    <input type=\"text\" name=\"user\" placeholder=\"user\" value=\"".$persona['USER']." \" >USER<br>
                    <input type=\"password\" name=\"pass\"  placeholder=\"pass\" value=\"".$persona['PASS']." \" >PASS<br>
                    <input type=\"password\" name=\"repass\"  placeholder=\"pass\" value=\"".$persona['PASS']." \" >PASS<br>";

                
                    if($_SESSION['nopass'] == 'nopass')
                        echo "<p style='color : red; '>Las contraseñas no coinciden</p>";

                        if($_SESSION['notipo'] == 'notipo')
                        echo "<p style='color : red; '>El tipo de cuenta no es valido</p>";

                echo "<br><input name=\"archivo\" type=\"file\" />
                    <br>
                    <br>
                    <br>
                    <input type=\"submit\" value=\"Actualizar\" name=\"submit\" >

                    </th>";
                ?>
            </tr>

        </form>
    </table>    

    
    


</body>
</html>





<?php





    $conexionadmin = mysqli_connect('localhost','root', '777303', 'universidad');
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }

    $dni = $_POST['dni'];

    $consulta = mysqli_query($conexionadmin, "SELECT * FROM persona where TIPO='ALUMNO'");

    $numcol = mysqli_num_rows($consulta);



?>