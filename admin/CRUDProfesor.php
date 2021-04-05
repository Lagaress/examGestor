<?php 
session_start();
    $nombresesion = $_SESSION['nombre'];
    $apellsesion = $_SESSION['apellidos'];
    $fotosesion = $_SESSION['foto'];

    if($nombresesion ==null || $apellsesion==null){
        echo "no hay autorizacion";
        die();
    }
    
    if($_SESSION['nopass'] == 'nopass')
        $_SESSION['nopass']="<p style='color : red; '>Las contraseñas no coinciden</p>";


 ?>



<!DOCTYPE html>
<html>
<head>
    <meta content="charset=utf-8" />
    <title>Crear Profesor</title>
    <link href="../templates/paneladmin.css" rel="stylesheet" type="text/css">

</head>
<body>
    <h1 style="column-span: all; text-align: center">Panel de control del Administrador: <?php echo $nombresesion." ".$apellsesion ?></h1>
    <br></br>
    <h2 style=" text-align: center">Crear Profesor</h2>
    
    <form method="POST" enctype="multipart/form-data" action="./CRUD/crearprofesor.php">
        <table style="text-align: center;">
            <tr>
                <th>
                <input type="text" name="nombre"  value="" placeholder="Nombre" required> <br>
                <input type="text" name="apellidos"  value="" placeholder="Apellidos" required > <br>
                <input type="text" name="dni"  value="" placeholder="DNI" required > <br>
                <input type="text" name="user" value="" placeholder="Usuario" required> <br>
                <input type="password" name="pass" value="" placeholder="Contraseña" required> <br>
                <input type="password" name="repass"  value="" placeholder="Repite contraseña" required> <br>
                <?php 
                   echo  $_SESSION['nopass'];
                ?>
                <input name="archivo" type="file" />
                <br>
                                    </th>
            </tr>
            <tr>
            <th>
                <br>Asignaturas que imparte: <br>
                <input style="width: 500px;" type="text" name="matricula[]" placeholder="Asignatura"  ><br>
                <input style="width: 500px;" type="text" name="matricula[]" placeholder="Asignatura"  ><br>
                <input style="width: 500px;" type="text" name="matricula[]" placeholder="Asignatura"  ><br>
                <input style="width: 500px;" type="text" name="matricula[]" placeholder="Asignatura"  ><br>
                <input style="width: 500px;" type="text" name="matricula[]" placeholder="Asignatura"  ><br>
                <input type="submit" value="Crear Profesor" />

            <th>
            </tr>

        </table>    

    </form>
    


</body>
</html>
