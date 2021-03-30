<?php 
    $dni = $_POST['dni'];

    echo "Estas seguro de que quieres eliminar al usuario con DNI: ".$dni;
    
    echo "<form method=\"POST\" enctype=\"multipart/form-data\" action=\"./eliminadoProf.php\" >
            <input type=\"radio\" name=\"elec\" value=\"si\">SI
            <input type=\"radio\" name=\"elec\" value=\"no\">NO
            <input type=\"hidden\" name=\"dni\" value=\"".$dni."\">
            <input type=\"submit\" value=\"Enviar decision\">

        </form>";

?>
