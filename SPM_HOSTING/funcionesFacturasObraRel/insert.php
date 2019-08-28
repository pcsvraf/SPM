<?php

$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
if (isset($_POST["idRelacion"], $_POST["numeroFactura"], $_POST["fecha"], $_POST["detalleServicio"], $_POST["totalFactura"], $_POST["devolucionDeRetencion"])) {

    $idRelacion = mysqli_real_escape_string($connect, $_POST["idRelacion"]);
    $numeroFactura = mysqli_real_escape_string($connect, $_POST["numeroFactura"]);
    $fecha = $_POST["fecha"];
    $detalleServicio = mysqli_real_escape_string($connect, $_POST["detalleServicio"]);
    $totalFactura = mysqli_real_escape_string($connect, $_POST["totalFactura"]);
    $devolucion = mysqli_real_escape_string($connect, $_POST["devolucionDeRetencion"]);
    $query1 = "SELECT id FROM facturasObraRel order by id DESC LIMIT 1";
    $resultado = mysqli_query($connect, $query1);
    $id = mysqli_fetch_row($resultado);
    $ide = $id[0] + 1;

    $query = "INSERT INTO facturasObraRel(id, idRelacion, numeroFactura, fecha, detalleServicio, totalFactura, devolucionDeRetencion)"
            . " VALUES('$ide', '$idRelacion', '$numeroFactura', '$fecha', '$detalleServicio', '$totalFactura', '$devolucion')";
    if (mysqli_query($connect, $query)) {
        echo 'Factura ingresada';
    } else {
        echo 'Error al ingresar factura';
    }
}
?>
