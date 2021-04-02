<?php 

    // INICIALIZAMOS LA SESIÓN
    session_start();
    $nombresesion = $_SESSION['nombre'];
    $apellsesion = $_SESSION['apellidos'];
    $fotosesion = $_SESSION['foto'];
    $dnisesion = $_SESSION['dni'];
    if($nombresesion ==null || $apellsesion==null){
        echo "no hay autorizacion"; 
        die();
    }

    // Recibimos la pregunta envíada por el 
    $pregunta = $_POST['preguntaAEliminar'];

    $conexionpersona = mysqli_connect('localhost','root','777303','universidad') ; 
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }

    $consulta_eliminacion = ("DELETE from preguntas WHERE IDPREG='$pregunta'") ;
    mysqli_query($conexionpersona , $consulta_eliminacion) ;
    $consulta_comprobante = ("SELECT from preguntas WHERE IDPREG='$pregunta'") ;
    if (mysqli_query($conexionpersona , $consulta_comprobante) == NULL) 
    {

        echo "La pregunta se ha eliminado correctamente" ;

    }

    else 
    {

        echo "Hubo un error a la hora de eliminar la pregunta" ;

    }

    // AHORA TENGO QUE HACER QUE ESE NUMERO SE QUITE DE SU ZONA DE BATPREGUNTAS DE TEMAS


    header("Location: CRUDpreguntas.php") ;
    

?>