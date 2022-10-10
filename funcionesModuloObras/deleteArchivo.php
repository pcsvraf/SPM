<?php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
if(isset($_POST["id"]))
{
 $query1 = "DELETE FROM archivosObraNueva WHERE id = '".$_POST['id']."'";
 $ejecuta = mysqli_query($connect, $query1);
 if($ejecuta)
 {
  echo 'Archivo eliminado';
  //echo '<script> alert("archivo eliminado"); window.location = "../vistas/iniciarObras.php" </script>';
 }else {
     echo 'Se produjo un error al eliminar el archivo';
 }
}
?>
