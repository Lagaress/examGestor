<!DOCTYPE html>
<html>
<head>
<style>
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
<title>Examenes</title>
</head>
<body>
<h1>Examenes</h1>


<?php
session_start();

include('config.php');
$dni = $_SESSION['dni'];


    $db = mysqli_connect('DB_SERVER','DB_USERNAME','DB_PASSWORD','DB_DATABASE') ; 
    $QueryExamenes= mysqli_query($db,'SELECT TEM, ASIG , FECHA, CODEX FROM examenes WHERE FECHA >= CURDATE() ORDER BY FECHA'); //TO TEST: No dataset
    $QueryAsigs= mysqli_query($db,"SELECT ASIG FROM alumno WHERE DNI=$dni" ); //TO TEST: No dataset
    $QueryDate= mysqli_query($db," SELECT CURDATE()" ); 


    $ResulAsigs = mysqli_fetch_all($QueryAsigs); //TO TEST: No dataset
    $Asigs = explode(',' , $ResulAsigs[0][0]); //TO TEST: No dataset
    
    $Date = mysqli_fetch_row($QueryDate); //TO TEST: No dataset


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
    if($QueryExamenes) { //TO TEST: No dataset
        while($row = mysqli_fetch_assoc($QueryExamenes)){ //TO TEST: No dataset
    
            for ( $i = 0 ; $i < count($Asigs) ; $i++ ){ //TO TEST: No dataset

                if ($Asigs[$i] == $row['ASIG']){
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
                        echo '<th>'.'href"./="./calificaciones.php?Identificador='.$row['CODEX'].'"</th>'; 
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