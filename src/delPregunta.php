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

    // Ahora la eliminamos de la BATERIADEPREGUNTAS
    $consulta_obtencion_tema = "SELECT TEMAID from preguntas WHERE IDPREG='$pregunta'" ;
    // Lanzamos la consulta para obtener el TemaID
    $tema = mysqli_query($conexionadmin , $consulta_obtencion_tema) ;
    $tema_vector = mysqli_fetch_array($tema) ;

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

    // Consulta obtener bateria de preguntas
    $consulta_otener_vector_preguntas = "SELECT BATPREGUNTAS from temas WHERE ID='$tema_vector[0]'" ;
    $vector_preguntas = mysqli_fetch_array(mysqli_query($conexionadmin , $consulta_otener_vector_preguntas)) ;
    $vector_preguntas_separado = explode("," , $vector_preguntas[0]) ;
    $string_vacio = " " ;
    $vector_vacio = array() ;
    for ($i = 0 ; $i < count($vector_preguntas_separado) ; $i++)
    {

        if ($vector_preguntas_separado[$i] != $pregunta)
        {

            
            array_push($vector_vacio , $vector_preguntas_separado[$i]) ;
            $string_vacio = $vector_vacio.$vector_preguntas_separado[$i] ;

        }

    }
    $vector_update = implode("," , $vector_vacio) ;
    $consulta_modificar_tema = "UPDATE temas SET BATPREGUNTAS='$string' WHERE ID='$tema_vector[0]'" ; // Creamos la consulta
    mysqli_query($conexionAdicionPregunta, $consulta_modificar_tema) ; // Lanzamos la consulta

    echo " <br>   <form action=\"./panelprofesor.php\" >
    <input type=\"submit\" value=\"Volver\" />
    </form>";

    //header("Location: CRUDpreguntas.php") ;
    

?>