<?php

//export.php  
header("Content-Type: application/xls; charset=utf-8");
header("Content-Disposition: attachment; filename= obraAdicional.xls");
header("Pragma: no-cache");
header("Expires: 0");
require 'funciones/conexion.php';
$db = new Conect_MySql();
$output = '';

$query = "select * from obraRelacionada";
$result = $db->execute($query);
if (mysqli_num_rows($result) > 0) {
    $output .= utf8_decode('
   <table class="table" border="1" cellspacing=0 cellpadding=2>  
                    <tr>  
                         <th>ID</th>  
                         <th>Responsable</th>  
                         <th>ID Relación</th> 
                         <th>Fecha Ingreso</th>  
                         <th>Monto</th>
                         <th>Contratista</th>
                         <th>Rut Contratista</th>
                         <th>Observaciones</th>
                         <th>Estado</th>TABLA SISTEMA GESTIÓN OBRA PLAN MAESTRO
                    </tr>
  ');
    while ($datos = $db->fetch_row($result)) {
        $output .= '
    <tr>  
                         <td>' . $datos["id"] . '</td>  
                         <td>' . utf8_decode($datos["encargadoObra"]) . '</td>  
                         <td>' . $datos["numeroRelacionObra"] . '</td>  
                         <td>' . $datos["fecha"] . '</td>  
                         <td>' . $datos["monto"] . '</td>
                         <td>' . utf8_decode($datos["contratista"]) . '</td>
                         <td>' . $datos["rutContratista"] . '</td>
                         <td>' . utf8_decode($datos["observaciones"]) . '</td>
                         <td>' . $datos["nombreEstado"] . '</td>                     
                    </tr>
   ';
    }
    $output .= '</table>';
    echo $output;
}
?>

