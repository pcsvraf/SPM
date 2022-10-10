<?php

require '../funciones/conexion.php';

$db = new Conect_MySql();

$id = $_GET['id'];

$query = "SELECT SUM(totalFactura), id FROM facturas WHERE idRelacion='$id'";
$ejecuta = $db->execute($query);
$datos = $db->fetch_row($ejecuta);
$totalFact = $datos[0];
$idFact = $datos[1];

$dato= "SELECT tipo FROM archivosFacturas WHERE idRelacion = '$idFact'";
$tip = $db->execute($dato);
$tipo_e = mysqli_fetch_row($tip);
$prueba = $tipo_e[0];
$contar= mysqli_num_rows($tip);

$dato3= "SELECT idArchivo FROM archivosObraNueva WHERE idRelacion = '$id'";
$tip3 = $db->execute($dato3);
$tipo_a = mysqli_fetch_row($tip3);
$prueba3 = $tipo_a[0];
$contar3= mysqli_num_rows($tip3);

if($totalFact == 0 or $contar=== 0 or $contar3!== 9){
  if($contar3!== 9){
    echo '<script> alert("No es posible cerrar la Obra, esto debido a que no ha subido todos los archivos asociados a la misma y que son de carácter obligatorio"); history.back(2);</script>';
  }else{
    echo '<script> alert("No es posible cerrar la obra sin facturas"); history.back(2);</script>';
  }
}else{
$query2 = "SELECT presupuesto FROM obraNueva WHERE id = '$id'";
$execute = $db->execute($query2);
$data = $db->fetch_row($execute);
$presupuesto = $data['presupuesto'];

$query3 = "SELECT estado FROM obraRelacionada WHERE numeroRelacionObra = '$id'";
$obraRel = $db->execute($query3);
$resultado = "";
$pendiente="";
while ($obra = $db->fetch_row($obraRel)) {
       $resultado = $obra[0];
       if($resultado !=3){
         $pendiente.= "si";
       }
}

if ($resultado == 3) {
  if($pendiente=="si"){
    echo '<script> alert("La obra no se puede cerrar, debe asegurarse de finalizar las obras adicionales");'
            . ' history.back(); </script>';
  }else{
    $sql = "UPDATE obraNueva SET nombreEstado = 'Obra Finalizada', estado = '3' WHERE id='$id'";
    $actualiza = $db->execute($sql);
    if ($actualiza) {
        echo '<script> alert("La obra fue finalizada exitosamente"); window.location = "../vistas/iniciarObras.php"</script>';
    }
  }
} else if ($resultado == '') {
    $sql = "UPDATE obraNueva SET nombreEstado = 'Obra Finalizada', estado = '3' WHERE id='$id'";
    $actualiza = $db->execute($sql);
    if ($actualiza) {
        echo '<script> alert("La obra fue finalizada correctamente"); window.location = "../vistas/iniciarObras.php"</script>';
    }
} else {
    echo '<script> alert("La obra no se puede cerrar, debe asegurarse de finalizar las obras adicionales");'
            . ' history.back(); </script>';
}
}
?>
