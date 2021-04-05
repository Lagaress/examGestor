<!-- Thanks to Tushar Sonawane to provde me that amazing css -->

<?php
$incorrectlogin = '';

function autentificado($user, $pass){
    $conexion = mysqli_connect('localhost','root', '777303', 'universidad') ; 
    if (mysqli_connect_errno()) { 
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        die();
    }

    $ifuser = mysqli_query($conexion,"SELECT * FROM persona WHERE USER='$user' && PASS='$pass'");
    $numuser = mysqli_num_rows($ifuser);
    session_start();
    $sujeto = mysqli_fetch_array($ifuser);
    if($numuser==1){
        $_SESSION['nombre'] = $sujeto['NOMBRE'];
        $_SESSION['apellidos'] = $sujeto['APELLIDOS'];
        $_SESSION['foto'] = $sujeto['FOTO'];
        $_SESSION['dni'] = $sujeto['DNI'];
    }
    return $numuser;
}

function givetipe($user, $pass){
    $conexion = mysqli_connect('localhost','root', '777303', 'universidad') ; 
    if (mysqli_connect_errno()) {
        printf("Conexión fallida: %s\n", mysqli_connect_error());
        exit();
    }

    $consulta = mysqli_query($conexion,"SELECT TIPO FROM persona WHERE USER='$user' && PASS='$pass'");
    $type = mysqli_fetch_array($consulta);

    return $type['TIPO'];
}


if ( isset($_POST['submit'])) {
    $incorrectlogin = '';
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // $conexion = mysqli_connect('localhost','root', '777303', 'universidad');
    // if (mysqli_connect_errno()) {
    //     printf("Conexión fallida: %s\n", mysqli_connect_error());
    //     die();
    // }

    // $ifuser = mysqli_query($conexion,"SELECT * FROM persona WHERE USER='$user' && PASS='$pass'");
    // $sujeto = mysqli_fetch_array($ifuser);
    // echo $sujeto['nombre'];


    // session_start();
    // $_SESSION['nombre'] = $sujeto['NOMBRE'];
    // $_SESSION['apellidos'] = $sujeto['APELLIDOS'];

    
    if( autentificado($user, $pass)==1){
        $tipo = givetipe($user, $pass);
        switch($tipo){
            case 'ALUMNO': header("Location:estudiante/panelalumno.php");
                break;
            case 'PROFESOR': header("Location:profesor/panelprofesor.php");
                break;
            case 'ADMIN':  header("Location:admin/paneladmin.php");
                break;
            default: echo "Contacte con un administrador, su cuenta necesita reparación"; 
        }
    }else{
        $incorrectlogin = 'Identificacion incorrecta';
    }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta content="charset=utf-8" />
    <link href="templates/login.css" rel="stylesheet" type="text/css">
    <title>Inicio de Sesión</title>
</head>
<body>
<body>
	<div class="login">
		<div class="login-screen">
			<div class="app-title">
				<h1>Inicio de Sesión</h1>
			</div>
            <form method="POST" enctype="multipart/form-data" action="./index.php">
                <div class="login-form">
                    <div class="control-group">
                        <input type="text" name="user" class="login-field" value="" placeholder="Usuario" id="login-name">
                        <label class="login-field-icon fui-user" for="login-name"></label>
                    </div>

                    <div class="control-group">
                        <input type="password" name="pass" class="login-field" value="" placeholder="Contraseña" id="login-pass">
                        <label class="login-field-icon fui-lock" for="login-pass"></label>
                    </div>

                    <input type="submit" value="Enviar" name="submit" class="btn btn-primary btn-large btn-block">
                </div>
            </form><br>
            <?php echo "<div color='red' style=\"text-align : center; color : red \">".$incorrectlogin."</div>" ;
             $incorrectlogin = ''; ?>
		</div>
	</div>
</body>
    
</body>
</html>




<!-- <form method="POST" enctype="multipart/form-data" action="./login.php" style="text-align: center; min-height: 50%;">
        <div style="background-color: aquamarine; ">
            Usuario: <input type="text" placeholder="&#128272 Usuario" name="user"  required><br>
            Password: <input type="password" placeholder="&#128272 Contraseña" name="pass" required><br>
            <input type="submit" value="Enviar" name="submit">
        </div>
    </form>        -->


