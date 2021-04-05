<!DOCTYPE html>
<html>
<head>
<style>
h1 {
    color: black ;
    font-family: fantasy;
    text-align: center ; 
    font-size: 30px ; 
    
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

</style>
<title>Editar Preguntas</title>
</head>
<body>


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

    echo "<h1 class=\"tituloPagina\">¿Qué pregunta quieres crear?<h1>" ;
    
    $obtencion_temas_de_una_asignatura = "SELECT IDTEMAS FROM asignaturas WHERE CODIGO = '$asignaturasProfesor'" ;
    $consulta_obtencion_temas = mysqli_query($conexionadmin , $obtencion_temas_de_una_asignatura) or die ("Problemas con la consulta de obtención de temas") ;
    $consulta_obtencion_temas_vector_unido = mysqli_fetch_array($consulta_obtencion_temas);

    $consulta_obtencion_temas_vector_separado = explode(',' , $consulta_obtencion_temas_vector_unido[0]) ;
    
    echo 
    "
    <form method=\"POST\" enctype=\"multipart/form-data\" action=\"crearPreguntaEnLaBD.php\">
        <table style=\"text-align: center;\">
            <tr>
            <th>
                <br>Datos de la pregunta: <br>
                <input style=\"width: 500px;\" type=\"text\" name=\"ENUNCIADO\" placeholder=\"Enunciado\"  required><br>
                <input style=\"width: 500px;\" type=\"text\" name=\"RESP1\" placeholder=\"Respuesta1\"  required><br>
                <input style=\"width: 500px;\" type=\"text\" name=\"RESP2\" placeholder=\"Respuesta2\"  required><br>
                <input style=\"width: 500px;\" type=\"text\" name=\"RESP3\" placeholder=\"Respuesta3\"  required><br>
                <input style=\"width: 500px;\" type=\"text\" name=\"RESP4\" placeholder=\"Respuesta4\"  required><br>
                <input style=\"width: 500px;\" type=\"text\" name=\"RESPCORRECTA\" placeholder=\"Respuesta Correcta\"  ><br>
                <p>Tema asociado</p>
                <select name ='TEMA'>";
                for ($i = 0 ; $i < count($consulta_obtencion_temas_vector_separado) ; $i++)
                {

                    echo "<option>$consulta_obtencion_temas_vector_separado[$i]</option>" ;

                }
                echo "</select>
                <input type=\"submit\" value=\"Crear Pregunta\" />
            <th>
            </tr>
        </table>    
    </form>
    " ;


    

    echo " <br>   <form action=\"./panelprofesor.php\" >
        <input type=\"submit\" value=\"Volver\" />
        </form>";

}

else if ($opcionDelCRUD == "editar")
{

    echo "<h1>¿Qué pregunta quieres editar?<h1>" ;

    // # Hacemos una consulta obteniendo el ID de los temas de cada asignatura 
    $obtencion_temas_de_una_asignatura = "SELECT IDTEMAS FROM asignaturas WHERE CODIGO = '$asignaturasProfesor'" ;
    $consulta_obtencion_temas = mysqli_query($conexionadmin , $obtencion_temas_de_una_asignatura) or die ("Problemas con la consulta de obtención de temas") ;
    $consulta_obtencion_temas_vector_unido = mysqli_fetch_array($consulta_obtencion_temas);

    // Mostramos los encabezados de la tabla
    echo " 
    <form method=\"POST\" enctype=\"multipart/form-data\" action=\"updatePregunta.php\" > 
    <table class=\"encabezado\
    <table class=\"encabezadoTablaPreguntas\" > 
                    <tr class = \"titulosMostrarPreguntas\">
                        <th>IDPREGUNTA</th>
                        <th>ENUNCIADO</th>
                        <th>RESPUESTA1</th>
                        <th>RESPUESTA2</th>
                        <th>RESPUESTA3</th>
                        <th>RESPUESTA4</th>
                        <th>RESPUESTACORRECTA</th>
                    </tr>";

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
            
            $obtencion_preguntas_teniendo_el_id = "SELECT * FROM preguntas WHERE IDPREG = '$consulta_obtencion_preguntas_vector_separado[$k]'" ; 
            $consulta_mostrar_preguntas = mysqli_query($conexionadmin , $obtencion_preguntas_teniendo_el_id) ;
            $numcol = mysqli_num_rows($consulta_mostrar_preguntas) ;

            // Mostramos todas las preguntas
            for ( $l = 0 ; $l < $numcol ; $l++ )
            {

                $fila = mysqli_fetch_array($consulta_mostrar_preguntas);

                $vector_preguntas = explode("," , $fila['RESPONSES']) ;

                $id = $fila['IDPREG'] ;

                echo  # Mostramos la tabla
                    "<tr class=\"filasVerCalificaciones\" >
                    <td> ".$fila['IDPREG']." </td>
                    <td> ".$fila['ENUNCIADO']." </td>
                    <td> ".$vector_preguntas[0]." </td>
                    <td> ".$vector_preguntas[1]." </td>
                    <td> ".$vector_preguntas[2]." </td>
                    <td> ".$vector_preguntas[3]." </td>
                    <td> ".$fila['CORRECTA']." </td>
                    <td>
                            <input type=\"hidden\" name=\"preguntaAEditar\" value=\"$id\" placeholder=\"Editar\">
                            <input type=\"submit\" value=\"Editar\" placeholder=\"Editar\">
                    </td>
                    </tr>" ;
                }

            }

        }

        echo 
        "
        </table></form>
        <form action=\"panelprofesor.php\">
        <input type=\"submit\" value=\"Volver\"/>
        </form>
        " ;

}

