<?php

//export.php  
header("Content-Type: application/xls; charset=utf-8");
header("Content-Disposition: attachment; filename= contratistas.xls");
header("Pragma: no-cache");
header("Expires: 0");
require 'funciones/conexion.php';
$db = new Conect_MySql();
$output = '';

$query = "select * from contratistas";
$result = $db->execute($query);
if (mysqli_num_rows($result) > 0) {
    $output .= utf8_decode('
   <table class="table" border="1" cellspacing=0 cellpadding=2>  
                    <tr>  
                         <th>Id</th>  
                         <th>Nombre o Razón Social</th>  
                         <th>Rut</th>  
                         <th>Email</th>
                         <th>Teléfono</th>
                         <th>Dirección</th>
                    </tr>
  ');
    while ($datos = $db->fetch_row($result)) {
        $output .= '
    <tr>  
                         <td>' . $datos["id"] . '</td>  
                         <td>' . utf8_decode($datos["nombre"]) . '</td>  
                         <td>' . $datos["rut"] . '</td>  
                         <td>' . $datos["email"] . '</td>  
                         <td>' . $datos["contacto"] . '</td>
                         <td>' . utf8_decode($datos["direccion"]) . '</td>                                             
                    </tr>
   ';
    }
    $output .= '</table>';
    echo $output;
}
?>