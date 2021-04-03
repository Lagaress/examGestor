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
<title>Calificaciones</title>
</head>
<body>
<h1>Calificaciones</h1>

<?php
session_start();

// FEATURE: Formulario para solicitar una revisión del examen desde aquí.

$dni = $_SESSION['dni'];

$db = mysqli_connect('DB_SERVER','DB_USERNAME','DB_PASSWORD','DB_DATABASE') ; 



$QueryNota= mysqli_query($db,"SELECT CODIGO,COD_EX,NOTA FROM calificaciones WHERE ALUM_DNI=$dni" ); //TO TEST: No dataset


    echo '<table>
    <tr>
        <th>
            Asignatura
        </th>
        <th>
            Tema
        </th>
        <th>
            Nota
        </th>
        <th>
            Fecha
        </th>
    </tr>';

if($QueryNota){ //TO TEST: No dataset
    while($row = mysqli_fetch_assoc($QueryNota)){ //TO TEST: No dataset

        echo '<tr>
                <th>'
                    .$row['CODIGO'].
                '</th>
                <th>'
                    .$row['COD_EX'].                            
                '</th>
                <th>'
                    .$row['NOTA'].
                '</th>
            </tr>'; 
    }
}

echo '</table>';
?>

