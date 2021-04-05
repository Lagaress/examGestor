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
include('config.php');

// FEATURE: Formulario para solicitar una revisión del examen desde aquí.

$dni = $_SESSION['dni'];

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) ; 


$result= mysqli_query($db,"SELECT CODIGO,COD_EX,NOTA FROM calificaciones WHERE ALUM_DNI='$dni'" ); 
 


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
    </tr>';

    while($row = mysqli_fetch_assoc($result)){

        $codigo = $row['CODIGO'];
        $QUERYASIG= mysqli_query($db,"SELECT ASIG FROM examenes WHERE CODEX='$codigo' LIMIT 1" ); 
 
        $AsigName = mysqli_fetch_array($QUERYASIG)[0];

        echo '<tr>
                <th>'
                    .$AsigName.
                '</th>
                <th>'
                    .$row['COD_EX'].                            
                '</th>
                <th>'
                    .$row['NOTA'].
                '</th>
            </tr>'; 
    }


echo '</table>';
echo "<form action=\"./panelalumno.php\" >
<input type=\"submit\" value=\"Volver\" />
</form>";
?>

