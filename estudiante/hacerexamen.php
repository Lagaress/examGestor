<?php

session_start();

include('config.php');
$db = mysqli_connect('DB_SERVER','DB_USERNAME','DB_PASSWORD','DB_DATABASE') ;

if(isset($_POST['Submit'])){


    //TODO Comprobacion de preguntas correctas
    //TODO Insercción de nota
    //TODO Redirect
}


if (isset($_GET['Identificador'])){

    $id=$_GET['Identificador'];

    //TODO Consulta comprobando que no este haciendo de nuevo el examen

    $QueryNumPreg= mysqli_query($db,"SELECT NUM_PREG FROM examenes WHERE CODEX=$id" );
    $NumPreg = mysqli_fetch_row($QueryNumPreg);

    $QueryTemas = mysqli_query($db, "SELECT TEM FROM examnes WHERE CODEX=$id" );
    $NumPreg = mysqli_fetch_row($QueryNumPreg);

    $QueryPregs = mysqli_query($db,"SELECT ENUNCIADO,RESPONSES FROM preguntas WHERE $Temas ORDER BY RAND() LIMIT $NumPreg"); // Falta coger los id de los temas que entren en el examen

    //TODO Construcción de las pregunta en función del numero de respuestas 

}


?>