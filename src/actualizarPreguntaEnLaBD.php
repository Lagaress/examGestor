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

if ( !empty($nuevoEnunciado) )
{

  mysqli_query ($update , "UPDATE preguntas SET ENUNCIADO ='$nuevoEnunciado' WHERE IDPREG='$valorDeLaPregunta'" ) ;  
  $contadorDeCambios++ ;
}

if ( !empty($nuevaResp1) )
{

    mysqli_query ($update , "UPDATE preguntas SET RESP1 ='$nuevaResp1' WHERE IDPREG='$valorDeLaPregunta'" ) ;  
    $contadorDeCambios++ ;


}

if ( !empty($nuevaResp2) )
{

    mysqli_query ($update , "UPDATE preguntas SET RESP2 ='$nuevaResp2' WHERE IDPREG='$valorDeLaPregunta'" ) ;  
    $contadorDeCambios++ ;


}

if ( !empty($nuevaResp3) )
{

    mysqli_query ($update , "UPDATE preguntas SET RESP3 ='$nuevaResp3' WHERE IDPREG='$valorDeLaPregunta'" ) ;  
    $contadorDeCambios++ ;


}

if ( !empty($nuevaResp4) )
{

    mysqli_query ($update , "UPDATE preguntas SET RESP4 ='$nuevaResp4' WHERE IDPREG='$valorDeLaPregunta'" ) ;  
    $contadorDeCambios++ ;


}

if ( !empty($nuevaRespCorrecta) )
{

    mysqli_query ($update , "UPDATE preguntas SET RESP ='$nuevaRespCorrecta' WHERE IDPREG='$valorDeLaPregunta'" ) ;  
    $contadorDeCambios++ ;


}

if (   $contadorDeCambios == 0)
{

    echo "No has realizado ningún cambio" ;
    sleep (3) ;

}


?>