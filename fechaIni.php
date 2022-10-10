<?php

require "./funciones/conexion.php";

$db = new Conect_MySql();

$sql = "select id, fechaInicioContrato, fechaTerminoContrato, email from obraNueva";
$ejecuta = $db->execute($sql);
date_default_timezone_set("America/Santiago");
$fecha = getdate();
$dia = $fecha['mday'];
$mes = $fecha['mon'];
$anio = $fecha['year'];

$fechaDeHoy = "$anio-$mes-$dia";
$diaDeHoy = strtotime($fechaDeHoy);
$diahoy = date("d", $diaDeHoy);

function dias_transcurridos($fechaInicio, $fechaTermino) {
    $dias = (strtotime($fechaInicio) - strtotime($fechaTermino)) / 86400;
    $dias = abs($dias);
    $dias = floor($dias);
    return $dias;
}

while ($datos = $db->fetch_row($ejecuta)) {
    $fechaInicio = $datos['fechaInicioContrato'];
    $fechaTermino = $datos['fechaTerminoContrato'];
    $numeroObra = $datos['id'];
    $correo = $datos['email'];
    $fechaComoEntero = strtotime($fechaInicio);
    $days = dias_transcurridos($fechaInicio, $fechaTermino);
    $diasA = $days - 5;
    $diaInicio = date("d", $fechaComoEntero);
    $fechaEnvio = $diaInicio + $diasA;
    if ($fechaEnvio == $diahoy) {
        $destino = $correo;

            $contenido = "Estimado/a

Junto con saludar, informamos que la obra ingresada Nro $numeroObra  se encuentra a 5 días de su término, esto según la fecha definida en el contrato establecido con la empresa responsable de la obra.

Atentamente, 

Sistema Gestión de obras 
Dirección del Plan Maestro
Vicerrectoría de Desarrollo";
     mail($destino, "Notificación Sistema Gestión de Obras", $contenido);
    }
}
?>