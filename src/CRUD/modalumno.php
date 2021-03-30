<?php 
    session_start();
 
    $dni = $_SESSION['DNI'];
  
    $conexionpersona = mysqli_connect('localhost','root', '777303', 'universidad');
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }

    if($_SESSION['nopass'] == 'nopass')
        $_SESSION['nopass']="<p style='color : red; '>Las contraseñas no coinciden</p>";
    

    $consultapersona = mysqli_query($conexionpersona ,"SELECT * FROM persona WHERE DNI='$dni'");
    $consultaalum = mysqli_query($conexionpersona ,"SELECT * FROM alumno WHERE DNI='$dni'");

    $persona = mysqli_fetch_array($consultapersona);
    $alum = mysqli_fetch_array($consultaalum);
    mysqli_close($conexionpersona);

?>




<!DOCTYPE html>
<html>
<head>
    <meta content="charset=utf-8" />
    <title>PanelProfesor</title>
    <link href="../templates/paneladmin.css" rel="stylesheet" type="text/css">

</head>
<body>
    <h1 style="column-span: all; text-align: center">Actualizar el alumno: <?php echo $dni ?></h1>
    <br></br>
    <h2 style=" text-align: center">Cambiar los campos a actualizar</h2>

    <table style="text-align: center;">
        <form method="POST" enctype="multipart/form-data" action="./updalumbbdd.php" >

            <tr>
                <th>
                <?php 
                    echo "
                    <input type=\"hidden\" name=\"ID\" value=\"".$persona['ID']."\">
                    <input type=\"text\" name=\"nombre\" placeholder=\"nombre\" value=\"".$persona['NOMBRE']."\" >NOMBRE<br>
                    <input type=\"text\" name=\"apellidos\" placeholder=\"apellidos\" value=\"".$persona['APELLIDOS']."\" >APELLIDOS<br>
                    <input type=\"text\" name=\"dni\" placeholder=\"dni\" value=\"".$persona['DNI']."\" >DNI<br>
                    <input type=\"text\" name=\"user\" placeholder=\"user\" value=\"".$persona['USER']."\" >USER<br>
                    <input type=\"password\" name=\"pass\"  placeholder=\"pass\"  >PASS<br>
                    <input type=\"password\" name=\"repass\"  placeholder=\"pass\"  >PASS<br>";

                    echo $_SESSION['nopass'];


                echo "<br><input name=\"archivo\" type=\"file\" />
                    <br>
                    <br>
                    <br><br>
                    <input type=\"text\" name=\"grado\" placeholder=\"grado\"  value=\"".$alum['GRADO']."\"  >GRADO
                    <input type=\"text\" name=\"curso\" placeholder=\"curso\"  value=\"".$alum['CURSO']."\"  >CURSO<br>

                    <input type=\"submit\" value=\"Actualizar\" name=\"submit\" >

                    </th>";
                ?>
            </tr>

        </form>
    </table>    

</body>
</html>




