<?php

session_start();
$dni = $_SESSION['dni'];
$id=$_GET['Identificador'];
$nota=0;
include('config.php');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) ; 


if (isset($_GET['Identificador'])){

    $result = mysqli_query($db,"SELECT * FROM calificaciones WHERE COD_EX='$id' AND ALUM_DNI='$dni'");
	$result = mysqli_fetch_array($result,MYSQLI_BOTH);

    if(!(bool)$result){

        #mysqli_query($db ,"INSERT INTO calificaciones (ALUM_DNI,COD_EX,NOTA ) VALUES ('$dni' , '$id' , '$nota')");
        $QueryNumPreg= mysqli_query($db,"SELECT NUM_PREG FROM examenes WHERE CODEX='$id'" );
        $NumPreg = mysqli_fetch_array($QueryNumPreg)[0];

        $QueryTemas = mysqli_query($db, "SELECT TEM FROM examenes WHERE CODEX='$id'" );
        $Temas = mysqli_fetch_array($QueryTemas)[0];

        $ArrayTemas = explode(',' , $Temas[0][0]);

        $TemasID = " TEMAID='".$ArrayTemas[0]."'";

        for ( $i = 1 ; $i < count($ArrayTemas) ; $i++ ){ //TO TEST Probar con varios temas x examen
            $TemasID = $TemasID." OR TEMAID='".$ArrayTemas[$i]."'";
        }

        $QueryPregs = mysqli_query($db,"SELECT IDPREG,ENUNCIADO,RESPONSES FROM preguntas WHERE $TemasID ORDER BY RAND() LIMIT $NumPreg");
        
        echo '<form method=post action="hacerexamen.php">';
        $j=0;
        while($row = mysqli_fetch_assoc($QueryPregs))
        {   
            $preg[$j] = $row['IDPREG'];
            mysqli_query($db ,"INSERT INTO respuestas  (ID_PREG,ALUM_DNI,COD_EX ) VALUES ( $preg[$j], '$dni' , '$id')");

            echo '<b>'.($j+1).'. '.$row['ENUNCIADO'].'</b>'; 
            $ArrayResp = explode(',' , $row['RESPONSES']);   
            for ( $i = 0 ; $i < count($ArrayResp) ; $i++ ){
                echo '<br> &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name=response['.$j.']'." value='".$ArrayResp[$i],"' />".$ArrayResp[$i]; 
            }
            echo '<br>';
            $j++;
        }
        echo '<button class="boton" id="responses" type="submit" name="submited">Guardar Respuestas</button>';
        echo '</form>';
    }
}

if(isset($_POST['Submit'])){
    $response = $_POST['response'];
    
    $QueryNumPreg= mysqli_query($db,"SELECT NUM_PREG FROM examenes WHERE CODEX='$id'" );
    $NumPreg = mysqli_fetch_array($QueryNumPreg)[0];

    for ( $i = 0 ; $i < count($response) ; $i++ ){
        mysqli_query($db ,"UPDATE respuestas  SET RESPALUMN='$response[$i]' WHERE ID_PREG='$preg[$i]' AND ALUM_DNI='$dni' AND COD_EX='$id' ");
        $result = mysqli_query($db,"SELECT * FROM preguntas WHERE IDPREG='$preg[$i]' AND CORRECTA='$response[$i]' " );
        if( mysqli_num_rows($result)){
            $Nota += 10/$NumPreg;
        }
    }

    mysqli_query($db ,"UPDATE calificaciones SET NOTA=$nota WHERE ALUM_DNI='$dni' AND COD_EX='$id'");

    header('location: /estudiante/examenes.php');
    exit;
}

?>