<?php

session_start();

$update =mysqli_connect('localhost','root','777303','universidad') ; 
if (mysqli_connect_errno()) {
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    die();
}

$valorDeLaPregunta = $_POST['IDDELAPREGUNTA'] ;
$nuevoEnunciado = $_POST['ENUNCIADO'] ;
$nuevaResp1 = $_POST['RESP1'] ;
$nuevaResp2 = $_POST['RESP2'] ;
$nuevaResp3 = $_POST['RESP3'] ;
$nuevaResp4 = $_POST['RESP4'] ;
$nuevaRespCorrecta = $_POST['RESPCORRECTA'] ;

$contadorDeCambios = 0 ; 

// Unimos las preguntas 
$arr = array( $nuevaResp1, $nuevaResp2, $nuevaResp3, $nuevaResp4 ) ;
$vector_de_preguntas = implode("," , $arr) ;

if ( !empty($nuevoEnunciado) )
{

  mysqli_query ($update , "UPDATE preguntas SET ENUNCIADO ='$nuevoEnunciado' WHERE IDPREG='$valorDeLaPregunta'" ) ;  
  $contadorDeCambios++ ;
}

if ( !empty($vector_de_preguntas) )
{

    mysqli_query ($update , "UPDATE preguntas SET RESPONSES ='$vector_de_preguntas' WHERE IDPREG='$valorDeLaPregunta'" ) ;  
    $contadorDeCambios++ ;

}

if ( !empty($nuevaRespCorrecta) )
{

    mysqli_query ($update , "UPDATE preguntas SET CORRECTA ='$nuevaRespCorrecta' WHERE IDPREG='$valorDeLaPregunta'" ) ;  
    $contadorDeCambios++ ;


}

if (   $contadorDeCambios == 0)
{

    echo "No has realizado ningún cambio" ;
    sleep (3) ;

}

else 
{

    echo "La pregunta se ha actualizado correctamente" ;
    echo 
    "
    <form action=\"../panelprofesor.php\">
    <input type=\"submit\" value=\"Volver\"/>
    </form>
    " ;


}


?>