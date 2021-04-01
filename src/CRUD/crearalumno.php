<?php 

    session_start();
    $_SESSION['nopass']='';

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];

    
    if($pass!=$repass){
        $_SESSION['nopass']='nopass';
        header("Location: failpassalum.php");
        die();
    }


    $directorio = '../../imgs/';
    $archivo = basename($_FILES['archivo']['name']);
   
    if(  $archivo == NULL)
        $archivo = "default.jpg";

    $subir_archivo = $directorio.$archivo;


    if(move_uploaded_file($_FILES['archivo']['tmp_name'], $subir_archivo))
        echo "El archivo es válido y se cargó correctamente.<br><br>";
    // else
    //     echo "La subida ha fallado";
    //     echo "<br>";

    $conexionpersona =mysqli_connect('localhost','teresa','ranateresa','universidad') ; 
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }


    mysqli_query($conexionpersona ,"INSERT INTO persona (ID,NOMBRE,APELLIDOS,TIPO,DNI,PASS,USER,FOTO ) VALUES
    (NULL,'$nombre' , '$apellidos' , 'ALUMNO', '$dni' , '$pass' , '$user' , '$archivo')");

    

    $conexionalumno = mysqli_connect('localhost','teresa','ranateresa','universidad') ; 
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }

    $grado = $_POST['grado'];
    $curso = $_POST['curso'];
    $asignaturas = $_POST['matricula'];
    $asig = implode(",", $asignaturas);
   

    mysqli_query($conexionalumno ,"INSERT INTO alumno (DNI,CURSO,GRADO,MATRICULADO) VALUES
    ('$dni' , '$curso' , '$grado' , '$asig')");

    mysqli_close($conexionalumno);
    mysqli_close($conexionpersona);

    header("Location: usuarioaniadido.php");
?>