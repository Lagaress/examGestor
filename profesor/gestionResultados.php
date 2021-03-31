<!-- Empieza el HTML -->
<!DOCTYPE html>
<html>
<head> 
	<meta content = "charset=utf-8"/> 
	<title>Ver las Calificaciones</title>
</head>
<body>
	<h1>Calificaciones del profesor</h1>
	<?php
/* han obtenido sus estudiantes, esto es, la
calificación que ha obtenido cada uno, el número de suspensos, de aprobados, de
notables y de sobresalientes y finalmente la nota media de la clase*/

include('./../includes/db.php'); // Incluimos la conexion a la BD

// Creamos la consulta SQL para buscar las calificaciones
$query_sql = "SELECT ALUM_DNI as DNI, 
	NOTA as NOTA, 
	COUNT(ALUM_DNI FROM calificaciones WHERE NOTA < 5 ) as SUSPENSOS, 
	COUNT(ALUM_DNI FROM calificaciones WHERE NOTA BETWEEN 5 AND 6 ) as APROBADOS, 
	COUNT(ALUM_DNI FROM calificaciones WHERE NOTA BETWEEN 7 AND 8 ) as NOTABLES, 
	COUNT(ALUM_DNI FROM calificaciones WHERE NOTA BETWEEN 9 AND 10 ) as SOBRESALIENTES, 
	AVG(NOTA) as MEDIA, 

	FROM calificaciones c, asignaturas a , profesor p 

	WHERE p.DNI = '$dni_profesor' AND p.ASIGASOC = a.CODIGO AND c.CODIGO = a.CODIGO group by a.CODIGO" ;


$lista_calificaciones = mysqli_query($conexion , $query_sql) ; // Lanzamos la query hacia la BD 

if (mysql_num_rows($lista_calificaciones) == 0) // Si nos devuelve 0 es que no hay nada en la tabla => Todavia no se ha realiado ningún examen
{

	echo "<h2>¡Todavía no se ha realizado el examen</h2>" 

}
else 
{

	// Ahora aquí habrá que hacer el mostrado
	for ($i = 0 ; $i < mysql_num_rows($lista_calificaciones) ; $i++ )
	{

		$fila = mysqli_fetch_array($lista_calificaciones) ; 

		if ($i == 0) // Mostramos los encabezados
		{

			echo " <table> 

				<tr> 
					<th>Estudiante</th>
					<th>Calificación</th>
					<th>Suspensos</th>
					<th>Aprobados</th>
					<th>Notables</th>
					<th>Sobtesalientes</th>
					<th>Media de la clase</th>
				</tr>			
			" ;

		}

		echo 
		"
			<tr>
				<td>".$fila['DNI']."</td>
				<td>".$fila['NOTA']."</td>
				<td>".$fila['SUSPENSOS']."</td>
				<td>".$fila['APROBADOS']."</td>
				<td>".$fila['NOTABLES']."</td>
				<td>".$fila['SOBRESALIENTES']."</td>
				<td>".$fila['MEDIA']."</td>
			</tr>
			</table>
		"
	}

}
?>
</body>
</html>
