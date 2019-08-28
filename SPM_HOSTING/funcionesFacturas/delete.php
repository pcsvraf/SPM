<?php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
if(isset($_POST["id"]))
{
 $query1 = "DELETE FROM archivosFacturas WHERE idRelacion = '".$_POST['id']."'";
 $ejecuta = mysqli_query($connect, $query1);
 $query = "DELETE FROM facturas WHERE id = '".$_POST["id"]."'";
 if($ejecuta && mysqli_query($connect, $query))
 {
  echo 'Factura eliminada';
 }else {
     echo 'Se produjo un error al eliminar la Factura';
 }
}
?>
