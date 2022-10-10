<?php

//export.php
header("Content-Type: application/xls; charset=utf-8");
header("Content-Disposition: attachment; filename= obraNueva.xls");
header("Pragma: no-cache");
header("Expires: 0");
require 'funciones/conexion.php';
$db = new Conect_MySql();
$output = '';

$query = "select * from obraNueva";
$result = $db->execute($query);
if (mysqli_num_rows($result) > 0) {
    $output .= utf8_decode('
   <table class="table" border="1" cellspacing=0 cellpadding=2>
                    <tr>
                         <th>ID</th>
                         <th>Responsable</th>
                         <th>Fecha Ingreso</th>
                         <th>Nombre Obra</th>
                         <th>Campus</th>
                         <th>Mandante</th>
                         <th>Unidad Otro</th>
                         <th>Usuario</th>
                         <th>Edificio</th>
                         <th>Piso</th>
                         <th>Recinto</th>
                         <th>Unidad</th>
                         <th>Empresa / Contratista</th>
                         <th>Rut Contratista</th>
                         <th>Presupuesto</th>
                         <th>Neto</th>
                         <th>I.V.A</th>
                         <th>Cargo N° Cuenta</th>
                         <th>Observaciones</th>
                         <th>Estado</th>
                         <th>Metros Cuadrados</th>TABLA SISTEMA GESTIÓN OBRA PLAN MAESTRO
                         <th>Obra Nueva Remodelación</th>
                         <th>Fecha Inicio Contrato</th>
                         <th>Fecha Término Contrato</th>
                    </tr>
  ');
    while ($datos = $db->fetch_row($result)) {
        $output .= '
    <tr>
                         <td>' . $datos["id"] . '</td>
                         <td>' . utf8_decode($datos["encargado"]) . '</td>
                         <td>' . $datos["fecha"] . '</td>
                         <td>' . utf8_decode($datos["nombreObra"]) . '</td>
                         <td>' . utf8_decode($datos["campus"]) . '</td>
                         <td>' . utf8_decode($datos["mandante"]) . '</td>
                         <td>' . utf8_decode($datos["unidadOtro"]) . '</td>
                         <td>' . utf8_decode($datos["usuario"]) . '</td>
                         <td>' . utf8_decode($datos["edificio"]) . '</td>
                         <td>' . $datos["piso"] . '</td>
                         <td>' . utf8_decode($datos["recinto"]) . '</td>
                         <td>' . utf8_decode($datos["unidad"]) . '</td>
                         <td>' . utf8_decode($datos["empresaContratista"]) . '</td>
                         <td>' . $datos["rutContratista"] . '</td>
                         <td>' . $datos["presupuesto"] . '</td>
                         <td>' . $datos["neto"] . '</td>
                         <td>' . $datos["iva"] . '</td>
                         <td>' . $datos["cargoNroCuenta"] . '</td>
                         <td>' . utf8_decode($datos["observaciones"]) . '</td>
                         <td>' . $datos["nombreEstado"] . '</td>
                         <td>' . $datos["metrosCuadrados"] . '</td>
                         <td>' . $datos["nuevaRemodelacion"] . '</td>
                         <td>' . $datos["fechaInicioContrato"] . '</td>
                         <td>' . $datos["fechaTerminoContrato"] . '</td>

                    </tr>
   ';
    }
    $output .= '</table>';
    echo $output;
}
?>
