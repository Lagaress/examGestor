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

    // Unimos las preguntas 
    $arr = array( $resp1, $resp2, $resp3, $resp4 ) ;
    $vector_de_preguntas = implode("," , $arr) ;

    // Añadimos la pregunta a la tabla de preguntas
    $consultaAdicion = "INSERT INTO preguntas (IDPREG,TEMAID,ENUNCIADO,RESPONSES,CORRECTA) VALUES ('$aleatorio','$tema','$enunciado','$vector_de_preguntas','$respCorrecta')" ;
    mysqli_query($conexionAdicionPregunta , $consultaAdicion) ;

    // Ahora hay que añadir la pregunta al tema en cuestión
    $consulta_obtener_batpreguntas_de_un_tema = "SELECT BATPREGUNTAS FROM temas WHERE ID='$tema'" ; // Obtenemos la batería de preguntas
    $consulta_preguntas_anterior_a_la_adicion = mysqli_query($conexionAdicionPregunta, $consulta_obtener_batpreguntas_de_un_tema) ; // Lanzamos la consulta
    $array_preguntas = mysqli_fetch_array($consulta_preguntas_anterior_a_la_adicion) ; // Lo hacemos vector
    array_push($array_preguntas, $aleatorio) ; // Añadimos el nuevo ID de pregunta 
    $array_preguntas_separadas = $array_preguntas[0].','.$array_preguntas[1] ; // Concatenamos para crear el vector de preguntas a insertar
    $consulta_modificar_tema = "UPDATE temas SET BATPREGUNTAS='$array_preguntas_separadas' WHERE ID='$tema'" ; // Creamos la consulta
    mysqli_query($conexionAdicionPregunta, $consulta_modificar_tema) ; // Lanzamos la consulta
    
    echo "La pregunta ha sido añadida correctamente" ;
?>