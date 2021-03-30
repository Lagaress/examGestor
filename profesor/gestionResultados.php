<?php
/* han obtenido sus estudiantes, esto es, la
calificación que ha obtenido cada uno, el número de suspensos, de aprobados, de
notables y de sobresalientes y finalmente la nota media de la clase*/

include('./../includes/db.php'); // Incluimos la conexion a la BD

// Creamos la consulta SQL para buscar las calificaciones
$query_sql = "SELECT ALUM_DNI , 
	NOTA , 
	COUNT(ALUM_DNI FROM calificaciones WHERE NOTA < 5 ) , 
	COUNT(ALUM_DNI FROM calificaciones WHERE NOTA BETWEEN 5 AND 6 ) , 
	COUNT(ALUM_DNI FROM calificaciones WHERE NOTA BETWEEN 7 AND 8 ) , 
	COUNT(ALUM_DNI FROM calificaciones WHERE NOTA BETWEEN 9 AND 10 ) , 
	AVG(NOTA) , 

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

}
?>
