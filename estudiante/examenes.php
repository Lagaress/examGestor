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


    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) ; 

    $QueryExamenes= mysqli_query($db,'SELECT TEM, ASIG , FECHA, CODEX FROM examenes WHERE FECHA >= CURDATE() ORDER BY FECHA'); 
    $QueryAsigs= mysqli_query($db,"SELECT MATRICULADO FROM alumno WHERE DNI='$dni'" );
    $QueryDate= mysqli_query($db," SELECT CURDATE()" ); 


    $ResulAsigs = mysqli_fetch_all($QueryAsigs); 
    $Asigs = explode(',' , $ResulAsigs[0][0]); 
    
    $Date = mysqli_fetch_array($QueryDate)[0]; 

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
                        echo '<th>'.'<a href="./hacerexamen.php?Identificador='.$row['CODEX'].'">Link</a></th>'; 
                    }else{
                        echo '<th>Link disponible el dia del examen</th>';
                    }

                    echo '</tr>';
                }
            } 
        }
    }
    echo '</table>';
    echo "<form action=\"./panelalumno.php\" >
    <input type=\"submit\" value=\"Volver\" />
    </form>";

?>