<?php

session_start();

if(isset($_POST['examenes'])){
    header('location: /estudiante/examenes.php');
}

/*if(isset($_POST['perfil'])){
    header('location: /estudiante/perfil.php'); // ADDON: Podria agregarse la opción de editar el perfil 
}*/

if(isset($_POST['calificaciones'])){
    header('location: /estudiante/calificaciones.php');
}

//ADDON calendario
?>


<button class="boton" id="examenes" type="submit" name="submited">Realizar Examenes</button>
<button class="boton" id="calif" type="submit" name="submited">Ver Calificaciones</button>