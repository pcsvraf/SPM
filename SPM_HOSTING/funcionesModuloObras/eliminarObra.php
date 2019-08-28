<?php
//se importa la clase de la conexion
require '../funciones/conexion.php';
//se crea un objeto para heredar los métodos
$db = new Conect_MySql();
$id = $_GET['id'];

//se insertan los datos de la obraNueva
$query1 = "DELETE FROM obraNueva WHERE id = $id";
$ejecutar = $db->execute($query1);

if ($ejecutar){
  echo '<script> alert("La obra ha sido eliminada"); window.location = "../vistas/iniciarObras.php" </script>';
}else{
  echo 'No se ejecutaron los cambios';
}
?>
