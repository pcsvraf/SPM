<?php

require '../funciones/conexion.php';
$db = new Conect_MySql();

$id = $_GET['id'];

$query1 = "SELECT estado FROM obraNueva WHERE id='$id'";
$ejecuta = $db->execute($query1);
$dato = $db->fetch_row($ejecuta);
$estado = "";
if ($dato == 1) {
    $estado = "Obra En Proceso";
} else if ($dato == 2) {

} else if ($dato == 3) {

}
//se obtiene la fecha del día de hoy
date_default_timezone_set("America/Santiago");
$fecha = getdate();
$dia = $fecha['mday'];
$mes = $fecha['mon'];
$anio = $fecha['year'];

$sql = "UPDATE obraNueva SET nombreEstado='Obra En Proceso', estado='2', fechaInicio='$dia-$mes-$anio'
        WHERE id='$id'";
$isInsert = $db->execute($sql);

if ($isInsert) {
    echo '<script type="text/javaScript"> alert("La obra se ha iniciado correctamente"); '
    . 'window.location = "../vistas/iniciarObras.php"; </script>';
}
?>
