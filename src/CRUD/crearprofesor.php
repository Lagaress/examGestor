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
        header("Location: failpassprof.php");
        die();
    }else
        $_SESSION['nopass']='';


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

    $conexionpersona = mysqli_connect('localhost','teresa','ranateresa','universidad') ; 
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }


    mysqli_query($conexionpersona ,"INSERT INTO persona (ID,NOMBRE,APELLIDOS,TIPO,DNI,PASS,USER,FOTO ) VALUES
    (NULL,'$nombre' , '$apellidos' , 'PROFESOR', '$dni' , '$pass' , '$user' , '$archivo')");

    

    $conexionprof = mysqli_connect('localhost','teresa','ranateresa','universidad') ; 
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }


    $imparte = $_POST['matricula'];
    $imp = implode(",", $imparte);
   

    mysqli_query($conexionprof ,"INSERT INTO profesor (ASIGASOC,DNI) VALUES
    ('$imp','$dni' )");

    mysqli_close($conexionprof);
    mysqli_close($conexionpersona);

    header("Location: profaniadido.php");
?>