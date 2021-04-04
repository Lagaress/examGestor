<!DOCTYPE html>
<html>
<head>
    <meta content="charset=utf-8" />
    <title>Gestión de Preguntas</title>

</head>
<body>
    <h1 style="column-span: all; text-align: center">Gestión de Preguntas del Profesor</h1>
    <br></br>
    <h2 style="column-span: all; text-align: center">¿Qué asignatura quieres seleccionar</h2> 
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

        // HACEMOS QUE EL PROFESOR SELECCIONE UNA DE SUS ASIGNATURAS
        // # Nos conectamos a la BD
        $conexionadmin = mysqli_connect('localhost','root','777303','universidad') ; 
        if (mysqli_connect_errno()) 
        {
            printf("Conexión fallida: %s\n", mysqli_connect_error());
            die();
        }

        // # Creamos la consulta para obtener las asignaturas del profesor
        $consulta = mysqli_query($conexionadmin , "SELECT ASIGASOC FROM profesor WHERE DNI = '$dnisesion' ") or die ("Problemas con la consulta") ;

        $fila = mysqli_fetch_all($consulta);

        // # Separamos las asignaturas que están  entre comas
        $arrayAsignaturas = explode(',' , $fila[0][0]) ;        

        // CREAMOS LA SELECCIÓN MÚLTIPLE DE LAS ASIGNATURAS => PASAMOS LOS DATOS POR POST
        echo "<form name=\"seleccionAsignaturasPreguntas\" method=\"POST\" action=\"CRUDpreguntas.php\">
              <select name='asignaturasProfesor'>" ;

        for ( $i = 0 ; $i < count($arrayAsignaturas) ; $i++ )
        {
            if($arrayAsignaturas[$i]!='')
            echo "<option>".$arrayAsignaturas[$i]."</option>" ; 

        }
        echo "</select>" ;

        // LE DAMOS LAS OPCIONES DE ACCIÓN SOBRE UNA DE SUS ASIGNATURAS
        echo "
            <input type=\"radio\" name=\"opcionCRUD\" value=\"crear\">Crear
            <input type=\"radio\" name=\"opcionCRUD\" value=\"editar\">Editar
            <input type=\"radio\" name=\"opcionCRUD\" value=\"borrar\">Borrar
            <input type=\"submit\" />
        </form>
            " ;

            echo " <br>   <form action=\"./panelprofesor.php\" >
            <input type=\"submit\" value=\"Volver\" />
            </form>";
    
    ?>

</body>
</html>

