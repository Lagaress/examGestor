<?php
session_start();

$dni = $_SESSION['dni'];

//Mostrar un desplegable con los examenes disponibles para ser realizados y enlaces a ellos.


    $db = mysqli_connect('DB_SERVER','DB_USERNAME','DB_PASSWORD','DB_DATABASE') ; 
    $QueryExamenes= mysqli_query($db,'SELECT TEM, ASIG , FECHA FROM examenes WHERE FECHA >= CURDATE() ORDER BY FECHA');
    $QueryAsigs= mysqli_query($db,"SELECT ASIG FROM alumno WHERE DNI=$dni" );

    $ResulAsigs = mysqli_fetch_all($QueryAsigs);

    $Asigs = explode(',' , $ResulAsigs[0][0]);

    if($QueryExamenes) {
        while($row = mysqli_fetch_assoc($QueryExamenes)){
    
            for ( $i = 0 ; $i < count($Asigs) ; $i++ ){
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
                    if($row['FECHA'] == ''){
                        echo '<th>'.''.'</th>';
                    }else{
                        echo '<th>Link disponible el dia del examen</th>';
                    }
                    /*
                    if FECHA = CURR 
                    show link  (Link sera una concatenación de TEMASIGIDFECHA, al estar protegido por contraseña no hay problema con los IDOR)
                    */
                    echo '</tr>';
                }
            }
        }
    }

?>