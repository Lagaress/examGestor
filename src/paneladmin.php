<?php 
session_start();
    $nombresesion = $_SESSION['nombre'];
    $apellsesion = $_SESSION['apellidos'];
    $fotosesion = $_SESSION['foto'];
    $_SESSION['nopass']='';
    if($nombresesion ==null || $apellsesion==null){
        echo "no hay autorizacion";
        die();
    }

 ?>



<!DOCTYPE html>
<html>
<head>
    <meta content="charset=utf-8" />
    <title>Panel Admin</title>
    <link href="../templates/paneladmin.css" rel="stylesheet" type="text/css">

</head>
<body>
    <h1 style="text-align: center">Panel de control del Administrador: <?php echo $nombresesion." ".$apellsesion ?></h1>
    

    <table style="text-align: center;">
        <tr> 
            <th>
                
            </th>
            <th>            
              
            </th>
            <th>
                <?php
                echo "<img src=\"../imgs/".$fotosesion." \" width=\"180px\" height=\"225px\" style=\"border: 1px solid; 
                color: black;\" ><br>"?>
            </th>
        </tr>
        <tr>
            <th>
               
            </th>
            <th>            
               
            </th>
            <th>
                <a type="button" href="cerrarsesion.php" >Cerrar sesion</a>
            </th>
        </tr>
    </table>
    
    <br></br>
    <h3 style="column-span: all; text-align: center">Operaciones de la Base de datos</h3>
    <br></br>
    <table style="text-align: center; ">

        <tr>
            <th>
                <a href="CRUDAlumno.php" class="opalumno">Crear Alumno</a>
            </th>
            <th>            
                <a href="CRUDProfesor.php" class="opprof">Crear Profesor</a>
            </th>
            <th> 
                <a href="CRUDAdmin.php" class="opprof">Crear Administrador</a>

            </th>
        </tr>
    </table>
    <br><br> <br><br> <br><br>
    <table style="text-align: center; ">
        <tr>
            <th>
                <a href="verAlumno.php" class="opalumno">Ver Alumnos</a>
            </th>
            <th>            
                <a href="verProfesor.php" class="opprof">Ver Profesores</a>
            </th>
            <th> 
                <a href="verAdmin.php" class="opprof">Ver Administradores</a>

            </th>
        </tr>
    </table>
    <br><br> <br><br> <br><br>
    <table style="text-align: center; ">
        <tr>
            <th>
                <a href="updAlumno.php" class="opalumno">Actualizar Alumnos</a>
            </th>
            <th>            
                <a href="updProfesor.php" class="opprof">Actualizar Profesores</a>
            </th>
            <th> 
                <a href="updAdmin.php" class="opprof">Actualizar Administradores</a>

            </th>
        </tr>
    </table>
    <br><br> <br><br> <br><br>
    <table style="text-align: center; ">
        <tr>
            <th>
                <a href="delAlumno.php" class="opalumno">Eliminar Alumnos</a>
            </th>
            <th>            
                <a href="delProfesor.php" class="opprof">Eliminar Profesores</a>
            </th>
            <th> 
                <a href="delAdministrador.php" class="opprof">Eliminar Administradores</a>

            </th>
        </tr>
    </table>
    <br><br><br><br>

    
</body>
</html>

