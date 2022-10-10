<?php
require '../funciones/conexion.php';

$db = new Conect_MySql();
$id = $_POST['inputHidden'];
$nombreArchi = $_POST['nombreHidden'];
$idObra = $_POST['hidden'];
$idArchiv = $_POST['idArchivo'];
$nombre = $_FILES['archivo']['name'];
$tipo = $_FILES['archivo']['type'];
$tamanio = $_FILES['archivo']['size'];
$prefix = "doc_";
$ext = explode(".", $nombre);
$extencion = $ext[1];
$ruta = $_FILES['archivo']['tmp_name'];
$destino = "../archivosObrasNuevas/" . $idObra.$nombreArchi.'.'.$extencion;
$realName = uniqid($prefix, TRUE) . '.' . $extencion;

if (move_uploaded_file($ruta, $destino)) {
    $query = "UPDATE archivosObraNueva SET tamanio= '$tamanio', tipo='$tipo', nombreArchivo='$idObra$nombreArchi.$extencion', nombreRandom='$realName' WHERE id='$idArchiv'";
    $isInsert = $db->execute($query);
    if ($isInsert) {?>
<html> <script type="text/javascript"> var id = <?php echo $idObra ?>; window.location = "../vistas/prueba.php?id=" + id;  </script> </html>
<?php
    } else {
        echo 'No se ha podido ejecutar la acción';
    }
} else {
    echo 'Lo sentimos, algo salió mal $nombreArchi';
}
?>
