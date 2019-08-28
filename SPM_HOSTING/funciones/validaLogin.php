<?php

if (isset($_POST['login'])) {
    require 'conexion.php';
    $db = new Conect_MySql();

    $correo = $_POST['email'];
    $contraseña = $_POST['contra'];
    
    $query = "select * from usuarios where email = '$correo' && password = '$contraseña'";
    $execute = $db->execute($query);
    $contador = mysqli_num_rows($execute);
    
    if ($contador == 0){
       echo '<script languaje="javascript"> alert("Contraseña o Correo Electronico incorrectos"); history.back();</script>';
    }else{
        session_start();
        $_SESSION['correo'] = $correo;
        header("Location:../vistas/menu.php");
    }
}
?>