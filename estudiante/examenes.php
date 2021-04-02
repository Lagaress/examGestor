<?php
session_start();

$dni = $_SESSION['dni'];

//Mostrar una tabla con los examenes disponibles para ser realizados y enlaces a ellos.


    $db = mysqli_connect('DB_SERVER','DB_USERNAME','DB_PASSWORD','DB_DATABASE') ; 
    $QueryExamenes= mysqli_query($db,'SELECT TEM, ASIG , FECHA FROM examenes WHERE FECHA >= CURDATE() ORDER BY FECHA');
    $QueryAsigs= mysqli_query($db,"SELECT ASIG FROM alumno WHERE DNI=$dni" );
    $QueryDate= mysqli_query($db," SELECT CURDATE()" );


    $ResulAsigs = mysqli_fetch_all($QueryAsigs);
    $Asigs = explode(',' , $ResulAsigs[0][0]);
    
    $Date = mysqli_fetch_row($QueryDate);


    echo '<table>
    <tr>
        <th>
            Asignatura
        </th>
        <th>
            Tema
        </th>
        <th>
            Fecha
        </th>
        <th>
            Link
        </th>
    </tr>

        ';
    if($QueryExamenes) {
        while($row = mysqli_fetch_assoc($QueryExamenes)){
    
            for ( $i = 0 ; $i < count($Asigs) ; $i++ ){

                if ($Asigs == $row['ASIG']){
                    echo '<tr>
                            <th>'
                                .$row['ASIG'].
                            '</th>
                            <th>'
                                .$row['TEM'].                            
                            '</th>
                            <th>'
                                .$row['FECHA'].
                            '</th>'; 
                    if($row['FECHA'] == $Date){
                        echo '<th>'.'Aquivaellinkcuandolotengamosclaro'.'</th>'; //Falta ver como poner los links
                    }else{
                        echo '<th>Link disponible el dia del examen</th>';
                    }

                    echo '</tr>';
                }
            } 
        }
    }
    echo '</table>';

?>