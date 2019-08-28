<?php
require '../funciones/conexion.php';

$db = new Conect_MySql();
$id = $_POST['inputHidden'];
$nombreArchi = $_POST['nombreHidden'];
$idObra = $_POST['hidden'];
$nombre = $_FILES['archivo']['name'];
$tipo = $_FILES['archivo']['type'];
$tamanio = $_FILES['archivo']['size'];
$prefix = "doc_";
$ext = explode(".", $nombre);
$extencion = $ext[1];
$ruta = $_FILES['archivo']['tmp_name'];
$destino = "../archivosObrasNuevas/" . $nombre;
$realName = uniqid($prefix, TRUE) . '.' . $extencion;

$query2="SELECT id FROM nombreArchivos WHERE nombre='$nombreArchi'";
$execute = $db->execute($query2);
$idNom = $db->fetch_row($execute);
$idArchivo = $idNom['id'];

if (move_uploaded_file($ruta, $destino)) {
    $query = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo, idArchivo)
              VALUES(null,'$id','$tamanio','$tipo','$nombre','$realName', '$nombreArchi', '$idArchivo')";
    $isInsert = $db->execute($query);
    if ($isInsert) {?>
<html> <script type="text/javascript"> var id = <?php echo $idObra ?>; window.location = "../vistas/prueba.php?id=" + id;  </script> </html>
<?php
    } else {
        echo 'No se ha podido ejecutar la acción';
    }
} else {
    echo 'Lo sentimos, algo salió mal';
}
?>
