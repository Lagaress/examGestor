<?php

include('config.php');

// Función para abrir la conexión 
function conectarConLaBD ($url=NULL,$user=NULL,$password=NULL) 
{

	$conexion = @mysqli_connect($url , $user , $password) ; 

	if ($conexion) // Si la conexion se establece de forma correcta => $conexion = true 
	{

		echo 'Conexion con éxito <br/>' ; 
		echo 'Información sobre el servidor:' , mysqli_get_host_info($conexion) , '<br/>' ; 
		echo 'Versión del servidor:' , mysqli_get_server_info($conexion) , '<br/>' ; 

		$ok = mysqli_select_db($conexion,'exam_gestor') ; 

		if ($ok)
		{

			echo 'La base de datos ha sido seleccionada. <br/>' ;

		}

		else 
		{

			echo 'Error al selecionar la base de datos' ;

		}

		// Hacemos la consulta a la BD

		$consulta = mysqli_query($conexion , 'SELECT * FROM usuarios') ; 
		if ($consulta === FALSE)
		{

			echo 'La consulta ha fallado. <br/>' ;


		}

		else 
		{

			echo 'El numero de usuarios en la BD es: ' , mysqli_num_rows($consulta) , '<br/>' ; 


		}

	}

	else 
	{

		echo 'Error de conexión' , mysqli_connect_errno() , mysqli_connect_error () , '<br/>'; 

	}

	return $conexion ; 

}

// Funcion para cerrar la conexión
function desconectarLaBD ($conexion)
{

	if ($conexion)
	{

		$ok = @mysqli_close($conexion) ;

		if ($ok)
		{

			echo 'Desconexión realizada con éxito. <br/>' ; 

		}

		else 
		{

			echo 'Error al realizar la desconexión.<br/>' ;

		}

	}

	else

	{

		echo 'La conexión no está abierta. <br/>' ;

	}


}

// Primera prueba de conexión/desconexión 
//echo '<b>Primera prueba</b><br/>' ;
//$conexion = conectarConLaBD('localhost','teresa','ranateresa') ; 
//desconectarLaBD($conexion) ;


function login_query($id,$pass,$role){
    
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); 
	
	
	//Construimos la query (Asumimos que hemos limpiado los inputs antes de llamar a esta función)
	$sql = "SELECT 1 FROM usuarios WHERE username = '$id' AND password = '$pass' AND rol =  '$role'";

	//Lanzando query
	$result = mysqli_query($db,$sql);
	$result = mysqli_fetch_array($result,MYSQLI_BOTH);
    
    return (bool) $result;
}





?>
