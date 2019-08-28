<html>
<?php
require '../funciones/conexion.php';

$db = new Conect_MySql();
$id = $_POST['inputHidden'];
$idObra = $_POST['hidden'];
$nombre = $_FILES['archivo']['name'];
$tipo = $_FILES['archivo']['type'];
$tamanio = $_FILES['archivo']['size'];
$prefix = "doc_";
$ext = explode(".", $nombre);
$extencion = $ext[1];
$ruta = $_FILES['archivo']['tmp_name'];
$destino = "../archivosFacturasRelacionada/" . $nombre;
$realName = uniqid($prefix, TRUE) . '.' . $extencion;

if (move_uploaded_file($ruta, $destino)) {
    $query = "INSERT INTO archivosFacturasObraRel(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom)
              VALUES(null,'$id','$tamanio','$tipo','$nombre','$realName')";
    $isInsert = $db->execute($query);
    if ($isInsert) { ?>
        <script> var id = <?php echo $idObra ?>; window.location = "../vistas/subirFacturasObraRel.php?ide=" + id; </script>;
<?php
}else{
    echo 'No se ha podido ejecutar la acción';
}
} else {
echo 'Lo sentimos, algo salió mal';
}
?>
</html>
