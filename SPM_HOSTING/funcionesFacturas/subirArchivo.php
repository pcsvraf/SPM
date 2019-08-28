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
$destino = "../archivosFacturas/" . $nombre;
$realName = uniqid($prefix, TRUE) . '.' . $extencion;

if (move_uploaded_file($ruta, $destino)) {
    $query = "INSERT INTO archivosFacturas(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom)
              VALUES(null,'$id','$tamanio','$tipo','$nombre','$realName')";
    $isInsert = $db->execute($query);
    if ($isInsert) {?>
<html> <script type="text/javascript"> var id = <?php echo $idObra ?>; window.location = "../vistas/subirFacturas.php?ide=" + id;  </script> </html>
<?php
    } else {
        echo 'No se ha podido ejecutar la acción';
    }
} else {
    echo 'Lo sentimos, algo salió mal';
}
?>
