<!-- Empieza el HTML -->
<!DOCTYPE html>
<html>
<head> 
<style>

h1 {
    color: black ;
    font-family: fantasy;
    text-align: center ; 
    
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #ffff;
}

.tituloCalificaciones
{

	color: black ;
	font-family: fantasy ;  

}

.contenidoGlobal1 
{

	background-color: grey;
	text-align:center ; 
	font-weight: bold ; 

}

.contenidoGlobal2
{

	text-align:center ; 
	font-weight: bold ; 

}

</style>
	<meta content = "charset=utf-8"/> 
	<title>Ver las Calificaciones</title>
</head>
<body>
	<h1 class="tituloCalificaciones">Calificaciones del profesor</h1>
	<?php

	// Obtenemos el DNI	del profesor que ha iniciado sesión 
	session_start();
        $nombresesion = $_SESSION['nombre'];
        $apellsesion = $_SESSION['apellidos'];
        $fotosesion = $_SESSION['foto'];
        $dnisesion = $_SESSION['dni'];
        if($nombresesion ==null || $apellsesion==null){
            echo "no hay autorizacion";
            die();
        }

	// Nos conectamos a la BD
	$conexionadmin = mysqli_connect('localhost','root','777303','universidad') ; 
		 if (mysqli_connect_errno()) 
		 {
             printf("Conexión fallida: %s\n", mysqli_connect_error());
             die();
		 }

	
	// Consulta SQL	PARA OBTENER EL ALUMNO Y SU CALIFICACIÓN
	$consulta = mysqli_query($conexionadmin, "SELECT ALUM_DNI as DNI , 
												NOTA as NOTA 
												FROM calificaciones c, asignaturas a , profesor p , examenes e
												WHERE p.DNI = '$dnisesion' AND p.ASIGASOC = a.CODIGO AND p.ASIGASOC = e.ASIG AND c.COD_EX = e.CODEX
												"
							);

	// CONSULTA SQL PARA OBTENER LOS SUSPENSOS
	$consulta_obtencion_suspensos = mysqli_query($conexionadmin , "SELECT COUNT(ALUM_DNI) FROM calificaciones c, asignaturas a , profesor p , examenes e WHERE p.DNI ='$dnisesion' AND p.ASIGASOC = a.CODIGO AND p.ASIGASOC = e.ASIG AND c.COD_EX = e.CODEX AND NOTA < 5" ) ;

	$mostrar_suspensos = mysqli_fetch_array($consulta_obtencion_suspensos) ;
							
	// CONSULTA SQL PARA OBTENER LOS APROBADOS
	$consulta_obtencion_aprobados = mysqli_query($conexionadmin , "SELECT COUNT(ALUM_DNI) FROM calificaciones c, asignaturas a , profesor p , examenes e WHERE p.DNI ='$dnisesion' AND p.ASIGASOC = a.CODIGO AND p.ASIGASOC = e.ASIG AND c.COD_EX = e.CODEX AND NOTA >= 5" ) ;

	$mostrar_aprobados = mysqli_fetch_array($consulta_obtencion_aprobados) ;

	// CONSULTA SQL PARA OBTENER LOS NOTABLES
	$consulta_obtencion_notables = mysqli_query($conexionadmin , "SELECT COUNT(ALUM_DNI) FROM calificaciones c, asignaturas a , profesor p , examenes e WHERE p.DNI ='$dnisesion' AND p.ASIGASOC = a.CODIGO AND p.ASIGASOC = e.ASIG AND c.COD_EX = e.CODEX AND NOTA BETWEEN 7 AND 8" ) ;

	$mostrar_notables = mysqli_fetch_array($consulta_obtencion_notables) ;
	
	// CONSULTA SQL PARA OBTENER LOS SOBRESALIENTES
	$consulta_obtencion_sobresalientes = mysqli_query($conexionadmin , "SELECT COUNT(ALUM_DNI) FROM calificaciones c, asignaturas a , profesor p , examenes e WHERE p.DNI ='$dnisesion' AND p.ASIGASOC = a.CODIGO AND p.ASIGASOC = e.ASIG AND c.COD_EX = e.CODEX AND NOTA > 8" ) ;

	$mostrar_sobresalientes = mysqli_fetch_array($consulta_obtencion_sobresalientes) ;

	// CONSULTA SQL PARA OBTENER LOS SOBRESALIENTES
	$consulta_obtencion_media = mysqli_query($conexionadmin , "SELECT AVG(NOTA) FROM calificaciones c, asignaturas a , profesor p , examenes e WHERE p.DNI ='$dnisesion' AND p.ASIGASOC = a.CODIGO AND p.ASIGASOC = e.ASIG AND c.COD_EX = e.CODEX" ) ;

	$mostrar_media = mysqli_fetch_array($consulta_obtencion_media) ;



	$numcol = mysqli_num_rows($consulta) ;

	if ($numcol == 0) // Si el número de columnas está a 0 => Todavía no hay ningún examen
	{

		echo "Todavía no se ha realizado ningún examen" ;

	}

	else // En caso contrario, mostramos los exámenes
	{

		for ( $i = 0 ; $i < $numcol ; $i++ )
		{

			$fila = mysqli_fetch_array($consulta);

			if($i == 0) // Mostramos los encabezados
			{
			echo " <table class=\"encabezadoVerCalificaciones\" > 
			<tr class = \"titulosVerCalificaciones\">
				<th>Alumno</th>
				<th>Calificación</th>
			</tr>";
			}

			echo  # Mostramos la tabla
				"<tr class=\"filasVerCalificaciones\" >
				<td> ".$fila['DNI']." </td>
				<td> ".$fila['NOTA']." </td>
				";
			echo "<tr>";

		}		
			echo "</table></div>";
	}

	echo 
	"
		<table>
			<tr></tr>
			<td class=\"contenidoGlobal1\">El número de suspensos es: $mostrar_suspensos[0]\n</td>
			<tr></tr>
			<td class=\"contenidoGlobal2\">El número de aprobados es: $mostrar_aprobados[0]</td>
			<tr></tr>
			<td class=\"contenidoGlobal1\">El número de notables es: $mostrar_notables[0]</td>
			<tr></tr>
			<td class=\"contenidoGlobal2\">El número de sobresalientes es: $mostrar_sobresalientes[0]</td>
			<tr></tr>
			<td class=\"contenidoGlobal1\">La media de la clase es: $mostrar_media[0]</td>
		</table>
	" ;

	mysqli_close($conexionadmin); // Cerramos la conexión con la BD

	echo " <br>   <form action=\"../panelprofesor.php\" >
	<input type=\"submit\" value=\"Volver\" />
	</form>";


	?>

</body>
</html>
