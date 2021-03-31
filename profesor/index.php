<?php 
// Controlamos la sesión con PHP
session_start();
    $nombresesion = $_SESSION['nombre'];
    $apellsesion = $_SESSION['apellidos'];
    $fotosesion = $_SESSION['foto'];
    $_SESSION['nopass']='';
    if($nombresesion ==null || $apellsesion==null){
        echo "no hay autorizacion";
        die();
    }

 ?>

<!-- Empieza el HTML -->
<!DOCTYPE html>
<html>
<head> 
	<meta content = "charset=utf-8"/> 
	<title>Panel del Profesor</title>
</head>
<body>

	<h1>Operaciones del profesor</h1>
	<table style="text-align: center ;"> 
		<tr>
			<th>
				<a href="gestionResultados.php" class = "calificacionesProfesor">Ver calificaciones</a>
			</th>
			<th>
				<a href="gestionPreguntas.php" class = "examenesProfesor">Gestionar Exámenes</a>
			</th>
		</tr>

</body>
</html>
