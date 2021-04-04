<?php


    if($_POST['elec'] == 'si'){

        $conexionpersona = mysqli_connect('localhost','root','777303','universidad') ; 
        if (mysqli_connect_errno()) {
            printf("Conexión fallida: %s\n", mysqli_connect_error());
            die();
        }

        $dni = $_POST['dni'];

        mysqli_query($conexionpersona ,"DELETE FROM persona WHERE DNI='$dni'");
        mysqli_query($conexionpersona ,"DELETE FROM alumno WHERE DNI='$dni'");


    }else{
        header("Location: ../delAlumno.php");
    }
    header("Location: ../delAlumno.php")
?>