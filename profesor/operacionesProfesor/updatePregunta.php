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
    $pregunta = $_POST['preguntaAEditar'];

    $conexionpregunta = mysqli_connect('localhost','root','777303','universidad') ; 
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }
    session_start();

    $consulta = mysqli_query($conexionpregunta, "SELECT * FROM preguntas");
    for( $i = 0 ; $i < 1 ; $i++ ){
        $fila = mysqli_fetch_array($consulta);

        if($i == 0){
            echo "<form method=\"POST\" enctype=\"multipart/form-data\" action=\"actualizarPreguntaEnLaBD.php\" > 
            <table class=\"encabezadoTablaActualizarPreguntas\" > 
            <tr class = \"Encabezados\">
            <th>ID</th>
            <th>ENUNCIADO</th>
            <th>RESP1</th>
            <th>RESP2</th>
            <th>RESP3</th>
            <th>RESP4</th>
            <th>RESPCORRECTA</th>
            </tr>";
        }
            echo  
            "<tr class=\"camposDeLaPregunta\" >
            <td> ".$pregunta." </td>
            <td> <input type=\"text\" name=\"ENUNCIADO\"  minlength=\"0\" maxlenght=\"20\" size=\"10\"></td>
            <td> <input type=\"text\" name=\"RESP1\"  minlength=\"0\" maxlenght=\"20\" size=\"10\"></td>
            <td> <input type=\"text\" name=\"RESP2\"  minlength=\"0\" maxlenght=\"20\" size=\"10\"></td>
            <td> <input type=\"text\" name=\"RESP3\"  minlength=\"0\" maxlenght=\"20\" size=\"10\"></td>
            <td> <input type=\"text\" name=\"RESP4\"  minlength=\"0\" maxlenght=\"20\" size=\"10\"></td>
            <td> <input type=\"text\" name=\"RESPCORRECTA\"  minlength=\"0\" maxlenght=\"20\" size=\"10\"></td>
            <td> <input type=\"hidden\" name=\"IDDELAPREGUNTA\" value='$pregunta'></td>
            <tr>";
    }

    echo "
    <td> <input type=\"submit\" name=\"valoresDeLaPregunta\" value=\"ENVIAR\" ></td>
    </table></form><br>";

    echo " <br>   <form action=\"../panelprofesor.php\" >
	<input type=\"submit\" value=\"Volver\" />
	</form>";



?>