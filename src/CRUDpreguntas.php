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

    $vector_almacenamiento_preguntas = [] ; // Creamos un array vacío para almacenar las preguntas de un futuro

    echo "<h1>¿Qué pregunta quieres borrar?<h1>" ;

        // # Hacemos una consulta obteniendo el ID de los temas de cada asignatura 
        $obtencion_temas_de_una_asignatura = "SELECT IDTEMAS FROM asignaturas WHERE CODIGO = '$asignaturasProfesor'" ;
        $consulta_obtencion_temas = mysqli_query($conexionadmin , $obtencion_temas_de_una_asignatura) or die ("Problemas con la consulta de obtención de temas") ;
        $consulta_obtencion_temas_vector_unido = mysqli_fetch_array($consulta_obtencion_temas);

        // # Separamos el vector
        $consulta_obtencion_temas_vector_separado = explode(',' , $consulta_obtencion_temas_vector_unido[0]) ;
        for ( $j = 0 ; $j < count($consulta_obtencion_temas_vector_separado) ; $j++ )
        {

            // # Ahora debemos obtener los ID de las preguntas de cada tema para mostrarlas
            $obtencion_preguntas_de_un_tema = "SELECT BATPREGUNTAS FROM temas WHERE ID = '$consulta_obtencion_temas_vector_separado[$j]'" ;
            $consulta_obtencion_preguntas = mysqli_query($conexionadmin , $obtencion_preguntas_de_un_tema) or die ("problemas con la consulta de obtención de preguntas") ;
            $consulta_obtencion_preguntas_vector_unido = mysqli_fetch_array($consulta_obtencion_preguntas) ;

            // # Separamos el vector
            $consulta_obtencion_preguntas_vector_separado = explode(',' , $consulta_obtencion_preguntas_vector_unido[0]) ;

            for ($k = 0 ; $k < count($consulta_obtencion_preguntas_vector_separado) ; $k++ ) // Ahora mostramos todas las preguntas ; 
            {

                // Añadimos las preguntas a un vector para mostrarlas posteriormente fuera del ambito del for
                $vector_almacenamiento_preguntas[$k] = $consulta_obtencion_preguntas_vector_separado[$k] ;
                
                $obtencion_preguntas_teniendo_el_id = "SELECT * FROM preguntas WHERE IDPREG = '$consulta_obtencion_preguntas_vector_separado[$k]'" ; 
                $consulta_mostrar_preguntas = mysqli_query($conexionadmin , $obtencion_preguntas_teniendo_el_id) ;
                $numcol = mysqli_num_rows($consulta_mostrar_preguntas) ;

                // Mostramos todas las preguntas
                for ( $l = 0 ; $l < $numcol ; $l++ )
                {

                    $fila = mysqli_fetch_array($consulta_mostrar_preguntas);
                        
                    if($i == 0) // Mostramos los encabezados
                    {
                        echo " <table class=\"encabezadoTablaPreguntas\" > 
                        <tr class = \"titulosMostrarPreguntas\">
                            <th>IDPREGUNTA</th>
                            <th>ENUNCIADO</th>
                            <th>RESPUESTA1</th>
                            <th>RESPUESTA2</th>
                            <th>RESPUESTA3</th>
                            <th>RESPUESTA4</th>
                            <th>RESPUESTACORRECTA</th>
                        </tr>";
                    }

                    echo  # Mostramos la tabla
                        "<tr class=\"filasVerCalificaciones\" >
                        <td> ".$fila['IDPREG']." </td>
                        <td> ".$fila['ENUNCIADO']." </td>
                        <td> ".$fila['RESP1']." </td>
                        <td> ".$fila['RESP2']." </td>
                        <td> ".$fila['RESP3']." </td>
                        <td> ".$fila['RESP4']." </td>
                        <td> ".$fila['RESP']." </td>
                        ";
                    echo "<tr>";

                }

            }

        }
 
    

    echo "<form name=\"seleccionarPreguntaParaEliminar\" method=\"POST\" action=\"delPregunta.php\">
    <select name='preguntaAEliminar'>" ;
    for ($m = 0 ; $m < count($vector_almacenamiento_preguntas) ; $m++ )
    {

        echo "<option>".$vector_almacenamiento_preguntas[$m]."</option>"; 

    }
    echo "
    </select>
    <input type=\"submit\" />
    " ;
    

    /*
    // Pasamos la pregunta a eliminar por post 
    echo "
    <form method=\"POST\" enctype=\"multipart/form-data\" action=\"delPregunta.php\" > 
    <td> <input type=\"text\" name=\"preguntaAEliminar\" placeholder=\"Eliminar\"  >
    <input type=\"submit\" value=\"Eliminar\" placeholder=\"Eliminar\"  >
    </form> 
    " ; 
*/


}
?>

