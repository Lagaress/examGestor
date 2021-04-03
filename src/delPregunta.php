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

    $conexionadmin = mysqli_connect('localhost','root','777303','universidad') ; 
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }

    $consulta_eliminacion = ("DELETE from preguntas WHERE IDPREG='$pregunta'") ;
    mysqli_query($conexionadmin , $consulta_eliminacion) ;
    $consulta_comprobante = ("SELECT from preguntas WHERE IDPREG='$pregunta'") ;
    if (mysqli_query($conexionadmin , $consulta_comprobante) == NULL) 
    {

        echo "La pregunta se ha eliminado correctamente" ;

    }

    else 
    {

        echo "Hubo un error a la hora de eliminar la pregunta" ;

    }

    // Actualizamos la batería de preguntas

    $obtencion_asignaturas_de_un_profesor = "SELECT ASIGASOC from profesor where DNI='$dnisesion'" ;
    $consulta_obtencion_asignaturas = mysqli_query($conexionadmin , $obtencion_asignaturas_de_un_profesor) or die ("Problemas con la consulta") ;
    $consulta_obtencion_asignaturas_vector_unido = mysqli_fetch_array($consulta_obtencion_asignaturas);
    
    // # Ahora separamos el vector 
    $consulta_obtencion_asignaturas_vector_separado = explode(',' , $consulta_obtencion_asignaturas_vector_unido[0]) ;
    // Ahora debemos obtener los ID de los temas asociados a cada asignatura  
    for ($i = 0 ; $i < count($consulta_obtencion_asignaturas_vector_separado); $i++) // Recorremos todas las asignaturas 
    {

        // # Hacemos una consulta obteniendo el ID de los temas de cada asignatura 
        $obtencion_temas_de_una_asignatura = "SELECT IDTEMAS FROM asignaturas WHERE CODIGO = '$consulta_obtencion_asignaturas_vector_separado[$i]'" ;
        $consulta_obtencion_temas = mysqli_query($conexionadmin , $obtencion_temas_de_una_asignatura) or die ("Problemas con la consulta de obtención de temas") ;
        $consulta_obtencion_temas_vector_unido = mysqli_fetch_array($consulta_obtencion_temas);

        // # Separamos el vector
        $consulta_obtencion_temas_vector_separado = explode(',' , $consulta_obtencion_temas_vector_unido[0]) ;
        for ( $j = 0 ; $j < count($consulta_obtencion_temas_vector_separado) ; $j++ )
        {

            $pregunta_econtrada = False ;

            // # Ahora debemos obtener los ID de las preguntas de cada tema para mostrarlas
            $obtencion_preguntas_de_un_tema = "SELECT BATPREGUNTAS FROM temas WHERE ID = '$consulta_obtencion_temas_vector_separado[$j]'" ;
            $consulta_obtencion_preguntas = mysqli_query($conexionadmin , $obtencion_preguntas_de_un_tema) or die ("problemas con la consulta de obtención de preguntas") ;
            $consulta_obtencion_preguntas_vector_unido = mysqli_fetch_array($consulta_obtencion_preguntas) ;

            // # Separamos el vector
            $consulta_obtencion_preguntas_vector_separado = explode(',' , $consulta_obtencion_preguntas_vector_unido[0]) ;

            $copia_vector_batpreguntas = [] ; // Creamos un vector auxiliar vacio

            for ($k = 0 ; $k < count($consulta_obtencion_preguntas_vector_separado) ; $k++ ) // Ahora mostramos todas las preguntas ; 
            {


                if ($consulta_obtencion_preguntas_vector_separado[$k] == $pregunta) // Si la pregunta está en la batería del tema
                {

                    $pregunta_econtrada = True ; 

                }

                else 
                {

                    // Copiamos todas las preguntas que no sean la que acabamos de eliminar
                    $copia_vector_batpreguntas[$k] = $consulta_obtencion_preguntas_vector_separado[$k] ;

                }

            }

            if ($pregunta_econtrada) // Si hemos encontrado la pregunta, modificamos la batería de preguntas de este tema
            {

                $consulta_eliminar_pregunta_de_la_bateria = mysqli_query($conexionadmin , "UPDATE temas SET BATPREGUNTAS = '$copia_vector_batpreguntas' WHERE ID = '$consulta_obtencion_temas_vector_separado[$k]'");

            }

        }
 
    }

    header("Location: CRUDpreguntas.php") ;
    

?>