<?php 


    $update = mysqli_connect('localhost','root', '777303', 'universidad');
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }

    $id = $_POST['ID'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $tipo = $_POST['tipo'];
    $dni = $_POST['dni'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];

    if($pass != $repass){
        session_start();
        $_SESSION['nopass']='nopass';
        header("Location: modprofesor.php");
    }
    if( $tipo != 'PROFESOR' || $tipo != 'ALUMNO' || $tipo != 'ADMIN' ){
        session_start();
        $_SESSION['notipo']='notipo';
        header("Location: modprofesor.php");
    }

    $consulta = mysqli_query($update ,"SELECT * FROM persona WHERE ID='$id'");
    $fila = mysqli_fetch_array($consulta);
    $olddni = $fila['DNI'];


    $directorio = '../../imgs/';
    $archivo = basename($_FILES['archivo']['name']);
    $subir_archivo = $directorio.$archivo;

    if(move_uploaded_file($_FILES['archivo']['tmp_name'], $subir_archivo))
        echo "El archivo es válido y se cargó correctamente.<br><br>";

    mysqli_query($update ,"UPDATE persona SET NOMBRE='$nombre' ,APELLIDOS='$apellidos' , TIPO='$tipo' , DNI='$dni', 
                        PASS='$pass' , USER='$user' , FOTO='$archivo' WHERE ID='$id' ");
    mysqli_query($update ,"UPDATE profesor SET DNI='$dni' WHERE DNI='$olddni'  ");


    mysqli_close($update);
    header("Location: ../paneladmin.php");

?>