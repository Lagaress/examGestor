<?php
session_start();

//Consulta a la BD para ver las calificaciones del alumno tal , y devolución en forma de tablas
// ADD: Formulario para solicitar una revisión del examen desde aquí.

$dni = $_SESSION['dni'];
$db = mysqli_connect('DB_SERVER','DB_USERNAME','DB_PASSWORD','DB_DATABASE') ; 

$QueryNota= mysqli_query($db,"SELECT CODIGO,COD_EX,NOTA FROM calificaciones WHERE ALUM_DNI=$dni" );


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
        Fecha
    </tr>';

if($QueryNota){
    while($row = mysqli_fetch_assoc($QueryNota)){
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

