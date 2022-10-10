<?php

include '/home/pcspucv/public_html/spm/wp-load.php';
require '../funciones/conexion.php';
$email = get_userdata(get_current_user_id())->user_firstname;
$apellido = get_userdata(get_current_user_id())->user_lastname;
$nombreApellido = $email . " " . $apellido;

$db = new Conect_MySql();

//se obtiene la fecha del día de hoy
date_default_timezone_set("America/Santiago");
$fecha = getdate();
$dia = $fecha['mday'];
$mes = $fecha['mon'];
$anio = $fecha['year'];
//se obtiene contratista en dos variables, pero podría ser en una
$con = $_POST['contratistas'];
for ($i = 0; $i < count($con); $i++) {
    $contratista = $con[$i];
}
//se consulta el nombre y el rut de contratistas, aunque se utilizará sólo el rut
$consulta = "select nombre, rut from contratistas where nombre='$contratista'";
$execute = $db->execute($consulta);
$rut = $db->fetch_row($execute);
$rutContratista = $rut['rut'];
//se obtienen las observaciones, el monto y el id de la Obra original
$observaciones = $_POST['observaciones'];
$monto = $_POST['monto'];
$idObra = $_POST['idObra'];
$nombreArchivo = $_FILES['informe']['name'];
$ext = explode(".", $nombreArchivo);
$extencion = $ext[1];
$prefix = "doc_";
$realName = uniqid($prefix, TRUE) . '.' . $extencion;
$ruta = $_FILES['informe']['tmp_name'];


$query6 = "SELECT id FROM obraRelacionada order by id DESC LIMIT 1";
$resultado = $db->execute($query6);
$id_ultimo = $db->fetch_row($resultado);
$ide = $id_ultimo[0] + 1;
$destino = "../archivosObraRelacionada/" . $idObra.$ide.$nombreArchivo;
if (move_uploaded_file($ruta, $destino)) {
    $query = "INSERT INTO obraRelacionada(id, monto, numeroRelacionObra, contratista, observaciones, rutContratista, fecha, nombreArchivo, nombreRandom, estado, nombreEstado, encargadoObra)
          VALUES('$ide','$monto','$idObra','$contratista','$observaciones','$rutContratista','$dia-$mes-$anio','$idObra$ide$nombreArchivo','$realName','1','Obra Ingresada','$nombreApellido')";

    $isInsert = $db->execute($query);
    if ($isInsert) {
        echo '<script> alert("Se ingresó correctamente"); window.location = "../vistas/listaObrasRelacionadas.php" </script>';
    }
}
?>
