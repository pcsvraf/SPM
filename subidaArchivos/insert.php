<?php
require '../funciones/conexion.php';
$db = new Conect_MySql();
$idRelacion =$_POST["idRelacion"];
$nombreArchivo = $_POST["nombreArch"];
$nombre = $_FILES['archivo']['name'];
$tipo = $_FILES['archivo']['type'];
$tamanio = $_FILES['archivo']['size'];
$prefix = "doc_";
$ext = explode(".", $nombre);
$extencion = $ext[1];
$ruta = $_FILES['archivo']['tmp_name'];
$destino = "..//archivosObraNueva/" . $nombre;
$realName = uniqid($prefix, TRUE) . '.' . $extencion;
if (move_uploaded_file($ruta, $destino)) {
    $query = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
              VALUES(null,$idRelacion,'$tamanio','$tipo','$nombre','$realName', '$nombreArchivo')";
    $isInsert = $db->execute($query);
    if ($isInsert) {?>
<html> <script type="text/javascript"> var id = <?php echo $id ?>;window.location = "../vistas/prueba2.php?ide=" + id;  </script> </html>
<?php
    } else {
        echo 'No se ha podido ejecutar la acción';
    }
} else {
    echo 'Lo sentimos, algo salió mal';
}
