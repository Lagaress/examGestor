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
        header("Location: failpassadmin.php");
        die();
    }


    $directorio = '../../imgs/';
    $archivo = basename($_FILES['archivo']['name']);
    if( $archivo == NULL)
        $archivo = "default.jpg";
    $subir_archivo = $directorio.$archivo;

    if(move_uploaded_file($_FILES['archivo']['tmp_name'], $subir_archivo))
        echo "El archivo es válido y se cargó correctamente.<br><br>";
    // else
    //     echo "La subida ha fallado";
    //     echo "<br>";

    $conexionadmin =  mysqli_connect('localhost','root','777303','universidad') ; 
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }


    mysqli_query($conexionadmin ,"INSERT INTO persona (ID,NOMBRE,APELLIDOS,TIPO,DNI,PASS,USER,FOTO ) VALUES
    (NULL,'$nombre' , '$apellidos' , 'ADMIN', '$dni' , '$pass' , '$user' , '$archivo')");

    

   
    mysqli_close($conexionadmin);

    header("Location: adminaniadido.php");
?>