<?php
include '/home/pcspucv/public_html/spm/wp-load.php';
$email = get_userdata(get_current_user_id())->user_firstname;
$apellido = get_userdata(get_current_user_id())->user_lastname;
$correo = get_userdata(get_current_user_id())->user_email;
$encargadoObra = $email . " " . $apellido;
$idObraNueva = $_GET['id'];
$nomArch = $_GET['nomArchivo'];
//se importa la clase de la conexion
require '../funciones/conexion.php';
//se crea un objeto para heredar los métodos
$db = new Conect_MySql();
//se obtiene el nombre de los archivos, para hacer una validación

//se comienza a hacer una validación, para insertar los archivos
if ($nomArch != '') {
  $tipo = $_FILES[$nomArch]['type'];
  $tamanio = $_FILES[$nomArch]['size'];
  $prefix = "doc_";
  $ext = explode(".", $resolucion);
  $extencion = $ext[1];
  $ruta = $_FILES[$nomArch]['tmp_name'];
  $destino = "..//archivosObrasNuevas/" . $resolucion;
  $realName = uniqid($prefix, TRUE) . '.' . $extencion;

  if (move_uploaded_file($ruta, $destino)) {
    $sql = "INSERT INTO archivosObraNueva(id, idRelacion, tamanio, tipo, nombreArchivo, nombreRandom, identificadorArchivo)
        VALUES(null,$idObraNueva,'$tamanio','$tipo','$resolucion','$realName',$nom)";
    $isInsert = $db->execute($sql);
    if ($isInsert) {
        echo '<script> alert("Se ingresó correctamente"); window.location = "../vistas/iniciarObras.php" </script>';
    }
  } else {
      echo 'Lo sentimos, ocurrió un error '.$tipo. " ";
  }
}else{
  echo "Ocurrió un error ".$tamanio. " ";
}
?>
