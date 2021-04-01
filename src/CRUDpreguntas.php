<?php
$opcionDelCRUD = $_POST['opcionCRUD'];
$asignaturasProfesor = $_POST['asignaturasProfesor'];

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

// # Nos conectamos a la BD
$conexionadmin = mysqli_connect('localhost','root','777303','universidad') ; 
if (mysqli_connect_errno()) 
{
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    die();
}


// En función de la opción elegida hacemos una redirección u otra
if ($opcionDelCRUD == "crear")
{

    echo "<h1>¿Qué pregunta quieres crear?<h1>" ;


}

else if ($opcionDelCRUD == "editar")
{

    echo "<h1>¿Qué pregunta quieres editar?<h1>" ;


}

else 
{

    echo "<h1>¿Qué pregunta quieres borrar?<h1>" ;
    // Mostramos todas las preguntas
    $consulta = mysqli_query($conexionadmin , "" ;



}
?>

