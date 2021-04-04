<?php

session_start();
$dni = $_SESSION['dni'];
$id=$_GET['Identificador'];
$nota=0;
include('config.php');
$db = mysqli_connect('DB_SERVER','DB_USERNAME','DB_PASSWORD','DB_DATABASE') ;

if(isset($_POST['Submit'])){
    $response = $_POST['response'];
    
    for ( $i = 0 ; $i < count($response) ; $i++ ){
        mysqli_query($db ,"UPDATE respuestas  SET RESPALUMN=$response[$i] WHERE ID_PREG=$preg[$i] AND ALUM_DNI=$dni AND COD_EX=$id ");
    }

    //TO DO query para calcular las notas
    mysqli_query($db ,"UPDATE calificaciones SET NOTA=$nota WHERE ALUM_DNI=$dni AND COD_EX=$id");

    header('location: /estudiante/examenes.php');
    exit;
}


if (isset($_GET['Identificador'])){


    $result = mysqli_query($db,"SELECT * FROM calificaciones WHERE COD_EX=$id AND ALUM_DNI=$dni");
	$result = mysqli_fetch_array($result,MYSQLI_BOTH);

    if(!(bool)$result){
        mysqli_query($db ,"INSERT INTO calificaciones  (CODIGO,ALUM_DNI,COD_EX,NOTA ) VALUES
        (NULL,'$dni' , '$id' , '$nota')");
        $QueryNumPreg= mysqli_query($db,"SELECT NUM_PREG FROM examenes WHERE CODEX=$id" );
        $NumPreg = mysqli_fetch_row($QueryNumPreg);

        $QueryTemas = mysqli_query($db, "SELECT TEM FROM examenes WHERE CODEX=$id" );
        $Temas = mysqli_fetch_row($QueryTemas);

        $ArrayTemas = explode(',' , $Temas[0][0]);

        $NumPreg = 'TEMAID='.$ArrayTemas[0];

        for ( $i = 1 ; $i < count($ArrayTemas) ; $i++ ){
            $NumPreg = $NumPreg.' OR TEMAID='.$ArrayTemas[$i];
        }


        $QueryPregs = mysqli_query($db,"SELECT IDPREG,ENUNCIADO,RESPONSES FROM preguntas WHERE $Temas ORDER BY RAND() LIMIT $NumPreg");
        
        echo '<form method=post action="hacerexamen.php">';
        $j=0;
        while($row = mysqli_fetch_assoc($QueryPregs)){
            $preg[$j] = $row.['IDPREG'];
            mysqli_query($db ,"INSERT INTO respuestas  (ID_PREG,ALUM_DNI,COD_EX,RESPALUMN ) VALUES (NULL,'$dni' , '$id' , NULL)");

            echo $row.['ENUNCIADO']; 
            $ArrayResp = explode(',' , $QueryPregs['RESPONSES'][0][0]);   
            for ( $i = 0 ; $i < count($ArrayResp) ; $i++ ){
                echo '<input type="radio" name=response['.$j.']'." value='".$ArrayResp[$i],"' />".$ArrayResp[$i]; 
            }
            $j++;
        }
        echo '<button class="boton" id="responses" type="submit" name="submited">Iniciar Sesión</button>';
        echo '</form>';
    }
}


?>