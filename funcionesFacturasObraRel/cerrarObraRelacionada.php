<?php

require '../funciones/conexion.php';

$db = new Conect_MySql();

$id = $_GET['id'];

$query = "SELECT SUM(totalFactura), id FROM facturasObraRel WHERE idRelacion='$id'";
$ejecuta = $db->execute($query);
$datos = $db->fetch_row($ejecuta);
$totalFact = $datos[0];
$idFact = $datos[1];

$dato= "SELECT tipo FROM archivosFacturasObraRel WHERE idRelacion = '$idFact'";
$tip = $db->execute($dato);
$tipo_e = mysqli_fetch_row($tip);
$prueba = $tipo_e[0];

$contar= mysqli_num_rows($tip);

if($totalFact == 0 or $contar=== 0){
    echo '<script> alert("No se puede cerrar la obra sin facturas"); history.back(2);</script>';
}else{
$sql = "UPDATE obraRelacionada SET nombreEstado = 'Obra Finalizada', estado = '3' WHERE id='$id'";
$actualiza = $db->execute($sql);
if ($actualiza) {
    echo '<script> alert("La obra fue finalizada correctamente"); window.location = "../vistas/listaObrasRelacionadas.php"</script>';
} else {
    echo utf8_decode('<script> alert("Lo sentimos, ocurrió un problema");'
            . ' history.back(); </script>');
}
}
?>
