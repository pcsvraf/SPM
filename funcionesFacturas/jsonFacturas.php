<?php

require '../funciones/conexion.php';
$db = new Conect_MySql();
$id = $_GET['id'];
$query = "SELECT totalFactura FROM facturas WHERE idRelacion = '$id' ORDER BY id ASC";
$ejecuta = $db->execute($query);

while ($datos = $db->fetch_row($ejecuta)) {
    $data[] = $datos['totalFactura'];
}
echo json_encode($data);
?>
