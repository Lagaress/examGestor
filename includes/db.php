<?php

// Función para abrir la conexión 
function conectarConLaBD ($url=NULL,$user=NULL,$password=NULL) 
{

	$conexion = @mysqli_connect($url , $user , $password) ; 

	if ($conexion) // Si la conexion se establece de forma correcta => $conexion = true 
	{

		echo 'Conexion con éxtio <br/>' ; 
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
echo '<b>Primera prueba</b><br/>' ;
$conexion = conectarConLaBD('localhost','teresa','ranateresa') ; 
desconectarLaBD($conexion) ;

/*
function query_db($id,$pass,$role){
    $conex = mysqli_connect();
    mysqli_select_db($conex,'usuarios');
    $sql = 'SELECT 1 FROM usuarios';
    $sql.= 'WHERE username = ? AND password = ? AND ROLE = ?';
    $query = mysqli_stmt_init($conex);
    $ok = mysqli_stmt_prepare($conex, $query);
    $ok = mysqli_stmt_bind_param($query,'sss',$id,$pass,$role);
    $ok = mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query,$NoSeQueNombrePonerleAEsteParametro);
    $ok = mysqli_stmt_fetch($query);
    mysqli_stmt_free_result($query);

    return $NoSeQueNombrePonerleAEsteParametro;
}

 */



?>
