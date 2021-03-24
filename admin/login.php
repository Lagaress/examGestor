<?php
session_start();

include('./../includes/db.php');

$role = 'admin'; 

if(isset($_POST['submited'])){

    $username = $_POST['username'] ; 
    $pass = $_POST['pass'];

    if(login_query($username,$pass,$role)){
        header('location: /admin/index.php'); //Redirigimos a la parte de estudiantes.
        exit;
    } else {
        $error = '<p class="error"> El nombre de usario y/o contraseña introducidos no pertenecen a un perfil de administración valido </p>'; //Mensaje de error generico para evitar una posible enumeración de usuarios.
    }
}

?>
<!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" lang="es">
    <head>

        <meta charset="utf-8"/>
        <title> Panel de Administración </title>

    </head>
    <body>

    <!-- Made CSS --> 
    <style>
        #card {
          width: 40%;
          margin: 200px auto;
          text-align: center;
          background-color: lightgray;
          padding: 10px;
        }
        .entrada {
          width: 90%;
          padding: 10px;
          margin: 5px;
        }
        .boton {
          width: 90%;
          padding: 10px;
          margin: 5px;
          background-color: blue;
          color: white;
          border: none;
          font-weight: 900;
        }
        div a {
          color: grey;
          text-decoration: none;
        }
        div h2 {
          color: grey;
          font-weight: 300;
          font-size: 50px;
        }
        div {
          margin: 15px 0px;
        }
        .error{
          color: red;
        }
    </style>

        <div id="card">
            <div>
            <h2>Panel de Administración</h2>
            </div>
                <form action="login.php" method=post onsubmit="document.getElementById('unlockbtn').disabled=true;"> 

                <?php echo $error; ?>

                <input type="text" placeholder="Usuario" class="entrada" id="username" name="username" size=10  > 
                <input type="password" placeholder="Contraseña" class="entrada" id="password" name="pass" size=12 >
                
                <div></div>
                
                <button class="boton" id="login" type="submit" name="submited">Iniciar Sesión</button>
            </div>
        </div>
    </form>


    </body>




</html>
