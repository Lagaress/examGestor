<?php 
session_start();
    $nombresesion = $_SESSION['nombre'];
    $apellsesion = $_SESSION['apellidos'];
    $fotosesion = $_SESSION['foto'];
    if($nombresesion ==null || $apellsesion==null){
        echo "no hay autorizacion";
        die();
    }

 ?>



<!DOCTYPE html>
<html>
<head>
    <meta content="charset=utf-8" />
    <title>PanelProfesor</title>
    <link href="../templates/panelprofesor.css" rel="stylesheet" type="text/css">

</head>
<body>
    <h1 style="column-span: all; text-align: center">Panel de control del Profesor: <?php echo $nombresesion." ".$apellsesion ?></h1>
    <br></br>

        <table style="text-align: center;">
            <tr> 
                <th>
                    <a href="" class="gestionpreguntas">Gestion de preguntas</a>
                </th>
                <th>            
                    <a href="gestionResultados.php" class="gestionresultados">Gestion de resultados</a>
                </th>
                <th>
                    <?php
                    echo "<img src=\"../imgs/".$fotosesion." \" width=\"180px\" height=\"225px\" style=\"border: 1px solid; 
                    color: black;\" ><br>"?>
                </th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th>
                    <a type="button" href="cerrarsesion.php" >Cerrar sesion</a>
                </th>
            </tr>
        </table>
    


</body>
</html>

