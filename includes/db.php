<?php

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





?>