<?php
$connect = mysqli_connect("localhost", "pcspucv_wp4", "uEXLb0r4TGOb", "pcspucv_wp4");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM contratistas WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Contratista eliminado';
 }
}
?>
