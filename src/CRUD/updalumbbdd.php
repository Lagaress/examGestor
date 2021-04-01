<?php 
    session_start();
    $_SESSION['nopass']=" ";
   


    $update = mysqli_connect('localhost','teresa','ranateresa','universidad') ; 
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }

    $id = $_POST['ID'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];
    $curso = $_POST['curso'];
    $grado = $_POST['grado'];


    if($pass!=$repass){
        $_SESSION['nopass']='nopass';
        header("Location:modalumno.php");
        die();
    }

    $consulta = mysqli_query($update ,"SELECT * FROM persona WHERE ID='$id'");
    $fila = mysqli_fetch_array($consulta);
    $olddni = $fila['DNI'];


    $directorio = '../../imgs/';

    $archivo = basename($_FILES['archivo']['name']);

    if($archivo==NULL)
        $archivo='default.jpg';
    $subir_archivo = $directorio.$archivo;



    if(move_uploaded_file($_FILES['archivo']['tmp_name'], $subir_archivo))
        echo "El archivo es válido y se cargó correctamente.<br><br>";

    mysqli_query($update ,"UPDATE persona SET NOMBRE='$nombre',APELLIDOS='$apellidos', DNI='$dni', 
                        PASS='$pass', USER='$user', FOTO='$archivo' WHERE ID='$id'");
    mysqli_query($update ,"UPDATE alumno SET DNI='$dni', CURSO='$curso', GRADO='$grado' WHERE DNI='$olddni'");


    mysqli_close($update);
    header("Location: ../paneladmin.php");

?>