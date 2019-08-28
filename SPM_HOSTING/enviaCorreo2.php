<?php

if (isset($_POST['correo'])) {
    $destino = "mauricio.becerra@pucv.cl";
    $contenido = "Estimado/a

Junto con saludar, informamos que la obra ingresada Nro  se encuentra a 5 días de su término, esto según la fecha definida en el contrato establecido con la empresa responsable de la obra.

Atentamente, 

Sistema Gestión de obras 
Dirección Plan Maestro
Vicerrectoría de Desarrollo";
     mail($destino, "Notificación Sistema Gestión de Obra", $contenido);
} else {
    echo 'no se envio el correo';
}
?>