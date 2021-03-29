<?php

session_start();

if(isset($_POST['examenes'])){
    header('location: /estudiante/examenes.php');
}

if(isset($_POST['perfil'])){
    header('location: /estudiante/perfil.php');
}

if(isset($_POST['calificaciones'])){
    header('location: /estudiante/calificaciones.php');
}
?>


