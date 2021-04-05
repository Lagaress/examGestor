<?php 

    session_start();

    $_SESSION['nopass']='nopass';

    header("Location: ../CRUDProfesor.php");

?>