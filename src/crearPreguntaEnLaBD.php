<?php

    session_start();
    $tema = $_POST['TEMA'];
    $enunciado = $_POST['ENUNCIADO'];
    $resp1 = $_POST['RESP1'];
    $resp2 = $_POST['RESP2'];
    $resp3 = $_POST['RESP3'];
    $resp4 = $_POST['RESP4'];
    $respCorrecta = $_POST['RESPCORRECTA'];

    $conexionAdicionPregunta = mysqli_connect('localhost','root','777303','universidad') ; 
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }

    $vector_aleatorio = [] ;
    $aleatorio = rand(100 , 500) ; // Generamos un número aleatorio que actuará como ID de las preguntas

    // Evitamos la repetición de números aleatorios
    for ( $i = 0 ; $i < count($vector_aleatorio) ; $i++ )
    {

        if ($vector_aleatorio[$i] == $aleatorio )
        {

            $aleatorio = rand(100 , 500) ;

        }

    }

    // Añadimos la pregunta a la tabla de preguntas
    $consultaAdicion = "INSERT INTO preguntas (IDPREG,ENUNCIADO,RESP1,RESP2,RESP3,RESP4,RESP) VALUES ('$aleatorio','$enunciado','$resp1','$resp2','$resp3','$resp4','$respCorrecta')" ;
    mysqli_query($conexionAdicionPregunta , $consultaAdicion) ;

    // Ahora hay que añadir la pregunta al tema en cuestión
        // Creamos una consulta que nos de todos los temas
        // Recorremos los temas buscando en el BatPregunta si no existe el ID => En ese caso la añadisos
        // Cambiamos el vector por el vector anterior + el nuevo ID de pregunta

    echo "La pregunta ha sido añadida correctamente" ;
?>