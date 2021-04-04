<?php

session_start();
$dni = $_SESSION['dni'];
$id=$_GET['Identificador'];

include('config.php');
$db = mysqli_connect('DB_SERVER','DB_USERNAME','DB_PASSWORD','DB_DATABASE') ;

if(isset($_POST['Submit'])){

    while(1){
        //TODO Comprobacion de preguntas correctas e iteración para calcular nota
        mysqli_query($db ,"INSERT INTO respuestas  (ID_PREG,ALUM_DNI,COD_EX,RESPALUMN ) VALUES
        ('$preg', '$dni' , '$id' , '$resp')");
    }

    mysqli_query($db ,"INSERT INTO calificaciones  (CODIGO,ALUM_DNI,COD_EX,NOTA ) VALUES
    (NULL,'$dni' , '$id' , '$nota')");

    header('location: /estudiante/examenes.php');
    die();
}


if (isset($_GET['Identificador'])){


    $result = mysqli_query($db,"SELECT * FROM calificaciones WHERE COD_EX=$id AND ALUM_DNI=$dni");
	$result = mysqli_fetch_array($result,MYSQLI_BOTH);

    if((bool)$result){
        $QueryNumPreg= mysqli_query($db,"SELECT NUM_PREG FROM examenes WHERE CODEX=$id" );
        $NumPreg = mysqli_fetch_row($QueryNumPreg);

        $QueryTemas = mysqli_query($db, "SELECT TEM FROM examenes WHERE CODEX=$id" );
        $Temas = mysqli_fetch_row($QueryTemas);

        $ArrayTemas = explode(',' , $Temas[0][0]);

        $NumPreg = 'TEMAID='.$ArrayTemas[0];

        for ( $i = 1 ; $i < count($ArrayTemas) ; $i++ ){
            $NumPreg = $NumPreg.' OR TEMAID='.$ArrayTemas[$i];
        }


        $QueryPregs = mysqli_query($db,"SELECT ENUNCIADO,RESPONSES FROM preguntas WHERE $Temas ORDER BY RAND() LIMIT $NumPreg");
        
        echo '<form method=post action="hacerexamen.php">';
        while($row = mysqli_fetch_assoc($QueryPregs)){
            echo $row.['ENUNCIADO']; 
            $ArrayResp = explode(',' , $QueryPregs['RESPONSES'][0][0]);   
            for ( $i = 0 ; $i < count($ArrayResp) ; $i++ ){
                echo $ArrayResp[$i]; //TODO formatear esto para que sea una checkbox con solo uno seleccionable. Y se submitee el value de la respuesta
            }
        }
        echo '<button class="boton" id="responses" type="submit" name="submited">Iniciar Sesión</button>';
        echo '</form>';
    }
}


?>