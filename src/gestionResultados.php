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

echo $_SESSION['DNI'] ;


	// Nos conectamos a la BD
	$conexionadmin = mysqli_connect('localhost','root', '777303', 'universidad');
		 if (mysqli_connect_errno()) 
		 {
             printf("Conexión fallida: %s\n", mysqli_connect_error());
             die();
		 }

	// Obtenemos el DNI	del profesor que ha iniciado sesión 

	// Consulta SQL	 
	$consulta = mysqli_query($conexionadmin, "SELECT ALUM_DNI as DNI , 
												NOTA as NOTA , 
												( SELECT COUNT(ALUM_DNI) FROM calificaciones WHERE NOTA < 5 ) as SUSPENSOS ,
												( SELECT COUNT(ALUM_DNI) FROM calificaciones WHERE NOTA BETWEEN 5 AND 6 )  as APROBADOS ,
												( SELECT COUNT(ALUM_DNI) FROM calificaciones WHERE NOTA BETWEEN 7 AND 8 ) as NOTABLES , 
												( SELECT COUNT(ALUM_DNI) FROM calificaciones WHERE NOTA > 8 ) as SOBRESALIENTES , 
												ROUND(AVG(NOTA), 2) as MEDIA
												FROM calificaciones c, asignaturas a , profesor p , examenes e
												WHERE p.DNI = '44353321I' AND p.ASIGASOC = a.CODIGO AND p.ASIGASOC = e.ASIG AND c.COD_EX = e.CODEX
												GROUP BY ALUM_DNI"
							);

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
				<th>Suspensos</th>
				<th>Aprobados</th>
				<th>Notables</th>
				<th>Sobresalientes</th>
				<th>Media de la clase</th>
			</tr>";
			}

			echo  # Mostramos la tabla
				"<tr class=\"filasVerCalificaciones\" >
				<td> ".$fila['DNI']." </td>
				<td> ".$fila['NOTA']." </td>
				<td> ".$fila['SUSPENSOS']." </td>
				<td> ".$fila['APROBADOS']." </td>
				<td> ".$fila['NOTABLES']." </td>
				<td> ".sha1($fila['SOBRESALIENTES'])." </td>
				<td> ".$fila['MEDIA']." </td>
				";
			echo "<tr>";

		}		
			echo "</table></div>";
	}

	mysqli_close($conexionadmin); // Cerramos la conexión con la BD

	?>

</body>
</html>
