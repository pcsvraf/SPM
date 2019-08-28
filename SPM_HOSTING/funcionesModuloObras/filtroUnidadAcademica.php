<?php
require '../funciones/conexion.php';

$db = new Conect_MySql();

$busqueda = $_GET['term'];

$query = "SELECT nombre FROM unidadAcademica WHERE nombre LIKE '%".$busqueda."%' ORDER BY nombre ASC";
$ejecuta = $db->execute($query);
while ($row = $db->fetch_row($ejecuta)){
       $data[] = $row['nombre'];
}

echo json_encode($data);
?>