else 
{

    echo "<h1>¿Qué pregunta quieres borrar?<h1>" ;

        // # Hacemos una consulta obteniendo el ID de los temas de cada asignatura 
        $obtencion_temas_de_una_asignatura = "SELECT IDTEMAS FROM asignaturas WHERE CODIGO = '$asignaturasProfesor'" ;
        $consulta_obtencion_temas = mysqli_query($conexionadmin , $obtencion_temas_de_una_asignatura) or die ("Problemas con la consulta de obtención de temas") ;
        $consulta_obtencion_temas_vector_unido = mysqli_fetch_array($consulta_obtencion_temas);

        // Mostramos los encabezados de la tabla
        echo " 
        <form method=\"POST\" enctype=\"multipart/form-data\" action=\"delPregunta.php\" > 
        <table class=\"encabezado\
        <table class=\"encabezadoTablaPreguntas\" > 
                        <tr class = \"titulosMostrarPreguntas\">
                            <th>IDPREGUNTA</th>
                            <th>ENUNCIADO</th>
                            <th>RESPUESTA1</th>
                            <th>RESPUESTA2</th>
                            <th>RESPUESTA3</th>
                            <th>RESPUESTA4</th>
                            <th>RESPUESTACORRECTA</th>
                        </tr>";

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
                
                $obtencion_preguntas_teniendo_el_id = "SELECT * FROM preguntas WHERE IDPREG = '$consulta_obtencion_preguntas_vector_separado[$k]'" ; 
                $consulta_mostrar_preguntas = mysqli_query($conexionadmin , $obtencion_preguntas_teniendo_el_id) ;
                $numcol = mysqli_num_rows($consulta_mostrar_preguntas) ;

                // Mostramos todas las preguntas
                for ( $l = 0 ; $l < $numcol ; $l++ )
                {

                    $fila = mysqli_fetch_array($consulta_mostrar_preguntas);

                    $vector_preguntas = explode("," , $fila['RESPONSES']) ;

                    $id = $fila['IDPREG'] ;

                    echo  # Mostramos la tabla
                        "<tr class=\"filasVerCalificaciones\" >
                        <td> ".$fila['IDPREG']." </td>
                        <td> ".$fila['ENUNCIADO']." </td>
                        <td> ".$vector_preguntas[0]." </td>
                        <td> ".$vector_preguntas[1]." </td>
                        <td> ".$vector_preguntas[2]." </td>
                        <td> ".$vector_preguntas[3]." </td>
                        <td> ".$fila['CORRECTA']." </td>
                        <td>
                            <input type=\"hidden\" name=\"preguntaAEliminar\" value=\"$id\" placeholder=\"Eliminar\">
                            <input type=\"submit\" value=\"Eliminar\" placeholder=\"Eliminar\">
                        </td>
                        </tr>" ;
                }

            }

        }

        echo 
        "
        </table></form>
        <form action=\"panelprofesor.php\">
        <input type=\"submit\" value=\"Volver\"/>
        </form>
        " ;

}
?>

