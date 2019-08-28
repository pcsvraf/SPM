<?php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
if(isset($_POST["id"]))
{
 $value = utf8_decode(mysqli_real_escape_string($connect, $_POST["value"]));

 $query = "UPDATE personalIngresador SET ".$_POST["column_name"]."='$value' WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Personal actualizado';
 }
 else {
  echo 'No se actualizaron los datos';
 }
}
?>
