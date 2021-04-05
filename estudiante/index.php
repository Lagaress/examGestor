<?php

session_start();

if(isset($_POST['examenes'])){
    header('location: /estudiante/examenes.php');
    exit;
}

/*if(isset($_POST['perfil'])){
    header('location: /estudiante/perfil.php'); // ADDON: Podria agregarse la opción de editar el perfil 
}*/

if(isset($_POST['calificaciones'])){
    header('location: calificaciones.php');
    exit;
}

//ADDON calendario
?>

<form action="index.php" method=post>
<button class="boton" id="examenes" type="submit" name="examenes">Realizar Examenes</button>
<button class="boton" id="calificaciones" type="submit" name="calificaciones">Ver Calificaciones</button>
</form>