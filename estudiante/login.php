<?php
session_start();


// Función común para el login , moverla a un import
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


$role = 'estudiante'; 

if(isset($_POST['submited'])){

    $username = $_POST['username'] ; 
    $pass = $_POST['pass'];

    if(query_db($username,$pass,$role)){
        header('location: /estudiante/index.php'); //Redirigimos a la parte de estudiantes.
        exit;
    } else {
        $error = '<p class="error"> El nombre de usario y/o contraseña introducidos no pertenecen a un perfil de estudiante valido </p>'; //Mensaje de error generico para evitar una posible enumeración de usuarios.
    }


}

?>
<!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" lang="es">
    <head>

        <meta charset="utf-8"/>
        <title> Portal de estudiantes </title>

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
            <h2>Portal de estudiantes</h2>
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
